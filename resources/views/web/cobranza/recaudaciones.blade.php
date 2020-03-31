@extends('layouts.app')

@section('title', 'Clientes | Cobranza Gestiones')
@section('content')

  <div>
    <recaudacion-component :id="{{ $idc }}"></recaudacion-component>
  </div>

@endsection