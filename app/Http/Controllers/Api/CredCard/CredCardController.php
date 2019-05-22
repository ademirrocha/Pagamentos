<?php

namespace App\Http\Controllers\Api\CredCard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Cielo\API30\Merchant;

use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\CreditCard;

use Cielo\API30\Ecommerce\Request\CieloRequestException;

use App\Models\Api\Payments\Payments;

class CredCardController extends Controller
{
    private $merchant_id;
	private $merchant_key;
	private $environment;

	    

	 function __construct($foo = null)
	 {
	 	$this->merchant_id = '007f337e-8322-437f-a422-66bf23b42177';
		$this->merchant_key = 'HGGKCSVBTCQUJUVBZUDCXKDQWNYEVFIROKADPOEE';
		// Configure o ambiente
		$this->environment = Environment::sandbox();

	 }


	 public function calcular($v1, $v2, $op){
	 	$valV1 = explode(',',$v1);
		$valV2 = explode(',',$v2);

		$qts1 = strlen($valV1[1]);
		$qts2 = strlen($valV2[1]);

		$seg1 = pow(10,$qts1);
		$seg2 = pow(10,$qts2);

		$v1 = ($valV1[0] + ($valV1[1]/$seg1));

		$v2 = ($valV2[0] + ($valV2[1]/$seg2));

		if($op == '*'){
			return $v1 * $v2;
		}else if($op == '+'){
			return $v1 + $v2;
		}else if($op == '-'){
			return $v1 - $v2;
		}else if($op == '/'){
			return $v1 / $v2;
		}
		

	 }


	public function tiraPontos($valor){
		$pontos = array(".");
		$result = str_replace($pontos, "", $valor);
		return $result;
	}
	
	public function createPayment(Request $request){

		/*
		form Method = POST:	
				Campos:
					amount //em formato BRL (casas decimais separadas por vírgula)
					securityCode //numero 3 ou 4 dígitos
					expiration_date_month //numero 2 dígitos
					expiration_date_year //numero 4 dígitos
					card_number	// numero do cartão completo (separados a cada 4 dígitos ou não)
					card_proprietary // nome do dono do cartão (impresso no cartão)

		*/
		
		$amount = $this->tiraPontos($request->amount);

		$amount = (int) $this->calcular($amount , '100,0', '*');

		// Configure seu merchant
		$merchant = new Merchant($this->merchant_id, $this->merchant_key);

		// Crie uma instância de Sale informando o ID do pedido na loja
		$sale = new Sale('123456'); //merchantOrderId

		// Crie uma instância de Customer informando o nome do cliente
		$customer = $sale->customer('Fulano Teste Api');

		// Crie uma instância de Payment informando o valor do pagamento
		$payment = $sale->payment($amount);

		//dd($request->expiration_date_month."/".$request->expiration_date_year);

		// Crie uma instância de Credit Card utilizando os dados de teste
		// esses dados estão disponíveis no manual de integração
		$payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
		        ->creditCard($request->securityCode, CreditCard::VISA)
		        ->setExpirationDate($request->expiration_date_month."/".$request->expiration_date_year)
		        ->setCardNumber($request->card_number)
		        ->setHolder($request->card_proprietary);

		// Crie o pagamento na Cielo
		try {
		    // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
		    $sale = (new CieloEcommerce($merchant, $this->environment))->createSale($sale);


		    return $this->savePaymant($sale);

		    // E também podemos fazer seu cancelamento, se for o caso
		    //$sale = (new CieloEcommerce($merchant, $this->environment))->cancelSale($paymentId, 15700);


		} catch (CieloRequestException $e) {
		    // Em caso de erros de integração, podemos tratar o erro aqui.
		    // os códigos de erro estão todos disponíveis no manual de integração.

		    $error = $e->getCieloError();
		    
		    return $this->savePaymant($sale);
		}

	}



	public function createGenerateTokenPayment(){

		// Configure seu merchant
		$merchant = new Merchant($this->merchant_id, $this->merchant_key);

		// Crie uma instância de Sale informando o ID do pedido na loja
		$sale = new Sale('123');

		// Crie uma instância de Customer informando o nome do cliente
		$customer = $sale->customer('Fulano de Tal');

		// Crie uma instância de Payment informando o valor do pagamento
		$payment = $sale->payment(15700);

		// Crie uma instância de Credit Card utilizando os dados de teste
		// esses dados estão disponíveis no manual de integração.
		// Utilize setSaveCard(true) para obter o token do cartão
		$payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
		        ->creditCard("123", CreditCard::VISA)
		        ->setExpirationDate("12/2018")
		        ->setCardNumber("0000000000000001")
		        ->setHolder("Fulano de Tal")
		        ->setSaveCard(true);

		// Crie o pagamento na Cielo
		try {
		    // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
		    $sale = (new CieloEcommerce($merchant, $this->environment))->createSale($sale);

		    // O token gerado pode ser armazenado em banco de dados para vendar futuras
		    $token = $sale->getPayment()->getCreditCard()->getCardToken();
		} catch (CieloRequestException $e) {
		    // Em caso de erros de integração, podemos tratar o erro aqui.
		    // os códigos de erro estão todos disponíveis no manual de integração.
		    $error = $e->getCieloError();
		}
		

	}


	public function createTokenizedPayment(){
		

		// Configure seu merchant
		$merchant = new Merchant($this->merchant_id, $this->merchant_key);

		// Crie uma instância de Sale informando o ID do pedido na loja
		$sale = new Sale('123');

		// Crie uma instância de Customer informando o nome do cliente
		$customer = $sale->customer('Fulano de Tal');

		// Crie uma instância de Payment informando o valor do pagamento
		$payment = $sale->payment(15700);

		// Crie uma instância de Credit Card utilizando os dados de teste
		// esses dados estão disponíveis no manual de integração
		$payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
		        ->creditCard("123", CreditCard::VISA)
		        ->setCardToken("TOKEN-PREVIAMENTE-ARMAZENADO");

		// Crie o pagamento na Cielo
		try {
		    // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
		    $sale = (new CieloEcommerce($merchant, $this->environment))->createSale($sale);

		    // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
		    // dados retornados pela Cielo
		    $paymentId = $sale->getPayment()->getPaymentId();
		} catch (CieloRequestException $e) {
		    // Em caso de erros de integração, podemos tratar o erro aqui.
		    // os códigos de erro estão todos disponíveis no manual de integração.
		    $error = $e->getCieloError();
		}
	}


	public function createRecurrentPayment(){
		

		// Configure seu merchant
		$merchant = new Merchant($this->merchant_id, $this->merchant_key);

		// Crie uma instância de Sale informando o ID do pedido na loja
		$sale = new Sale('123');

		// Crie uma instância de Customer informando o nome do cliente
		$customer = $sale->customer('Fulano de Tal');

		// Crie uma instância de Payment informando o valor do pagamento
		$payment = $sale->payment(15700);

		// Crie uma instância de Credit Card utilizando os dados de teste
		// esses dados estão disponíveis no manual de integração
		$payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
		        ->creditCard("123", CreditCard::VISA)
		        ->setExpirationDate("12/2018")
		        ->setCardNumber("0000000000000001")
		        ->setHolder("Fulano de Tal");

		// Configure o pagamento recorrente
		$payment->recurrentPayment(true)->setInterval(RecurrentPayment::INTERVAL_MONTHLY);

		// Crie o pagamento na Cielo
		try {
		    // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
		    $sale = (new CieloEcommerce($merchant, $this->environment))->createSale($sale);

		    $recurrentPaymentId = $sale->getPayment()->getRecurrentPayment()->getRecurrentPaymentId();
		} catch (CieloRequestException $e) {
		    // Em caso de erros de integração, podemos tratar o erro aqui.
		    // os códigos de erro estão todos disponíveis no manual de integração.
		    $error = $e->getCieloError();
		}
	}


	public function savePaymant($sale){

		$paymentId = $sale->getPayment()->getPaymentId();
		$payment = new Payments();
		if(Payments::where('paymentId', $paymentId)->exists()){
			$payment = Payments::where('paymentId', $paymentId);
		}

		//dd($sale);
		
		$payment->user_id = 1;
		$payment->paymentId = $paymentId;
		$payment->type = $sale->getPayment()->getType();
		$payment->cardNumber = $sale->getPayment()->getCreditCard()->getCardNumber();
		$payment->brand = $sale->getPayment()->getCreditCard()->getBrand();
		$payment->authorizationCode = $sale->getPayment()->getAuthorizationCode();
		$payment->returnCode = $sale->getPayment()->getReturnCode();

		$msgs = $this->getStatus($payment->returnCode);

		
		
		$payment->returnMessage = $msgs['message'];
		$payment->status = $msgs['status'];

		$payment->amount = $sale->getPayment()->getAmount();

		$payment->save();

		return array([
			'returnCode' => $sale->getPayment()->getReturnCode(),
			'returnMessage' => $sale->getPayment()->getReturnMessage(),
			'paymentId' => $paymentId,
		]);
		
		//return redirect()->back()->with('returnMessage', $payment);
		
	}

	public function getStatus($cod){
		$msgs = array();

		if($cod == 4 || $cod == 6 ){
			$msgs['message'] = 'Operação realizada com sucesso';
			$msgs['status'] = 'Aprovada';
		}else if($cod == 5 ){
			$msgs['message'] = 'Operação Não Autorizada';
			$msgs['status'] = 'Não Autorizada';
			
		}else if($cod == 57 ){
			$msgs['message'] = 'Cartão Expirado';
			$msgs['status'] = 'Cartão Expirado';
		}else if($cod == 78 ){
			$msgs['message'] = 'Cartão Bloqueado';
			$msgs['status'] = 'Cartão Bloqueado';
		}else if($cod == 99 ){
			$msgs['message'] = 'Não Foi Possível Realizar a Operação';
			$msgs['status'] = 'Time Out';
		}else if($cod == 77 ){
			$msgs['message'] = 'Cartão Cancelado';
			$msgs['status'] = 'Cartão Cancelado';
		}else if($cod == 70 ){
			$msgs['message'] = 'Problemas com o Cartão de Crédito';
			$msgs['status'] = 'Cartão Com Problemas';
		}else if($cod == 70 ){
			$msgs['message'] = 'Indefinida';
			$msgs['status'] = 'Operation Successful / Time Out';
		}

		return $msgs;
	}


	protected function capturePayment(){

		// Configure seu merchant
		$merchant = new Merchant($this->merchant_id, $this->merchant_key);

		$haUnautorized = false;

		foreach (auth()->user()->payments as $payment) {

			
			
			if($payment->returnCode != 4 && $payment->returnCode != 6){

			$paymentId = $payment->paymentId;
			$amount = $payment->amount;



		    // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
		    $sale = (new CieloEcommerce($merchant, $this->environment))->captureSale($paymentId, $amount, 0);

		    dd($sale);

		     $this->savePaymant($sale);

		    }

	    }

		    
	}
}
