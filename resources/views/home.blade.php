@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')


	<div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$qtdPaymentsLocal}} <span style="font-size: 60%;">de {{$qtdPaymentsLocalTotal}}</span></h3>

          <p>Transações Locais Autorizadas</p>
        </div>
        <div class="icon">
          <i class="fa fa-credit-card"></i>
        </div>
        <a href="#" class="small-box-footer">Detalhes <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$qtdPaymentsApi}} <span style="font-size: 60%;">de {{$qtdPaymentsApiTotal}}</span></h3>

          <p>Transações Api Autorizadas</p>
        </div>
        <div class="icon">
          <i class="fa fa-credit-card"></i>
        </div>
        <a href="#" class="small-box-footer">Detalhes <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>

    <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$qtdUsers}}</h3>

              <p>Usuários Registrados</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">Detalhes <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <button onclick="enviaMensage();">Enviar Whats</button>
}
}

        

@stop


@section('js')

<!-- Scripts -->


<script  src="{{asset('vendor/myzzy/js/wa.js')}}"></script>


@endsection