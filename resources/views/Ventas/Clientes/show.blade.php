@extends('layouts.app')

@section('title', ' CLIENTES | Ventas')
@section('content')
    <!-- tabla DAMPLUSagenda--->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                 
                    @if(session('msg'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i>Excelente</h5>                                     
                            <ul>                         
                                <li>{{ session("msg") }}</li>                            
                            </ul>
                        </div>
                    @endif
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i>Error</h5>  
                            <ul>
                            </ul>
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-warning">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                
                <section class="col-lg-12 connectedSortable">
                <div class="alert alert-primary" role="alert">
                    <center> <strong>Cliente Detalle</strong> </center>    
                </div>

                <table class="table table-hover table-condensed">
                    <thead>
                        <th>Cedula</th>
                        <th>Nombres</th>
                        <th>Direccion</th>
                        <th>Dato</th>
                        <th>Dato2</th>
                        <th>Dato3</th>
                        <th>Fecha</th>
                        <th>Fecha Edit</th>
                    </thead>
                    <tbody>
                        <td>{{ $datos->IdCampañaPersona }}</td>    
                        <td>{{ $datos->Campo2 }}</td>  
                        <td>{{ $datos->Campo5 }}</td>  
                        <td>{{ $datos->Campo3 }}</td> 
                        <td>{{ $datos->Campo4 }}</td>  
                        <td>{{ $datos->Campo8 }}</td>   
                        <td>{{ $datos->FecRegistro }}</td> 
                        <td>{{ $datos->FecEdicion }}</td> 
                    </tbody>
                </table>
            </section>
            </div> 
        </div> 
    </div>   
       


    <div class="row">

        <div class="col-md-12 col-sm-6 col-xs-6">

                @if(Session::has('infofecha'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <center> <strong>{{ Session::get('infofecha') }}</strong></center>  
                </div>
                @endif


            @if(Session::has('info'))
            <div class="alert alert-warning alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <center> <strong>{{ Session::get('info') }}</strong></center>  
            </div>
            @endif
          <div class="card card-info">
            {!! Form::open(['route' => 'agendar.store']) !!}
            @include('Ventas.Clientes.form.agenda')
           
            {!! Form::close() !!}
  
        </div>
   
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header"><h3 class="card-title"><center> Gestiones de Agendamientos</center> </h3></div>
                    <div class="card-body">
                        <table class="table table-striped" >
                            <thead>
                                <tr>
                                    <th><i class="fas fa-phone-volume"></i></th>
                                    <th><i class="fas fa-phone-square"></i></th>
                                    <th><i class="fas fa-phone-square"></i></th>
                                    <th><i class="fas fa-comments"></i></th>
                                    <th><i class="fas fa-calendar-alt"></i></th>
                                    <th><i class="fas fa-clock"></i></th>
                                    <th><i class="fas fa-thermometer-quarter"></i></th>
                                    <th>AREA</th>
                                    <th>Registrado</th>
                                    <th><i class="far fa-address-card"></i></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agenda as $agendas)
                                <tr>
                                    <td>{{ $agendas->telefonoContacto }}</td>
                                    <td>{{ $agendas->telefonoNuevo }}</td>
                                    <td>{{ $agendas->contactarcel }}</td>
                                    <td> {{ $agendas->comentario }}</td>
                                    <td>{{ $agendas->fecha }}</td>
                                    <td>{{ $agendas->horas }}</td>
                                    
                                    @php
                                    $color = "";
                                    @endphp
                                        @if ($agendas->dias < 0)
                                            @php
                                            $color = "badge badge-danger";
                                            @endphp
                                        @else
                                            @if ($agendas->dias == 0)
                                                @php
                                                $color = "badge badge-warning";
                                                @endphp
                                            @else
                                                @php
                                                $color = "badge badge-success";
                                                @endphp
                                        
                                            @endif
                                        @endif
                                        
                                        @if ($agendas->estado == 'R')
                                            <td class="badge badge-warning" ><i class="fas fa-exchange-alt"></i> <small>Reagendado</small> </td>  
                                        @else
                                            @if ($agendas->dias < 0)
                                                <td class="{{ $color }}"><i class="far fa-clock"></i> <small> {{ $agendas->dias }}  Vencido </small></td>
                                            @else  
                                                @if ($agendas->dias == 0)
                                                    <td class="{{ $color }}"><i class="far fa-clock"></i> HOY </td>
                                                @else
                                                    <td class="{{ $color }}"><i class="far fa-clock"></i>  {{ $agendas->dias }} Dias</td>
                                                    @endif
                                            @endif
                                        @endif

                                        @if ($agendas->estado =='O' )
                                                <td>OPERACIONES</td>
                                        @else  
                                            @if ($agendas->estado =='P')
                                                <td>PREDICTIVO</td>
                                            @else
                                                <td>CALL</td>
                                            @endif
                                        @endif
                                        <td>{{ Carbon\Carbon::parse($agendas->registrado )->format('Y-m-d') }}</td>
                                        <td>{{ $agendas->users  }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    



     

 

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
            <div class="alert alert-warning" role="alert">
                <center> <strong>Gestiones de Sii Ventas</strong> </center>    
            </div>
                <section class="col-lg-12 connectedSortable">
                <table class="table table-striped">
                    <thead class="thead-dark">
                        
                        <th>Fecha</th>
                        <th>Agente</th>
                        <th>Telefono</th>
                        <th>Estado</th>
                        <th WIDTH="25%">Comentario</th>
                        <th>Fecha</th>
                        <th>Fecha Edit</th>
                    </thead>
                    <tbody class="table-striped ">
                        @foreach ($gestiones as $gestion)
                        <tr>
                        <td>{{  Carbon\Carbon::parse($gestion->FecRegistro)->format('d-m-Y ')  }}</td>
                        <td>{{ $gestion->UsuRegistro }}</td>
                        <td>{{ $gestion->Contacto }}</td>    
                        <td>{{ $gestion->estado }}</td>  
                        <td>{{ $gestion->Observacion }}</td> 
                        <td>{{ $datos->FecRegistro }}</td> 
                        <td>{{ $datos->FecEdicion }}</td> 
                    </tr>
                    @endforeach
                    </tbody>
                </table> 
                </section>  
            </div>
        </div>
    </div>
    
       
           

 
    @endsection

    @section('script')

    
  
    
    @endsection