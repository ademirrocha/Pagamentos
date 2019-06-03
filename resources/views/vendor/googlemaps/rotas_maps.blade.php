@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')
    <h1>Myzzy Maps</h1>
@stop

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">


@section('content')
<div class="container">
Maps

<div id="map2" style="height: 500px; width: 700px; "></div>
</div>

@endsection


@section('js')
  <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
  <script  src="{{asset('vendor/myzzy/js/maps.js')}}"></script>

  <script>
    $( document ).ready(function() {
        MapsRotas();
    });
  </script>


  

@endsection