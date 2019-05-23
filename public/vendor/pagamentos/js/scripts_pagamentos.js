function moeda(a, e, r, t) {
    let n = ""
      , h = j = 0
      , u = tamanho2 = 0
      , l = ajd2 = ""
      , o = window.Event ? t.which : t.keyCode;
    if (13 == o || 8 == o)
        return !0;
    if (n = String.fromCharCode(o),
    -1 == "0123456789".indexOf(n))
        return !1;
    for (u = a.value.length,
    h = 0; h < u && ("0" == a.value.charAt(h) || a.value.charAt(h) == r); h++)
        ;
    for (l = ""; h < u; h++)
        -1 != "0123456789".indexOf(a.value.charAt(h)) && (l += a.value.charAt(h));
    if (l += n,
    0 == (u = l.length) && (a.value = ""),
    1 == u && (a.value = "0" + r + "0" + l),
    2 == u && (a.value = "0" + r + l),
    u > 2) {
        for (ajd2 = "",
        j = 0,
        h = u - 3; h >= 0; h--)
            3 == j && (ajd2 += e,
            j = 0),
            ajd2 += l.charAt(h),
            j++;
        for (a.value = "",
        tamanho2 = ajd2.length,
        h = tamanho2 - 1; h >= 0; h--)
            a.value += ajd2.charAt(h);
        a.value += r + l.substr(u - 2, u)
    }
    return !1
}



function mcc(v){
	
  s = document.getElementById(v).value
  s = s.replace(/\D/g,""); // Permite apenas dígitos
  s = s.replace(/(\d{4})/g, "$1."); // Coloca um ponto a cada 4 caracteres
  s = s.replace(/\.$/, ""); // Remove o ponto se estiver sobrando
  s = s.substring(0, 19)// Limita o tamanho

  document.getElementById(v).value = s;

  return false;
}



var tgdeveloper = {

    /**
    * getCardFlag
    * Return card flag by number
    *
    * @param cardnumber
    */    
    getCardFlag: function(cardnumber) {

    	var proprietary = document.getElementById('card_proprietary').value;
    	var expiration_date_month = document.getElementById('expiration_date_month').value;
    	var expiration_date_year = document.getElementById('expiration_date_year').value;
    	var securityCode = document.getElementById('securityCode').value;
    	var amount = document.getElementById('amount').value;
    	//http://tgdeveloper.com/blog/verificar-bandeira-de-cartao-de-credito-em-javascript

        var cardnumber = document.getElementById(cardnumber).value;
        cardnumber = cardnumber.replace(/[^0-9]+/g, '');

        var cards = {
            visa      : /^4[0-9]{12}(?:[0-9]{3})/,
            mastercard : /^5[1-5][0-9]{14}/,
            diners    : /^3(?:0[0-5]|[68][0-9])[0-9]{11}/,
            amex      : /^3[47][0-9]{13}/,
            discover  : /^6(?:011|5[0-9]{2})[0-9]{12}/,
            hipercard  : /^(606282\d{10}(\d{3})?)|(3841\d{15})/,
            elo        : /^((((636368)|(438935)|(504175)|(451416)|(636297))\d{0,10})|((5067)|(4576)|(4011))\d{0,12})/,
            jcb        : /^(?:2131|1800|35\d{3})\d{11}/,        
            aura      : /^(5078\d{2})(\d{2})(\d{11})$/      
        };



        for (var flag in cards) {

        	img = $('#ico-card');

                img.html('');
                img.addClass('fa-credit-card');
                img.removeClass('fa-cc-visa');
                img.removeClass('fa-cc-jcb');
                img.removeClass('fa-cc-amex');
                img.removeClass('fa-cc-mastercard');
                img.removeClass('fa-cc-diners-club');
                img.removeClass('fa-cc-discover');

            if(cards[flag].test(cardnumber)) {
               

            	if(flag == 'hipercard'){
                    img.html('<img width="30" height="30" src="vendor/pagamentos/img/hipercard.jpg"">');
                }else if(flag == 'visa'){
                    img.addClass('fa-cc-visa');
                }else if(flag == 'jcb'){
                    img.addClass('fa-cc-jcb');
                }else if(flag == 'amex'){
                    img.addClass('fa-cc-amex');
                }else if(flag == 'mastercard'){
                    img.addClass('fa-cc-mastercard');
                }else if(flag == 'diners'){
                    img.addClass('fa-cc-diners-club');
                }else if(flag == 'discover'){
                    img.addClass('fa-cc-discover');
                }else if(flag == 'elo'){
                    img.html('<img width="30" height="30" src="vendor/pagamentos/img/elo.png"">');
                }else if(flag == 'aura'){
                    img.html('<img width="30" height="30" src="vendor/pagamentos/img/aura.jpg"">');
                }else{
                    img.addClass('fa-credit-card');
                }

            	if( 
                	amount == '' || proprietary == '' || expiration_date_month == 'MM' || 
                	expiration_date_year == 'AAAA' || securityCode == ''){
                	$("#btn_pagar").attr("disabled", 'disabled');
                }else{
					$("#btn_pagar").removeAttr("disabled");
                }
                return flag;
            }else{
            	$("#btn_pagar").attr("disabled", 'disabled');
            	
            }
        }        
        
        return false;
    }

}