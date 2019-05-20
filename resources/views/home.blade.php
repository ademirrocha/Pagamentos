@extends('layouts.app')

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Sistema de Pagamento de Cartão de Crédito
                    @if(session('returnMessage'))
                        <div class="alert alert-success" role="alert">
                            <strong>{{session('returnMessage')->returnMessage}}</strong>
                        </div>
                        
                    @endif
                </div>
                
                

                <div class="card-body">
                    <form method="POST" action="{{ route('createPayment') }}">
                        @csrf

                        <div class="form-group row">

                            

                            <label for="card_number" class="col-md-4 col-form-label text-md-right">{{ __('Número do Cartão') }}</label>

                            

                            <div class="col-md-6">
                                

                                    <input id="card_number" type="text" class="form-control @error('card_number') is-invalid @enderror" name="card_number" value="{{ old('card_number') }}" required autocomplete="card_number" onKeyPress=" mcc('card_number'); tgdeveloper.getCardFlag('card_number');" onKeyDown=" mcc('card_number'); tgdeveloper.getCardFlag('card_number');" onKeyUp=" mcc('card_number'); tgdeveloper.getCardFlag('card_number');" autofocus maxlength="19">

                                    
                                

                                @error('card_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div id="ico_card" style="float: right;" >
                                <img width="30" height="30" src="{{asset('vendor/pagamentos/img/default.png')}}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="card_proprietary" class="col-md-4 col-form-label text-md-right">{{ __('Nome do Titular (Como impresso no cartão)') }}</label>

                            <div class="col-md-6">
                                <input id="card_proprietary" type="text" class="form-control @error('card_proprietary') is-invalid @enderror" name="card_proprietary" value="{{ old('card_proprietary') }}" required autocomplete="card_proprietary" onKeyPress=" mcc('card_number'); tgdeveloper.getCardFlag('card_number');" onKeyDown=" mcc('card_number'); tgdeveloper.getCardFlag('card_number');" >

                                @error('card_proprietary')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="expiration_date_month" class="col-md-4 col-form-label text-md-right">{{ __('Validade') }}</label>

                            <div class="col-md-6 row">

                                <select id="expiration_date_month" type="text" class="col-md-6 form-control @error('expiration_date_month') is-invalid @enderror" name="expiration_date_month" value="{{ old('expiration_date_month') }}" required onchange="mcc('card_number'); tgdeveloper.getCardFlag('card_number');">
                                    <option>MM</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>

                                </select>
                            
                                <select id="expiration_date_year" type="text" class=" col-md-6 form-control @error('expiration_date') is-invalid @enderror" name="expiration_date_year" value="{{ old('expiration_date_year') }}" required autocomplete="expiration_date_year" onchange="mcc('card_number'); tgdeveloper.getCardFlag('card_number');">
                                    <option>AAAA</option>

                                    <option value="{{date('Y', strtotime('+0 year', strtotime(date('H:i'))))}}">{{date('Y', strtotime('+0 year', strtotime(date('H:i'))))}}</option>

                                    <option value="{{date('Y', strtotime('+1 year', strtotime(date('H:i'))))}}">{{date('Y', strtotime('+1 year', strtotime(date('H:i'))))}}</option>

                                    <option value="{{date('Y', strtotime('+2 year', strtotime(date('H:i'))))}}">{{date('Y', strtotime('+2 year', strtotime(date('H:i'))))}}</option>

                                    <option value="{{date('Y', strtotime('+3 year', strtotime(date('H:i'))))}}">{{date('Y', strtotime('+3 year', strtotime(date('H:i'))))}}</option>

                                    <option value="{{date('Y', strtotime('+4 year', strtotime(date('H:i'))))}}">{{date('Y', strtotime('+4 year', strtotime(date('H:i'))))}}</option>
                                    
                                    

                                </select>
                            

                                

                            </div>

                            @error('expiration_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="form-group row">
                            <label for="securityCode" class="col-md-4 col-form-label text-md-right">{{ __('Código de Segurança') }}</label>

                            <div class="col-md-6">
                                <input id="securityCode" type="text" class="form-control @error('securityCode') is-invalid @enderror" name="securityCode" required autocomplete="securityCode" maxlength="4" onKeyPress=" mcc('card_number'); tgdeveloper.getCardFlag('card_number');" onKeyDown=" mcc('card_number'); tgdeveloper.getCardFlag('card_number');">

                                @error('securityCode')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="amount" class="col-md-4 col-form-label text-md-right">{{ __('Valor') }}</label>

                            <div class="col-md-6">
                                <input id="amount" type="text" class="form-control @error('amount') is-invalid @enderror" name="amount" required onKeyPress="return(moeda(this,'.',',',event)); " placeholder="0,00" onKeyPress=" mcc('card_number'); tgdeveloper.getCardFlag('card_number');" onKeyDown=" mcc('card_number'); tgdeveloper.getCardFlag('card_number');">

                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="btn_pagar" type="submit" class="btn btn-primary col-md-12" disabled="disabled">
                                    {{ __('Confirmar Pagamento') }}
                                </button>
                            </div>
                        </div>
                    </form>
                   
                </div>


                <div class="card-header">Transações</div>

                    <div class="container-fluid col-sm-12 form-group">
                        <div class="table-responsive">
                            <table id="tabela-produtos" class="table  table-striped  table-bordered  table-hover  table-condensed  js-sticky-table">
                                <thead class="aw-table-header-solid">
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Número do Cartão</th>
                                        <th>Valor</th>
                                        <th>status</th>
                                        
                                    </tr>
                                </thead>
                                


                                @foreach(Auth::user()->payments as $payment)
                                    
                                <tr >
                                    <td >{{$payment->type}}</td>
                                    <td >{{$payment->cardNumber}}</td>
                                    <td >R$ {{number_format($payment->amount/100, 2, ',', '.')}}</td>
                                    <td>{{$payment->status}}</td>
                                </tr>

                                @endforeach

                                <tbody>

                                     
                                    

                                </tbody>
                            </table>
                                
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>

@endsection


@section('js')

<!-- Scripts -->


<script  src="{{asset('vendor/pagamentos/js/scripts_pagamentos.js')}}"></script>


@endsection
