
@extends('layouts.app')

@section('title', 'Actualizar CLIENTE')
@section('content')
    
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                        @if(Session::has('info'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <center> <strong>{{ Session::get('info') }}</strong></center>  
                        </div>
                        @endif
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
                </div>
                <section class="col-lg-12 connectedSortable">
                <div class="alert alert-primary" role="alert">
                    <center> <strong>Cliente Detalle</strong> </center>    
                </div>

                <table class="table table-hover table-condensed">
                    <thead>
                        <th>Cedula</th>
                        <th>Nombres</th>
                        <th>Deuda</th>
                        <th>Saldo</th>
                        <th>Area</th>
                        <th>Agente</th>
                    </thead>
                    <tbody>
                        <td>{{ $datos->Identificacion }}</td>    
                        <td>{{ $datos->Nombres }}</td>  
                        <td>{{ $datos->ValorDeuda }}</td>  
                        <td>{{ $datos->SaldoDeuda }}</td> 
                        <td>{{ $datos->Campo9 }}</td>  
                        <td>{{ $datos->IdAgente }}</td>   
                    </tbody>
                </table>
            </section>


            @if (!is_null( $DAMPLUStelefonos))
    
            <!-- https://github.com/Hujjat/laravel-crud/blob/master/app/Http/Controllers/CategoryController.php -->
         
            <section class="col-lg-12 connectedSortable">
                    <table class="table table-hover table-condensed">
                        <thead>
                            <th><center><i class="fab fa-whatsapp"></i></center></th>
                            <th><center><i class="fas fa-mobile"></i> / <i class="fas fa-sms"></i></center></th>
                            <th><center><i class="fas fa-blender-phone"></i></center></th>
                            <th><center><i class="fas fa-house-damage"></i></center></th>
                            <th><center>Tel. Laboral</center></th>
                            <th><center>Extesiòn</center></th>
                            <th><center>Dir. Laboral</center></th>
                            <th><center><i class="fas fa-envelope-open"></i></center></th>
                            <th><center><i class="fab fa-battle-net"></i></center></th>
                        </thead>
                        <tbody>
                            <td><center>{{ $DAMPLUStelefonos->telefono1 }}</center></td>    
                            <td><center>{{ $DAMPLUStelefonos->telefono2 }}</center></td> 
                            <td><center>{{ $DAMPLUStelefonos->convencional }}</center></td> 
                            <td><center>{{ $DAMPLUStelefonos->direccioncasa }}</center></td> 
                            <td><center>{{ $DAMPLUStelefonos->convencionaltrabajo }}</center></td> 
                            <td><center>{{ $DAMPLUStelefonos->extension }}</center></td> 
                            <td><center>{{ $DAMPLUStelefonos->direcciontrabajo }}</center></td> 
                            <td><center>{{ $DAMPLUStelefonos->email }}</center></td> 
                            <td><center>{{ $DAMPLUStelefonos->created_at }}</center></td> 
                            <td>
                                <button class="btn btn-info"  data-toggle="modal" data-target="#edit">Editar</button>
                            </td>   
                        </tbody>
                    </table>
                </section>
            </div> 
        </div> 
    </div>   
<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Editar Contactos</h4>
            </div>
            {!! Form::model($DAMPLUStelefonos, ['route' => ['DAMPLUStelefonos.update', $DAMPLUStelefonos->idc], 'method' => 'PATCH']) !!}
                {{ method_field('PUT') }}
                    <input type="hidden" name="category_id" id="cat_id" value="">
                         @csrf
                    <div class="modal-body">
                        @include('Cobranza.Clientes.partial.telefonos')
                    </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                  <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
                {!! Form::close() !!}
          </div>
        </div>
      </div>
      
      <!-- Modal -->
     

    
@else
    
    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-6">
            <div class="card">
      	<!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Agregar Contactos
            </button>
            </div>
        </div>
        <div class="col-lg-3">
        </div>
    </div>
   <!-- Modal -->
   <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog" role="document">
       <div class="modal-content">
         <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title" id="myModalLabel">Agregar Contactos</h4>
         </div>
         {!! Form::open(['route' => ['DAMPLUStelefonos.agregar', $idcc]]) !!}
        
                 {{csrf_field()}}
             <div class="modal-body">
                    @include('Cobranza.Clientes.partial.telefonos')
             </div>
             <div class="modal-footer">
               <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
               <button type="submit" class="btn btn-primary">Agregar</button>
             </div>
         </form>
       </div>
     </div>
   </div>



   @endif



   <section class="col-lg-12 connectedSortable">
       <h3>Datos Parientes</h3>
        <table class="table table-hover table-condensed">
            <thead>
                <th><center>Cedula</center></th>
                <th><center>Nombre</center></th>
                <th><center>Parentesco</center></th>
                <th><center>Profesión</center></th>
                <th><center>Celular</center></th>
                <th><center>Celular2</center></th>
                <th><center>Celular3</center></th>
                <th><center>Fijo1</center></th>
                <th><center>Fijo2</center></th>
                <th><center>Ciudad</center></th>
                <th><center>Provencia</center></th>
                <th><center>Direccion</center></th>
            </thead>
            <tbody>


                    @foreach ($parentescos as $parentesco)
                <tr>
                    <td><center>{{ $parentesco->cedulaPariente }}</center></td>    
                    <td><center>{{ $parentesco->nombrePriente }}</center></td> 
                    <td><center>{{ $parentesco->parentesco }}</center></td> 
                    <td><center>{{ $parentesco->DES_PROFESION }}</center></td> 
                    <td><center>{{ $parentesco->CEL1_NVO1 }}</center></td> 
                    <td><center>{{ $parentesco->CEL2_NVO1 }}</center></td>  
                    <td><center>{{ $parentesco->CEL4_NVO1 }}</center></td> 
                    <td><center>{{ $parentesco->TLF_FIJO1 }}</center></td> 
                    <td><center>{{ $parentesco->TLF_FIJO2 }}</center></td> 
                    <td><center>{{ $parentesco->ciudad1 }}</center></td> 
                    <td><center>{{ $parentesco->provincia1 }}</center></td> 
                    <td><center>{{ $parentesco->direccion1 }}</center></td> 
                    <td>
                    </td> 
                </tr>  
            @endforeach
            </tbody>
        </table>
    </section>









    <div class="row">    
        <section class="col-lg-6 connectedSortable">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="ion ion-clipboard mr-1"></i>
                            Direcciones
                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <ul class="todo-list">
                                @foreach ($direciones as $direcione)
                            <li>
                                <!-- drag handle -->
                                <span class="handle">
                                    <i class="fas fa-ellipsis-v"></i>
                                    <i class="fas fa-ellipsis-v"></i>
                                </span>
                                <!-- checkbox -->
                                <div  class="icheck-primary d-inline ml-2">
                                    
                                    <label for="todoCheck1"></label>
                                </div>
                         
                            <!-- todo text -->
                            <span class="text">{{ $direcione->Direccion }}</span>
                        </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </section>
            <section class="col-lg-6 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="ion-ios-telephone mr-1"></i>
                                Telefonos
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <ul class="todo-list">
                                    @foreach ($telefonos as $telefono)
                                <li>
                                    <!-- drag handle -->
                                    <span class="handle">
                                        <i class="fas fa-ellipsis-v"></i>
                                        <i class="fas fa-ellipsis-v"></i>
                                    </span>
                                    <!-- checkbox -->
                                    <div  class="icheck-primary d-inline ml-2">
                                        
                                    <label for="todoCheck1"></label>
                                    </div>
                                
                                <!-- todo text -->
                                <span class="text">{{ $telefono->TelefonoPersona }}  {{ $telefono->NombreReferencia }}</span>
                                </li>
                                @endforeach
                            </ul>
                           
                        </div>
                    </div>
                </section>
    </div>
@if ($detallecuotas != '0')
    

    <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="alert alert-success " role="alert">
                        <center> <strong>Cuotas Detalle</strong> </center>    
                    </div>
                    <section class="col-lg-12 connectedSortable">
                    <table class="table table-hover table-condensed table-bordered">
                        <thead class="thead-dark">
                            <th>#</th>
                            <th>Fecha Vence</th>
                            <th>Valor</th>
                            <th>Saldo</th>
                            <th>Stado</th>
                            <th>Agente Registra</th>
                            <th>Fecha Registro</th>
                            <th>Fecha Pago</th>
                            <th>Agente Confirma</th>
                        </thead>
                        <tbody class="table-striped ">
                                @foreach ($detallecuotas as $detallecuota)
                            <tr>
                                <td>{{ $detallecuota->IdCampañaPersonaCuotaDetalle }}</td> 
                                <td>{{ Carbon\Carbon::parse($detallecuota->FechaVence)->format('d-m-Y ') }}</td>  
                                <td>{{ $detallecuota->Monto }}</td>
                                <td>{{ $detallecuota->Saldo }}</td> 
                                @if ($detallecuota->Saldo <= 0)
                                    <td><span class="badge bg-success">Cancelado</span></td>
                                @elseif ($detallecuota->Saldo > 0 && $detallecuota->Saldo < $detallecuota->Monto)
                                    <td><span class="badge bg-warning">Incompleta</span></td>
                                @else
                                <td><span class="badge bg-danger">Pendiente</span></td>
                                @endif 
                                <td>{{ $detallecuota->UsuEdicion }}</td>
                                <td>{{ Carbon\Carbon::parse($detallecuota->FecEdicion)->format('d-m-Y ') }}</td>   
                                <td>{{ Carbon\Carbon::parse($detallecuota->FecIngPago)->format('d-m-Y ') }}</td>  
                                <td>{{ $detallecuota->UsuIngPago }}</td>  
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </section>  
                </div>
            </div>
        </div>

        @else
        <div class="alert alert-danger " role="alert">
                <center> <strong><i class="fas fa-exclamation-triangle"></i>SIN PLAN DE CUOTAS<i class="fas fa-exclamation-triangle"></i></strong> </center>    
            </div>
        @endif



    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="alert alert-success " role="alert">
                    <center> <strong>Pagos Detalle</strong> </center>    
                </div>
                <section class="col-lg-12 connectedSortable">
                <table class="table table-hover table-condensed table-bordered">
                    <thead class="thead-dark">
                        <th>IDP</th>
                        <th>Valor</th>
                        <th>Registra</th>
                        <th>Fecha</th>
                        <th>Confirma</th>
                        <th>Fec Confirma</th>
                        <th>Notas</th>
                        <th></th>
                    </thead>
                    <tbody class="table-striped ">
                            @foreach ($pagos as $pago)
                        <tr>
                            <td>{{ $pago->IdCampañaPersonaPago }}</td>    
                            <td>{{ $pago->Valor }}</td>  
                            <td>{{ $pago->UsuRegistro }}</td>
                            <td>{{ Carbon\Carbon::parse($pago->FecRegistro)->format('d-m-Y ')  }}</td> 
                            <td>{{ $pago->UsuConfirmacion }}</td>  
                            <td>{{ Carbon\Carbon::parse($pago->FecConfirmacion)->format('d-m-Y ')  }}</td> 
                            <td WIDTH="25%">{{ $pago->Notas }}</td> 
                            <td style="width: 5px"> <a href="{{ route('recibopago', $pago->IdCampañaPersonaPago) }}" class="btn btn-sm btn-info"> <i class="far fa-file-pdf"></i></a></td> 
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </section>  
            </div>
        </div>
    </div>

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
                        <th>Telefono</th>
                        <th>Estado</th>
                        <th WIDTH="25%">Comentario</th>
                        <th>Valor</th>
                        <th>Promesa</th>
                    </thead>
                    <tbody class="table-striped ">
                        @foreach ($gestiones as $gestion)
                        <tr>
                        <td>{{  Carbon\Carbon::parse($gestion->FecRegistro)->format('d-m-Y ')  }}</td>
                        <td>{{ $gestion->UsuRegistro }}</td>
                        <td>{{ $gestion->TelefonoPersona }}</td>    
                        <td>{{ $gestion->Descripcion }}</td>  
                        <td>{{ $gestion->Comentario }}</td> 
                        <td>{{ $gestion->PromesaMontoPago }}</td> 
                        
                        <td>{{ Carbon\Carbon::parse($gestion->PromesaPago)->format('d-m-Y ')  }}</td>   
                    </tr>
                    @endforeach
                    </tbody>
                </table> 
                </section>  
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                <div class="alert alert-warning   " role="alert">
                    <center> <strong>Gestiones Detalle Predictivo</strong> </center>    
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
                            @foreach ($gestionesPRE as $gestion)
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
    </div>
        {!! $gestionesPRE->render() !!} 
                <center>        @can('clientes.edit') <a href="{{route('clientes.edit', [$datos->IdCampaña , $datos->Identificacion])}}" class="btn btn-sm btn-danger ">Actualizar</a> @endcan  &nbsp;&nbsp;&nbsp;&nbsp; <a href="{{ route('clientes.index') }}" class="btn btn-success btn-sm">Volver</a></center> 
            
    @endsection

