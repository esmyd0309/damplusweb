@extends('layouts.app')


<link rel="stylesheet" href="{{ asset('plantilla/build/css/custom.css') }}">

<link rel="stylesheet" href="{{ asset('datatables/dataTables.bootstrap4.css') }}">

@section('title', 'Bandejas | Cobranza')
@section('content')

<div id="contenedor_carga">
  <div id="cargar"></div>
</div>

<div class="row">

  <!--
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Messages</span>
        <span class="info-box-number">1,410</span>
      </div>
 
    </div>
  </div><i class="far fa-hand-point-right"></i>
  -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

      <div class="info-box-content">
        <span class="info-box-text">Metas</span>
        <span class="info-box-number">850</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-info">  <img src="{{ asset('pacificard.png') }}" class="img-circle " ></span>

      <div class="info-box-content">
        <span class="info-box-text">PACIFICARD </span>
        <span class="info-box-number">3.00</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->
  <div class="col-md-3 col-sm-6 col-12">
    <div class="info-box">
      <span class="info-box-icon bg-danger"><img src="{{ asset('dp.jpg') }}" class="img-circle " ></span>

      <div class="info-box-content">
        <span class="info-box-text">DEPRATI</span>
        <span class="info-box-number">2.80</span>
      </div>
      <!-- /.info-box-content -->
    </div>
    <!-- /.info-box -->
  </div>
  <!-- /.col -->

  <div class="col-md-3 col-sm-6 col-12">
      <div class="info-box">
        <span class="info-box-icon bg-danger"><img src="{{ asset('claro.jpg') }}" class=" " ></span>
  
        <div class="info-box-content">
          <span class="info-box-text">Planes</span>
          <span class="info-box-number">--</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
</div>
 <!-- page content -->
 <div class="right_col" role="main">
        <!-- top tiles -->

       
        <!-- CLIENTES -->
        <div class="row tile_count">
         
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i>  Clientes Tocados</span>
            <div class="count" id="cantidad"></div>
            <span class="count_bottom" >
           
            </span>
          </div>

        <!-- PAGOS -->
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Cantidad Ventas</span>
                  <br/>
                <span class="count" id="ventas"></span>
                  <i class="green">
                    <i class="fa fa-sort-asc" id="putostt"></i>&nbsp;
                  </i><em>En puntos</em><br/>
                  <strong  id="putostt"></strong>&nbsp;
                  <span class="count_bottom"><i class="green"><span id="porcentajett"></span>% </i> En puntos</span>
            </div>

            <!-- COMPROMISOS -->

            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                <span class="count_top"><i class="fa fa-user"></i> Incompletas</span>
                  <br/>
                <span class="count" id="incompletas"></span>
                  <i class="green">
                    <i class="fa fa-sort-asc" id=""></i> 
                  </i><em></em><br/>
                  <strong  id="valorcompromiso"></strong>&nbsp;
                  <span class="count_bottom"><i class="green"><span id="porcentajecompromisovalor"></span> </i> </span>
            </div>

              <!-- incumplidos -->
              <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                  <span class="count_top"><i class="fa fa-user"></i> Interesados</span>
                    <br/>
                  <span class="count" id="interesados"></span>
                    <i class="red">
                      <i class="fa fa-sort-asc" id="porcentajeincumplido"></i>
                    </i><em></em><br/>
                    <strong  id="valorincumplido"></strong>&nbsp;
                    <span class="count_bottom"><i class="red"><span id="porcentajeincumplidovalor"></span> </i></span>
              </div>

                 <!-- incumplidos -->
                 <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
                    <span class="count_top"><i class="fa fa-user"></i> No Desean</span>
                      <br/>
                    <span class="count" id="dnc"></span>
                      <i class="red">
                        <i class="fa fa-sort-asc" id="porcentajeincumplido"></i>
                      </i><em></em><br/>
                      <strong  id="valorincumplido"></strong>&nbsp;
                      <span class="count_bottom"><i class="red"><span id="porcentajeincumplidovalor"></span> </i> </span>
                </div>



        <!-- VALORES RECUPERADOS  -->
          <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Puntos Acumulados</span>
            <div class="count green" id="putott"> </div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc" id="porcentajestt"></i>% </i> En el mes<span class="oi oi-target"></span></span>
          </div>

        </div>


        <div class="container">
          <div class="col-md-12">
             
              <div class="card card-primary">
                <div class="input-group">
                  <input type="text" class="form-control" id="texto" placeholder="Ingrese la Cedula">
                  <div class="input-group-append"><span class="input-group-text">Buscar</span></div>
                </div>
                <div id="resultados" class="bg-light border">
                </div>
              </div>
               
          </div>
          <div class="col-md-12">
              @if(Session::has('info'))
              <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
                  <center> <strong>{{ Session::get('info') }}</strong></center>  
              </div>
              @endif
              <div class="alert alert-secondary" role="alert">
                  Solo clientes que NO cuenten con un estado de Cerrado en el Sistema de Ventas como: <small>(Venta, No Desean, No Aplican, Fuera de Zona)</small> 
                </div>
              <div class="card card-success">
                <div class="card-header">
                  <h3 class="card-title">Agendos Para Hoy {{ $agendadosHOY->count() }}</h3>
                </div>
                <div class="card-body">


                    <div class="card">
                        <div class="card-body">
                          <table class="table table-striped" >
                            <thead>
                            <tr>
                              <th style="width: 10px">Cedula</th>
                              <th style="width: 10px" >Nombre</th>
                              <th style="width: 10px">Campaña</th>
                              <th style="width: 10px">Contacto</th>
                              <th style="width: 10px">LLamar</th>
                              <th style="width: 10px">Comentario</th>
                              <th style="width: 10px">Fecha</th>
                              <th style="width: 10px">Hora</th>
                              <th style="width: 10px">Estado</th>
                              <th >Accion</th>
                            </tr>
                          </thead>
                        <!--  <tbody id="tablaDatos" >-->
                            <tbody>
                              @foreach ($agendadosHOY as $agendas)
                              <tr>
                                  <td style="width: 10px">{{ $agendas->cedula }}</td>
                                  <td style="width: 10px">{{ $agendas->nombres }}</td>
                                  <td style="width: 10px">{{ $agendas->campanadescripcion }}</td>
                                  <td style="width: 10px">{{ $agendas->telefonoContacto }}</td>
                                  <td style="width: 10px">{{ $agendas->telefonoNuevo }}</td>
                                  <td style="width: 10px">{{ $agendas->comentario }}</td>
                                  <td style="width: 10px">{{ $agendas->fecha }}</td>
                                  <td style="width: 10px">{{ Carbon\Carbon::parse($agendas->hora )->format('h:m') }}</td>
                                  
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
                                  
                                  @if ($agendas->dias < 0)
                                  <td class="{{ $color }}"><i class="far fa-clock"></i>  Vencido</td>
                                  @else  
                                      @if ($agendas->dias == 0)
                                  <td class="{{ $color }}"><i class="far fa-clock"></i>  HOY </td>
                                      @else
                                  <td class="{{ $color }}"><i class="fal fa-battery-half"></i>{{ $agendas->dias }} Dias</td>
                                      @endif
                                  @endif
                                  @if ($agendas->cerrado!=0)
                                    <td ><span class="spinner-grow text-success"></span> </td>
                                  @endif
                                  <td > <a href="{{ route('clienteventas.show', [$agendas->campana,$agendas->cedula]) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a></td>
                                  
                              
                                </tr>
                              @endforeach
                          </tbody>
                          </table>
                        </div>
                   
                      </div>
               
              </div>
            </div> 
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Agendas Pendientes {{ $agendados->count() }}</h3>
              </div>

              <div class="card-body">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-striped" >
                      <thead>
                        <tr>
                          <th style="width: 10px">Cedula</th>
                          <th style="width: 10px" >Nombre</th>
                          <th style="width: 10px">Campaña</th>
                          <th style="width: 10px">Contacto</th>
                          <th style="width: 10px">LLamar</th>
                          <th style="width: 10px">Comentario</th>
                          <th style="width: 10px">Fecha</th>
                          <th style="width: 10px">Hora</th>
                          <th style="width: 10px">Estado</th>
                          <th>Accion</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($agendados as $agendas)
                        <tr>
                          <td style="width: 10px">{{ $agendas->cedula }}</td>
                          <td style="width: 10px">{{ $agendas->nombres }}</td>
                          <td style="width: 10px">{{ $agendas->campanadescripcion }}</td>
                          <td style="width: 10px">{{ $agendas->telefonoContacto }}</td>
                          <td style="width: 10px">{{ $agendas->telefonoNuevo }}</td>
                          <td style="width: 10px">{{ $agendas->comentario }}</td>
                          <td style="width: 10px">{{ $agendas->fecha }}</td>
                          <td style="width: 10px">{{ Carbon\Carbon::parse($agendas->hora )->format('h:m') }}</td>
                                
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
                              @if ($agendas->dias < 0)
                              <td class="{{ $color }}"><i class="far fa-clock"></i>  Vencido</td>
                              @else  
                                  @if ($agendas->dias == 0)
                              <td class="{{ $color }}"><i class="far fa-clock"></i>  HOY</td>
                                  @else
                              <td class="{{ $color }}"><i class="far fa-clock"></i> {{ $agendas->dias }} Dias</td>
                                  @endif
                              @endif
                              @if ($agendas->cerrado!=0)
                                <td ><span class="spinner-grow text-success"></span> </td>
                              @endif
                              <td > <a href="{{ route('clienteventas.show', [$agendas->campana,$agendas->cedula]) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a></td>
                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Agendos Vencidos {{ $agendadosvencidos->count() }} </h3>
              </div>
              <div class="card-body">


                  <div class="card">
                      <div class="card-body">
                        <table class="table table-striped" >
                          <thead>
                          <tr>
                            <th style="width: 10px">Cedula</th>
                            <th style="width: 10px" >Nombre</th>
                            <th style="width: 10px">Campaña</th>
                            <th style="width: 10px">Contacto</th>
                            <th style="width: 10px">LLamar</th>
                            <th style="width: 10px">Comentario</th>
                            <th style="width: 10px">Fecha</th>
                            <th style="width: 10px">Hora</th>
                            <th style="width: 10px">Estado</th>
                            <th>Accion</th>
                            
                          </tr>
                        </thead>
               
                          <tbody>
                            @foreach ($agendadosvencidos as $agendas)
                            <tr>
                                <td style="width: 10px">{{ $agendas->cedula }}</td>
                                <td style="width: 10px">{{ $agendas->nombres }}</td>
                                <td style="width: 10px">{{ $agendas->campanadescripcion }}</td>
                                <td style="width: 10px">{{ $agendas->telefonoContacto }}</td>
                                <td style="width: 10px">{{ $agendas->telefonoNuevo }}</td>
                                <td style="width: 10px">{{ $agendas->comentario }}</td>
                                <td style="width: 10px">{{ $agendas->fecha }}</td>
                                <td style="width: 10px">{{ Carbon\Carbon::parse($agendas->hora )->format('h:m') }}</td>
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
                                @if ($agendas->dias < 0)
                                      <td class="{{ $color }}"><i class="far fa-clock"></i> {{ $agendas->dias }} Vencido</td>
                                @else  
                                    @if ($agendas->dias >= 0)
                                      <td class="{{ $color }}"><i class="far fa-clock"></i>  HOY</td>
                                    @else
                                      <td class="{{ $color }}"><i class="far fa-clock"></i> {{ $agendas->dias }} Dias</td>
                                    @endif
                                @endif
                               
                                    <td>  @if ($agendas->cerrado!=0)
                                            <span class="spinner-grow text-success "></span> 
                                          @endif
                                   <a href="{{ route('clienteventas.show', [$agendas->campana,$agendas->cedula]) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a></td>
                            
                              </tr>
                            @endforeach
                        </tbody>
                        </table>
                        
                       
                      </div>
                 
                    </div>
             
            
                  </div>
          </div> 
          
          <!-- tocados hoy-->

          <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">TOCADOS HOY {{ $tocados->count() }}</h3>
              </div>

              <div class="card-body">
                <div class="card">
                  <div class="card-body">
                    <table class="table table-striped" >
                      <thead>
                        <tr>
                          <th style="width: 10px">Cedula</th>
                          <th style="width: 10px" >Nombre</th>
                          <th style="width: 10px">Campaña</th>
                          <th style="width: 10px">Contacto</th>
                          <th style="width: 10px">LLamar</th>
                          <th style="width: 10px">Comentario</th>
                          <th style="width: 10px">Fecha</th>
                          <th style="width: 10px">Hora</th>
                          <th style="width: 10px">Estado</th>
                          <th>Accion</th>
                          <th>TOCADO</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($tocados as $tocado)
                        <tr>
                          <td style="width: 10px">{{ $tocado->cedula }}</td>
                          <td style="width: 10px">{{ $tocado->nombres }}</td>
                          <td style="width: 10px">{{ $tocado->campanadescripcion }}</td>
                          <td style="width: 10px">{{ $tocado->telefonoContacto }}</td>
                          <td style="width: 10px">{{ $tocado->telefonoNuevo }}</td>
                          <td style="width: 10px">{{ $tocado->comentario }}</td>
                          <td style="width: 10px">{{ $tocado->fecha }}</td>
                          <td style="width: 10px">{{ Carbon\Carbon::parse($tocado->hora )->format('h:m') }}</td>
                                
                          @php
                          $color = "";
                          @endphp
                              @if ($tocado->dias < 0)
                                  @php
                                  $color = "badge badge-danger";
                                  @endphp
                              @else
                                  @if ($tocado->dias == 0)
                                      @php
                                      $color = "badge badge-warning";
                                      @endphp
                                  @else
                                  
                                      @php
                                      $color = "badge badge-success";
                                      @endphp
                              
                                  @endif
                              @endif
                              @if ($tocado->estado =='G')
                              <td class="btn btn-sm btn-info"></i>XGESTION</td>
                              @else 
                              @if ($tocado->dias < 0)
                              <td class="{{ $color }}"><i class="far fa-clock"></i>  Vencido</td>
                              @else

                                

                                  @if ($tocado->dias == 0)
                                    <td class="{{ $color }}"><i class="far fa-clock"></i>  HOY</td>
                                  @else
                                    <td class="{{ $color }}"><i class="far fa-clock"></i> {{ $tocado->dias }} Dias</td>
                                  @endif
                              @endif
                              @endif
                              @if ($tocado->cerrado!=0)
                                <td ><span class="spinner-grow text-success"></span> </td>
                              @endif
                              <td > <a href="{{ route('clienteventas.show', [$tocado->campana,$tocado->cedula]) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a></td>
                              <td style="width: 10px">{{ $tocado->tocadodate }}</td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

          <!--/tocados hoy-->



        </div>

           <!-- tocados hoy-->

           <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">ASIGNACIÓN {{ $xgestion->count() }}</h3>
            </div>

            <div class="card-body">
              <div class="card">
                <div class="card-body">
                  <table class="table table-striped" >
                    <thead>
                      <tr>
                        <th style="width: 10px">Cedula</th>
                        <th style="width: 10px" >Nombre</th>
                        <th style="width: 10px">Campaña</th>
                        <th style="width: 10px">Contacto</th>
                        <th style="width: 10px">LLamar</th>
                        <th style="width: 10px">Comentario</th>
                        <th style="width: 10px">Fecha</th>
                        <th style="width: 10px">Hora</th>
                        <th style="width: 10px">Estado</th>
                        <th>Accion</th>
                        <th>TOCADO</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($xgestion as $xgestions)
                      <tr>
                        <td style="width: 10px">{{ $xgestions->cedula }}</td>
                        <td style="width: 10px">{{ $xgestions->nombres }}</td>
                        <td style="width: 10px">{{ $xgestions->campanadescripcion }}</td>
                        <td style="width: 10px">{{ $xgestions->telefonoContacto }}</td>
                        <td style="width: 10px">{{ $xgestions->telefonoNuevo }}</td>
                        <td style="width: 10px">{{ $xgestions->comentario }}</td>
                        <td style="width: 10px">{{ $xgestions->fecha }}</td>
                        <td style="width: 10px">{{ Carbon\Carbon::parse($xgestions->hora )->format('h:m') }}</td>
                              
                        
                         
                            <td class="btn btn-sm btn-info"></i>XGESTION</td>
                           
                            <td > <a href="{{ route('clienteventas.show', [$xgestions->campana,$xgestions->cedula]) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a></td>
                            <td style="width: 10px">{{ $xgestions->tocadodate }}</td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

        <!--/tocados xgestion-->
       

        
     
@endsection

@section('script')


<script src="{{ asset('js/Bandeja/jquery.min.js') }}" ></script>

<script src="{{ asset('js/Bandeja/Ventas/bandejaagente.js') }}" ></script>
<script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}" ></script>
<script src="{{ asset('datatables/jquery.dataTables.js') }}" ></script>


<script src="{{ asset('datatables/dataTables.bootstrap4.js') }}" ></script>
<script>
    $(function () {
      $("#example1").DataTable();
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
      });
    });
  </script>

  <script>
    window.addEventListener('load',function(){
        document.getElementById("texto").addEventListener("keyup", () => {
            if((document.getElementById("texto").value.length)>=0)
                fetch(`buscador?texto=${document.getElementById("texto").value}`,{ method:'get' })
                .then(response  =>  response.text() )
                .then(html      =>  {   document.getElementById("resultados").innerHTML = html  })
            else
                document.getElementById("resultados").innerHTML = "No encotrado";
        })
    });  
  </script>

<script>
    window.onload = function(){
      var contenedor = document.getElementById('contenedor_carga');
      contenedor.style.visibility = 'hidden';
      contenedor.style.opacity = 0;
    }
  </script>

  
@endsection