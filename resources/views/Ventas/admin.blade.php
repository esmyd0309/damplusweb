@extends('layouts.app')

@section('title', 'Ventas')
@section('content')


        <div class="container" >
            <div class="alert alert-success" role="alert">
            <center> Detalle Grupo por cantidad de Agendados Pendientes</center>
            </div>
            <div class='row' id="grupo">
            </div>
        </div>

   @endsection

@section('script')
<script src="{{ asset('js/Bandeja/jquery.min.js') }}" ></script>
<script src="{{ asset('js/Bandeja/Ventas/admin.js') }}" ></script>

@endsection