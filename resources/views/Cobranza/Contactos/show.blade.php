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
  @if (count($errors) > 0)
  <div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h5><i class="icon fas fa-exclamation-triangle"></i>Error</h5>  
    <ul>
    </ul>
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

              
              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Deuda</b> <a class="float-right">{{ $datos->valordeuda }}</a>
                </li>
                <li class="list-group-item">
                  <b>Saldo</b> <a class="float-right">{{ $datos->saldodeuda }}</a>
                </li>
                <li class="list-group-item">
                  <b>Couta Promedio</b> <a class="float-right">0</a>
                </li>
              </ul>

              
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
              
        
            </div>
          </div>
        </div>
        <div class="col-md-9">
          <div class="card">

            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link " href="#contactos" data-toggle="tab"><span style="font-size: 35px; color: #2C3E50;"><i class="nav-icon fas fa-address-book" ></samp></i></a></li>
                <li class="nav-item"><a class="nav-link" href="#gestiones" data-toggle="tab"><span style="font-size: 35px; color: #2C3E50;"><i class="nav-icon fas fa-user-tie"></i></samp></a></li>
              </ul>
            </div><!-- /.card-header -->
              
            <div class="card-body">
              <div class="tab-content">
                
                <div class=" tab-pane" id="contactos">
                  <h4 class=" text-center">Información de Contacto Titular</h4>
                  <div class="table-responsive">
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
                  </div>
                  <div class="row" id="agregartelefonos">
                    <div class="col-lg-12">
                      <!-- Button trigger modal -->
                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".telefono"><i class="fas fa-plus-circle"></i> Telefono</button>
                    </div>
                  </div>
                  <!-- Modal telefono-->
                  <div class="modal fade telefono" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-xl" role="document">
                      <div class="modal-content">
                        {!! Form::open(['route' => ['contactosAdd', $idc]]) !!}
                              {{csrf_field()}}
                                <div class="modal-body">
                                  @include('Cobranza.Contactos.web.contactos')
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                  <button type="submit" class="btn btn-primary">Agregar</button>
                                </div>
                        {!! Form::close() !!}
                      </div>
                    </div>
                  </div>
                  <!-- Modal telefono-->
                </div>

                <div class=" active tab-pane" id="gestiones">
                  <div class="container">

                    @if(Session::has('info'))
                      <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                          <center> <strong>{{ Session::get('info') }}</strong></center>  
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
                    <div class="row">
                      <div class="col">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bd-example-modal-xl"><i class="fas fa-plus-circle"></i> Recaudación</button>
                      </div>
                      <div class="col">
                        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".compromisos"><i class="fas fa-plus-circle"></i> Compromiso</button>
                      </div>
                      <div class="col">
                        <gestion-component :id="{{ $idc }}" :cedula="{{ $ced }}"></gestion-component>
                      </div>
                    </div>
                    <hr>
                     <!-- Modal recaudacion -->
                      <div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl" role="document">
                          <div class="modal-content">
                            {!! Form::open(['route' => ['recaudacionesAdd', $idc], 'enctype' => 'multipart/form-data']) !!}
                                  {{csrf_field()}}
                                    <div class="modal-body">
                                      @include('Cobranza.Contactos.web.formulario')
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                      <button type="submit" class="btn btn-primary">Agregar</button>
                                    </div>
                            {!! Form::close() !!}
                          </div>
                        </div>
                      </div>
                    <!-- / Modal recaudacion-->

                    <!-- Modal Compromiso-->
                    <div class="modal fade compromisos" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-xl" role="document">
                        <div class="modal-content">
                          {!! Form::open(['route' => ['compromisoAdd', $idc], 'enctype' => 'multipart/form-data']) !!}
                                {{csrf_field()}}
                                  <div class="modal-body">
                                    @include('Cobranza.Contactos.web.formulariocompromiso')
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Agregar</button>
                                  </div>
                          {!! Form::close() !!}
                        </div>
                      </div>
                    </div>
                    <!-- Modal Compromiso-->
                    <div class="container">
                      <div class="row">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#recaudaciones" role="tab" aria-controls="recaudaciones" aria-selected="true">Recaudaciones</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#compromisos" role="tab" aria-controls="compromisos" aria-selected="false">Compromisos</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#X" role="tab" aria-controls="X" aria-selected="false">Gestiones</a>
                          </li>
                        </ul>
                      </div>
                    </div>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="recaudaciones"  aria-labelledby="home-tab">
                        <getrecaudaciones-component :id="{{ $idc }}" :cedula="{{ $ced }}"  />
                      </div>
                      <div class="tab-pane fade" id="compromisos"  aria-labelledby="profile-tab">
                        <gestionescompromiso-component :id="{{ $idc }}" :cedula="{{ $ced }}" />                        
                      </div>
                      <div class="tab-pane fade" id="X"  aria-labelledby="contact-tab">
                        <gestiones-component :id="{{ $idc }}" :cedula="{{ $ced }}" :idcampana="{{ $datos->idcampana }}"/>
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
  </div>
</section>

@endsection
