@extends('layouts.app')




@section('title', 'Agenda | Ventas')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
        <div class="alert alert-warning   " role="alert">
            <center> <strong>Gestiones Detalle</strong> </center>    
        </div>
            <section class="col-lg-12 connectedSortable">
            <table class="table table-striped">
                <thead class="thead-dark">
                    
                    <th>Fecha</th>
                    <th>Agente</th>
                    <th>Cedula</th>
                    <th>Telefono</th>
                    <th>Estado</th>
                    <th>Contacto</th>
                    <th WIDTH="25%">Comentario</th>
                    <th>Campaña</th>
                    <th>Grabacion</th>
                </thead>
                <tbody class="table-striped ">
                    @foreach ($gestiones as $gestion)
                    <tr>
                    <td>{{  $gestion->fecha }}</td>
                    <td>{{  $gestion->asesor }}</td>
                    <td>{{ $gestion->cedula }}</td>
                    <td>{{ $gestion->telefono }}</td>    
                    <td>{{ $gestion->estado }}</td>  
                    <td>{{ $gestion->contacto }}</td> 
                    <td>{{ $gestion->negociacion }}</td> 
                    <td>{{ $gestion->campana }}</td> 
                    <td><audio controls  loop  preload class="containerPlayer"> 
                        <source src="{{ $gestion->location }}" type="audio/mp3" >
                            No es compatible con la reproducción de audio del navegador
                         
                    </audio></td>
                </tr>
                @endforeach
                </tbody>
            </table> 
            </section>  
        </div>
    </div>
</div>


@endsection