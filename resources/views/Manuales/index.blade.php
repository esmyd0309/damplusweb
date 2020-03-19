@extends('layouts.app')

@section('title', 'Manuales')
@section('content')


       
<div class="card">
    <div class="card-header d-flex p-0">
        <h3 class="card-title p-3">Asignacion de Puesto Predictivo</h3>
    </div>          
          
    <video playsinline="playsinline" autoplay="autoplay" muted="" loop="" controls>
        <source src="{{ asset('asignacionpuesto.mp4') }}" type="video/mp4">
    </video>
</div>          
                  
                      
                   
              
             
@endsection