@extends('layouts.app')

@section('title', 'Contactos | Cobranza')
@section('content')

<section class="content">
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
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-3">
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Datos Personales</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fas fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="card-body box-profile">
            <div class="text-center">
              <img class="profile-user-img img-fluid img-circle" src="{{ asset('contacto.jpg') }}" alt="User profile picture">
            </div>
            <h3 class="profile-username text-center">{{ $datos->Nombres }}</h3>
              <p class="text-muted  text-center"> <strong> Cedula:</strong>     {{ $datos->Identificacion }}</p>
              @if (!empty($datosgenerales->cedula ))
              <p class="text-muted  text-center"> <strong> Nacionalidad:</strong> {{ $datosgenerales->DES_NACIONALID }} </p>
            
              <p class="text-muted  text-center"> <strong> Ciudadania:</strong> {{ $datosgenerales->DES_CIUDADANIA }}</p>
              <p class="text-muted  text-center"> <strong> Estado Civil:</strong> {{ $datosgenerales->DES_ESTADO_CIVIL }} </p>
              
              <p class="text-muted text-center "><strong>Fecha Nacimiento:</strong>  {{ $datosgenerales->FECH_NAC }}  &nbsp;<strong>Edad:</strong>  {{ $datosgenerales->edad }} &nbsp;</p>
              @endif
              @if (!is_null($ruc))
              <hr>
              <p class="text-muted text-center "><strong>RUC:</strong>  {{ $ruc->NUMERO_RUC }}&nbsp; <strong>Estado:</strong>  {{ $ruc->ESTADO_CONTRIBUYENTE }} &nbsp; <strong>Tipo:</strong>  {{ $ruc->TIPO_CONTRIBUYENTE }}  </p>
              <p class="text-muted text-center "><strong>Razon:</strong>  {{ $ruc->RAZON_SOCIAL }} </p>

              @endif
              
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Deuda</b> <a class="float-right">{{ $datos->ValorDeuda }}</a>
                </li>
                <li class="list-group-item">
                  <b>Saldo</b> <a class="float-right">{{ $datos->SaldoDeuda }}</a>
                </li>
                <li class="list-group-item">
                  <b>Couta Promedio</b> <a class="float-right">0</a>
                </li>
              </ul>

              <a href="{{ route('clientes.show', [$datos->IdCampaña , $datos->Identificacion]) }}" class="btn btn-primary btn-block"><b>Ver Gestiones</b></a>
          </div>
        </div>
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Datos Adicionales</h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            @if (!empty($datosgenerales->cedula ))
              <strong><i class="fas fa-book mr-1"></i> Profesion</strong>
              <p class="text-muted">
                {{ $datosgenerales->DES_PROFESION }}
              </p>
            @endif
            <hr>
            <!-- DIRECCIONES -->
            <strong><i class="fas fa-map-marker-alt mr-1"></i> Direcciones</strong>
              <p class="text-muted">{{ $datos->DireccionPrincipal }}</p>
              <p class="text-muted">{{ $datos->Campo4 }}</p>
              
              @if (!empty($trabajo->DIRECCION_EMP))
                <strong>Direccion Trabajo</strong>
                  <p class="text-muted">{{ $trabajo->DIRECCION_EMP }}</p>
                  <hr>
                @else
              @endif
                
              @if (!empty($medidor->DIRECCION))
                <strong>Direccion CNEL-EP</strong>
                  <p class="text-muted">{{ $medidor->DIRECCION }} / {{ $medidor->SECTOR }} / {{ $medidor->PARROQUIA }} / {{ $medidor->CANTON }} / {{ $medidor->PROVINCIA }}</p>
                  <hr>
                @else
              @endif
              
              @if (!empty($agua->DIRECCION))
                <strong>Direccion Empresa Interagua</strong>
                  <p class="text-muted">{{ $agua->DIRECCION }}</p>
                  <hr>
                @else
              @endif
              
              @if (!empty($agua->DIRECCION))
                <strong>Direccion Empresa Interagua</strong>
                  <p class="text-muted">{{ $agua->DIRECCION }}</p>
                  <hr>
                @else
              @endif
                  <hr>
                <!-- /DIRECCIONES -->
                  <strong><i class="fas fa-pencil-alt mr-1"></i> Email</strong>
                    <p class="text-muted">
                      @if (!empty($medidor->EMAIL))
                        <span class="tag tag-danger">{{ $medidor->EMAIL }}</span>
                      @else
                        @endif
                        @if (!empty($trabajo->EMAIL))
                          <span class="tag tag-danger">{{ $trabajo->EMAIL }}</span>
                        @else
                      @endif
                    </p>
            </div>
         </div>
      </div>
      <div class="col-md-9">
        <div class="card">

          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Datos Contactos</a></li>
              <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Datos Trabajo</a></li>
              <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Datos Comerciales</a></li>
              <li class="nav-item"><a class="nav-link" href="#obs" data-toggle="tab">Observaciones</a></li>
            </ul>
          </div><!-- /.card-header -->
             
          <div class="card-body">
            <div class="tab-content">
              <div class="active tab-pane" id="activity">
                <h4 class=" text-center">Información de Contacto Titular</h4>
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th class=" text-center" style="width: 7px"><i class="fas fa-phone-square-alt"></i></th>
                      <th class=" text-center" style="width: 7px"><i class="fas fa-phone-square-alt"></i></th>
                      <th class=" text-center" style="width: 7px"><i class="fas fa-phone-square-alt"></i></th>
                      <th class=" text-center" style="width: 7px"><i class="fas fa-phone-square-alt"></i></th>
                      <th class=" text-center" style="width: 7px"><i class="fas fa-mobile-alt"></i></th>
                      <th class=" text-center" style="width: 7px"><i class="fas fa-mobile-alt"></i></th>
                      <th class=" text-center" style="width: 7px"><i class="fas fa-mobile-alt"></i></th>
                      <th class=" text-center" style="width: 7px"><i class="fas fa-mobile-alt"></i></th>
                      <th class=" text-center" style="width: 7px"><i class="fas fa-mobile-alt"></i></th>
                      <th class=" text-center" style="width: 7px"><i class="fas fa-mobile-alt"></i></th>
                      <th class=" text-center" style="width: 7px"><i class="fas fa-mobile-alt"></i></th>
                      <th class=" text-center" style="width: 7px"><i class="fas fa-mobile-alt"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($telefonos as  $item)
                      <tr>
                        <td class=" text-center" style="width: 7px">{{ $item->TLF_FIJO1 }}</td>
                        <td class=" text-center" style="width: 7px">{{ $item->TLF_FIJO2 }}</td>
                        <td class=" text-center" style="width: 7px">{{ $item->TLF_FIJO3 }}</td>
                        <td class=" text-center" style="width: 7px">{{ $item->TLF_FIJO4 }}</td>
                        <td class=" text-center" style="width: 7px">{{ $item->CEL1_NVO1 }}</td>
                        <td class=" text-center" style="width: 7px">{{ $item->CEL2_NVO1 }}</td>
                        <td class=" text-center" style="width: 7px">{{ $item->CEL3_NVO1 }}</td>
                        <td class=" text-center" style="width: 7px">{{ $item->CEL4_NVO1 }}</td>
                        <td class=" text-center" style="width: 7px">{{ $item->CEL5_NVO1 }}</td>
                        <td class=" text-center" style="width: 7px">{{ $item->CEL6_NVO1 }}</td>
                        <td class=" text-center" style="width: 7px">{{ $item->CEL7_NVO1 }}</td>
                        <td class=" text-center" style="width: 7px">{{ $item->CEL8_NVO1 }}</td>
                      </tr>                           
                    @endforeach
                  </tbody>
                </table>
                <hr>
                <div class="post clearfix">
                  <div class="user-block">
                    <h4 class=" text-center">Información de Contactos de los Parientes mas Cercanos</h4>
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th class=" text-center" style="width: 7px">Cedula</th>
                          <th class=" text-center" style="width: 7px">Parentesco</th>
                          <th class=" text-center" >Nombres</th>
                          <th class=" text-center" >Estado Civil</th>
                          <th class=" text-center" >Edad</th>
                          <th class=" text-center" >Profesion</th>
                          <th class=" text-center" style="width: 7px"><i class="fas fa-phone-square-alt"></i></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($telefonosparentescos as $item)
                        <tr>
                          @if (!empty($item->TLF_FIJO1) || !empty($item->TLF_FIJO2) || !empty($item->TLF_FIJO3) || !empty($item->TLF_FIJO4) 
                                  || !empty($item->CEL1_NVO1) || !empty($item->CEL2_NVO1) || !empty($item->CEL3_NVO1) || !empty($item->CEL4_NVO1)
                                  || !empty($item->CEL5_NVO1) || !empty($item->CEL6_NVO1) || !empty($item->CEL7_NVO1) || !empty($item->CEL8_NVO1))
                                  
                            
                            <td class=" text-center">{{ $item->CED_PARIENETE }}</td>
                            <td class=" text-center" style="width: 7px">{{ $item->DESC_PARIENTE }}</td>
                            <td class=" text-center">{{ $item->NOMBRES }}</td>
                            <td class=" text-center">{{ $item->DES_ESTADO_CIVIL }}</td>
                            <td class=" text-center">{{ $item->edad }}</td>
                            <td class=" text-center">{{ $item->DES_PROFESION }}</td>
                            <td class=" text-center" style="width: 7px">
                              @endif  
                                <ul>
                                    @if (!empty($item->TLF_FIJO1))
                                        <li>{{ $item->TLF_FIJO1 }}</li>
                                    @endif

                                    @if (!empty($item->TLF_FIJO2))
                                        <li>{{ $item->TLF_FIJO2 }}</li>
                                    @endif

                                    @if (!empty($item->TLF_FIJO3))
                                        <li>{{ $item->TLF_FIJO3 }}</li>
                                      @endif

                                    @if (!empty($item->TLF_FIJO4))
                                        <li>{{ $item->TLF_FIJO4 }}</li>
                                    @endif

                                    @if (!empty($item->CEL1_NVO1))
                                        <li>{{ $item->CEL1_NVO1 }}</li>
                                      @endif

                                      @if (!empty($item->CEL2_NVO1))
                                      <li>{{ $item->CEL2_NVO1 }}</li>
                                    @endif

                                    @if (!empty($item->CEL3_NVO1))
                                    <li>{{ $item->CEL3_NVO1 }}</li>
                                    @endif

                                    @if (!empty($item->CEL4_NVO1))
                                    <li>{{ $item->CEL4_NVO1 }}</li>
                                    @endif

                                    @if (!empty($item->CEL5_NVO1))
                                    <li>{{ $item->CEL5_NVO1 }}</li>
                                    @endif

                                    @if (!empty($item->CEL6_NVO1))
                                    <li>{{ $item->CEL6_NVO1 }}</li>
                                    @endif

                                    @if (!empty($item->CEL7_NVO1))
                                    <li>{{ $item->CEL7_NVO1 }}</li>
                                    @endif

                                    @if (!empty($item->CEL8_NVO1))
                                    <li>{{ $item->CEL8_NVO1 }}</li>
                                @endif
                                </ul>
                              </td>
                          </tr>
                          @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="timeline">
                <ul class="timeline timeline-inverse">
                  <li class="time-label">
                    <span class="bg-primary">
                      INFORMACION LABORAL TITULAR
                    </span>
                  </li>
                  <div class="row">
                    <div class="col-6">
                      <li>
                        <i class="fas fa-envelope bg-primary"></i>
                        <div class="timeline-item">
                          <h5 class="timeline-header alert alert-primary "><strong>DATOS DE LA EMPRESA DONDE TRABAJA </strong> </h5> 
                          @if (!empty($trabajo->CEDULA))
                            <p class="text-center"> <strong>Nombre de la Empresa: &nbsp;</strong> {{ $trabajo->NOMBRE_EMP }}</p>
                            <p class="text-center"> <strong>Tipo de Empresa: &nbsp;</strong> {{ $trabajo->TIPO_EMPRESA }}</p>
                            <p class="text-center"> <strong>Ruc: &nbsp;</strong>  {{ $trabajo->RUC }}</p>
                            <p class="text-center"> <strong>Dirección: &nbsp;</strong> {{ $trabajo->DIRECCION_EMP }}</p>
                            <p class="text-center"> <strong>Telefono: &nbsp;</strong>  {{ $trabajo->TLF_EMP }}</p>
                            <p class="text-center"> <strong>Salario: &nbsp;$ </strong>  {{ $trabajo->SALARIO }}</p>
                            <p class="text-center"> <strong>Fecha Ingreso: &nbsp;</strong>  {{ $trabajo->FECH_ING }}</p>
                            <hr>
                          @endif
                        </div>
                      </li>
                    </div>
                    <div class="col-6">
                      <li>
                        <i class="fas fa-envelope bg-primary"></i>
                        <div class="timeline-item">
                          <h5 class="timeline-header alert alert-primary "> <strong>DATOS DE TITULAR EN LA EMPRESA</strong> </h5>
                          <div class="timeline-body">
                            @if (!empty($trabajo->CEDULA))
                              <p class="text-center"><strong>Dirección: </strong> &nbsp; {{ $trabajo->DIRE_TIT }}</p> 
                              <p class="text-center"><strong>Telefono Convencional: </strong> &nbsp; {{ $trabajo->CASATT }}</p> 
                              <p class="text-center"><strong>Telefono Celular: </strong> &nbsp; {{ $trabajo->CELUTT }}</p> 
                              <p class="text-center"><strong>Email: </strong> &nbsp; {{ $trabajo->EMAIL }}</p> 
                            @endif
                          </div>
                        </div>
                      </li>
                    </div>
                  </div>
                  <br><hr>
                  <li class="time-label">
                    <span class="bg-success">
                        INFORMACION LABORAL DE LOS PARIENTES
                    </span>
                  </li>
                  <!-- PARIENTES-->

                  @foreach ($trabajoparientes as $trabajopariente)
                    <div class="row">
                      <div class="col-6">
                        <li>
                          <i class="fas fa-envelope bg-success"></i>
                          <div class="timeline-item">
                            <h5 class="timeline-header alert alert-success "><strong>DATOS DE LA EMPRESA DONDE TRABAJA </strong> </h5> 
                            <div class="card"> 
                              <strong class="text-center">  Pariente:  &nbsp;
                                {{  $trabajopariente->cedula  }} &nbsp;
                                {{  $trabajopariente->NOMBRES  }}&nbsp;
                                {  <i>{{ $trabajopariente->DESC_PARIENTE  }} </i> } 
                              </strong>
                            </div>
                            <br>
                            <p class="text-center"> <strong>Nombre de la Empresa: &nbsp;</strong> {{ $trabajopariente->NOMBRE_EMP }}</p>
                            <p class="text-center"> <strong>Tipo de Empresa: &nbsp;</strong> {{ $trabajopariente->TIPO_EMPRESA }}</p>
                            <p class="text-center"> <strong>Ruc: &nbsp;</strong>  {{ $trabajopariente->RUC }}</p>
                            <p class="text-center"> <strong>Dirección: &nbsp;</strong> {{ $trabajopariente->DIRECCION_EMP }}</p>
                            <p class="text-center"> <strong>Telefono: &nbsp;</strong>  {{ $trabajopariente->TLF_EMP }}</p>
                            <p class="text-center"> <strong>Salario: &nbsp; $ </strong> {{ $trabajopariente->SALARIO }}</p>
                            <p class="text-center"> <strong>Fecha Ingreso: &nbsp;</strong>  {{ $trabajopariente->FECH_ING }}</p>
                          </div>
                        </li>
                      </div>
                      <div class="col-6">
                        <li>
                          <i class="fas fa-envelope bg-success"></i>
                          <div class="timeline-item">
                            <h5 class="timeline-header alert alert-success "> <strong>DATOS DEL PARIENTE EN LA EMPRESA</strong> </h5>
                            <div class="timeline-body">
                              <p class="text-center"><strong>Dirección: </strong> &nbsp; {{ $trabajopariente->DIRE_TIT }}</p> 
                              <p class="text-center"><strong>Telefono Convencional: </strong> &nbsp; {{ $trabajopariente->CASATT }}</p> 
                              <p class="text-center"><strong>Telefono Celular: </strong> &nbsp; {{ $trabajopariente->CELUTT }}</p> 
                              <p class="text-center"><strong>Email: </strong> &nbsp; {{ $trabajopariente->EMAIL }}</p> 
                            </div>
                          </div>
                        </li>
                      </div>
                    </div>
                  @endforeach

                  <!-- / PARIENTES-->
                  <li>
                    <i class="far fa-clock bg-gray"></i>
                  </li>
                </ul>
              </div>
              <div class="tab-pane" id="settings">
                <div class="col-12">
                  <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                      <h3 class="profile-username text-center">INFORMACIÓN SEGÚN EL SERVICIO DE RENTA</h3>
                      <table class="table table-hover">
                        @if (!empty($ruc->NUMERO_RUC))
                          <tr>
                            <th>RUC</th>
                            <td>{{ $ruc->NUMERO_RUC }} </td>
                            <td> 
                              @if ($ruc->ESTADO_CONTRIBUYENTE == "SUSPENDIDO")
                                <span class="bg-danger"> SUSPENDIDO  </span></li>
                              @else
                              @if ($ruc->ESTADO_CONTRIBUYENTE == "PASIVO")
                                <span class="bg-warning" > PASIVO  </span></li>
                              @else
                                <span class="bg-success" > ACTIVO  </span></li>
                              @endif
                              @endif
                            </td>
                          </tr>
                          <tr>
                            <th >Nombre Comercial</th>
                            <td>{{ $item->NOMBRE_FANTASIA_COMERCIAL }} /  {{ $item->NOMBRE_COMERCIAL }}</td>
                            <td></td>
                          </tr>
                          <tr>
                            <th >Razón Social</th>
                            <td>{{ $ruc->RAZON_SOCIAL }}</td>
                            <td></td>
                          </tr>
                          <tr>
                            <th>Actividad</th>
                            <td>{{ $ruc->ACTIVIDAD_ECONOMICA }}</td>
                            <td></td>
                          </tr>
                          <tr>
                            <th >INICIO Actividades </th>
                            <td> {{ $ruc->FECHA_INICIO_ACTIVIDADES }}</td>
                            <th >SUSPENSION </th> 
                            <td>{{ $ruc->FECHA_SUSPENSION_DEFINITIVA }}</td>
                          </tr>
                          <tr>
                            <th >Contribuyente </th>
                            <td> {{ $ruc->TIPO_CONTRIBUYENTE }}</td>
                          </tr>
                          <tr>
                            <th >Dirección </th> 
                            <td>
                              @if (!empty($ruc->CALLE) )
                                {{ $ruc->CALLE }} 
                                @if (!empty($ruc->NUMERO))
                                  / {{ $ruc->NUMERO }} 
                                @else
                                    @if (!empty($ruc->INTERSECCION))
                                    / {{ $ruc->INTERSECCION }} 
                                    @else
                                        @if (!empty($ruc->ESTADO_ESTABLECIMIENTO))
                                        / {{ $ruc->ESTADO_ESTABLECIMIENTO }} 
                                        @else
                                            @if (!empty($ruc->DESCRIPCION_PROVINCIA))
                                            / {{ $ruc->DESCRIPCION_PROVINCIA }}
                                            @else
                                                @if (!empty($ruc->DESCRIPCION_CANTON))
                                                / {{ $ruc->DESCRIPCION_CANTON }}
                                                @else
                                                    @if (!empty($ruc->DESCRIPCION_PARROQUIA))
                                                    / {{ $ruc->DESCRIPCION_PARROQUIA }}
                                                    @else
                                                        <p>...</p>
                                                    @endif
                                                @endif
                                            @endif
                                        @endif
                                    @endif
                                @endif
                              </td>
                              @endif
                          </tr>
                        @endif
                      </table>
                      <a href="#" class="btn btn-primary btn-block"><b></b></a>
                    </div>
                  </div>
                </div>  
                  @foreach ($RUCparientes as $item)
                    <div class="tab-pane" id="settings">
                      <div class="col-12">
                        <div class="card card-primary card-outline">
                          <div class="card-body box-profile">
                            <h3 class="profile-username text-center">INFORMACIÓN SEGÚN EL SERVICIO DE RENTA PARIENTES MAS CERCANOS</h3>
                            <table class="table table-hover">
                              <tr>
                                <th>Parentesco </th>
                                <td>{{ $item->NOMBRES  }}</td>
                                <td>{{ $item->CEDULA  }} </td>
                                <td> {{ $item->DESC_PARIENTE }}</td>
                              </tr>
                              <tr>
                                <th>RUC</th>
                                <td>{{ $item->NUMERO_RUC }} </td>
                                <td> 
                                  @if ($item->ESTADO_CONTRIBUYENTE == "SUSPENDIDO")
                                    <span class="bg-danger"> SUSPENDIDO  </span></li>
                                  @else
                                  @if ($item->ESTADO_CONTRIBUYENTE == "PASIVO")
                                    <span class="bg-warning" > PASIVO  </span></li>
                                  @else
                                    <span class="bg-success" > ACTIVO  </span></li>
                                  @endif
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <th >Nombre Comercial</th>
                                <td>{{ $item->NOMBRE_FANTASIA_COMERCIAL }} /  {{ $item->NOMBRE_COMERCIAL }}</td>
                                <td></td>
                              </tr>
                              <tr>
                                <th >Razón Social</th>
                                <td>{{ $item->RAZON_SOCIAL }}</td>
                                <td></td>
                              </tr>
                              <tr>
                                <th>Actividad</th>
                                <td>{{ $item->ACTIVIDAD_ECONOMICA }}</td>
                              <td></td>
                              </tr>
                              <tr>
                                <th >INICIO Actividades </th>
                                <td> {{ $item->FECHA_INICIO_ACTIVIDADES }}</td>
                                <th >SUSPENSION </th> 
                                <td>{{ $item->FECHA_SUSPENSION_DEFINITIVA }}</td>
                              </tr>
                              <tr>
                                <th >Contribuyente </th>
                                <td> {{ $item->TIPO_CONTRIBUYENTE }}</td>
                              </tr>
                              <tr>
                                <th >Dirección </th> 
                                @if (!empty($item->CALLE) )
                                  <td>{{ $item->CALLE }} / {{ $item->NUMERO }} / {{ $item->INTERSECCION }} / {{ $item->ESTADO_ESTABLECIMIENTO }} / {{ $item->DESCRIPCION_PROVINCIA }}
                                      / {{ $item->DESCRIPCION_CANTON }}
                                  </td>
                                @endif
                              </tr>
                            </table>
                            <a href="#" class="btn btn-primary btn-block"><b></b></a>
                           
                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
              </div>
              

              <div class="tab-pane" id="obs">
               <div class="container">
                 <div class="row">
                   <div class="col-6">
                     <h5>Observaciones </h5>
                    
                                    @if (!is_null( $DAMPLUStelefonos))
                            
                                    <!-- https://github.com/Hujjat/laravel-crud/blob/master/app/Http/Controllers/CategoryController.php -->
                                   
                                    <section class="col-lg-12 connectedSortable">
                                            <table class="table table-hover table-condensed">
                                                <thead>
                                                    <th><center><i class="fab fa-whatsapp"></i></center></th>
                                                    <th><center><i class="fas fa-mobile"></i> / <i class="fas fa-sms"></i></center></th>
                                                    <th><center><i class="fas fa-blender-phone"></i></center></th>
                                                    <th><center>Tel. Laboral</center></th>
                                                    <th><center>Extesiòn</center></th>
                                                </thead>
                                                <tbody>
                                                    <td><center>{{ $DAMPLUStelefonos->telefono1 }}</center></td>    
                                                    <td><center>{{ $DAMPLUStelefonos->telefono2 }}</center></td> 
                                                    <td><center>{{ $DAMPLUStelefonos->convencional }}</center></td> 
                                                    <td><center>{{ $DAMPLUStelefonos->convencionaltrabajo }}</center></td> 
                                                    <td><center>{{ $DAMPLUStelefonos->extension }}</center></td> 
                                                    
                                                </tbody>
                                            </table>
                                        </section>

                                        <section class="col-lg-12">
                                          <table class="table table-hover table-condensed">
                                              <thead>
                                                  <th><center><i class="fas fa-house-damage"></i></center></th>
                                                  <th><center>Dir. Laboral</center></th>
                                                  <th><center><i class="fas fa-envelope-open"></i></center></th>
                                                  <th><center><i class="fab fa-battle-net"></i></center></th>
                                              </thead>
                                              <tbody>
                                                  <td><center>{{ $DAMPLUStelefonos->direccioncasa }}</center></td> 
                                                  <td><center>{{ $DAMPLUStelefonos->direcciontrabajo }}</center></td> 
                                                  <td><center>{{ $DAMPLUStelefonos->email }}</center></td> 
                                                  <td><center>{{ $DAMPLUStelefonos->created_at }}</center></td> 
                                                   
                                              </tbody>
                                          </table>

                                          <hr>
                                          <table class="table table-hover table-condensed">
                                            <thead>
                                                <th><center>Estado del Cliente</center></th>
                                                <th><center>Intensiones de Pagar</center></th>
                                                <th><center>Observación</center></th>
                                                <th><center>Contactabilidad</center></th>
                                            </thead>
                                            <tbody>
                                                <td><center>{{ $DAMPLUStelefonos->estadoclientes }}</center></td> 
                                                <td><center>{{ $DAMPLUStelefonos->pagar }}</center></td>
                                                <td><center>{{ $DAMPLUStelefonos->observacionestadocliente }}</center></td>

                                                <td><center>{{ $DAMPLUStelefonos->contesta }}</center></td> 
                                                
                                                 
                                            </tbody>
                                        </table>
                                          <button class="btn btn-info"  data-toggle="modal" data-target="#edit" class="text-center"><i class="fas fa-pen"></i></button>
                                    
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
                                      <h4 class="modal-title" id="myModalLabel">Editar </h4>
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
                              <div class="col-lg-6">
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fas fa-plus"></i></button>
                              </div>
                            </div>
                          <!-- Modal -->
                          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                  <h4 class="modal-title" id="myModalLabel">Agregar </h4>
                                </div>
                                {!! Form::open(['route' => ['DAMPLUStelefonos.agregar', $idc]]) !!}
                                
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

                   </div>
                 </div>
               </div>
              </div>


            </div>
          </div>
                          
        </div>  
      </div>
    </div>
  </div>
</section>

@endsection
