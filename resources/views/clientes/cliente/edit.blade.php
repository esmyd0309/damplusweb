


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12" style="background-color: #E8F8F5">
        <center><h3><strong><div  class="alert alert-light" role="alert">Actualizar</div></strong></h3></center><hr>
            <div class="card" style="background-color: #E3F2FD " >
                <div class="card-header">{{ __('Editar Cliente ') }} </div>

                    <form method="POST" action="{{ route('cliente.update', $cliente->id) }}">
                    {{ method_field('PUT') }}
                        @csrf
 <div class="card-body">
                       

                        <div class="form-group row">
                            <div class="col-md-2">
                                <select name="tipo_documento" id="tipo_documento" class="form-control{{ $errors->has('tipo_documento') ? ' is-invalid' : '' }}" name="tipo_documento"  value="{{ $cliente->tipo_documento }}" >
                               
                                <option  value="">{{ $cliente->tipo_documento }}</option>
                                    <option value="cedula">Cedula</option>
                                    <option value="pasaporte">Pasaporte</option>
                                    <option value="rud">Rud</option>
                                </select>
                            </div>

                            <label><strong>{{ __('Cedula') }}</strong></label>
                            <div class="col-md-2">
                                <input id="cedula" type="number"  class="form-control{{ $errors->has('cedula') ? ' is-invalid' : '' }}" name="cedula" value="{{ $cliente->cedula }}" >
                                @if ($errors->has('cedula'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('cedula') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2">
                            </div>
                            <label><strong>{{ __('Fecha De Nacimiento') }}</strong></label>
                            <div class="col-md-2">
                                <input id="fechanacimiento" type="date"  class="form-control{{ $errors->has('fechanacimiento') ? ' is-invalid' : '' }}" name="fechanacimiento" value="{{ $cliente->fechanacimiento }}" >
                                @if ($errors->has('fechanacimiento'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('fechanacimiento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                </div>
<!-- endbloque 1-->

<!-- bloque 2--><div class="card-body">
                        <div class="form-group row">
                            <label><strong>{{ __('Apellidos') }}</strong></label>
                            <div class="col-md-5">
                                <input id="apellidos" type="text" class="form-control{{ $errors->has('apellidos') ? ' is-invalid' : '' }}" name="apellidos" value="{{ $cliente->apellidos }}" autofocus >
                            </div>
                                
                            <label><strong>{{ __('Nombres') }}</strong></label>
                            <div class="col-md-5">
                                <input id="nombres" type="text" class="form-control{{ $errors->has('nombres') ? ' is-invalid' : '' }}" name="nombres" value="{{ $cliente->nombres }}" autofocus >
                                @if ($errors->has('nombres'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('nombres') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                </div>
<!-- endbloque 2-->

<!-- bloque 3-->
                    <div class="card-body">
                        <div class="form-group row">
                            
                            <label><strong>{{ __('Direccion') }}</strong></label>
                            <div class="col-md-5">
                                <input id="direccion" type="text" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="{{ $cliente->direccion }}" autofocus >
                            </div>


                                
                            <label><strong>{{ __('Provincia') }}</strong></label>
                            <div class="col-md-2">
                                <input id="provincia" type="text" class="form-control{{ $errors->has('provincia') ? ' is-invalid' : '' }}" name="provincia" value="{{ $cliente->provincia }}" autofocus >
                                @if ($errors->has('provincia'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('provincia') }}</strong>
                                    </span>
                                @endif
                            </div>
                        

                            <label><strong>{{ __('Canton') }}</strong></label>
                            <div class="col-md-2">
                                <input id="canton" type="text" class="form-control{{ $errors->has('canton') ? ' is-invalid' : '' }}" name="canton" value="{{ $cliente->canton }}" autofocus >
                                @if ($errors->has('canton'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('canton') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


<!-- endbloque 3-->
                    <div class="card-body">

                        <div class="form-group row">
                            <label><strong>{{ __('Parroquia') }}</strong></label>
                            <div class="col-md-2">
                                <input id="parroquia" type="text" class="form-control{{ $errors->has('parroquia') ? ' is-invalid' : '' }}" name="parroquia" value="{{ $cliente->parroquia }}" autofocus >
                                @if ($errors->has('parroquia'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('parroquia') }}</strong>
                                    </span>
                                @endif
                            </div>
                        



                                                
                            <label><strong>{{ __('Region') }}</strong></label>
                            <div class="col-md-2">
                                <input id="region" type="text" class="form-control{{ $errors->has('region') ? ' is-invalid' : '' }}" name="region" value="{{ $cliente->region }}" autofocus >
                                @if ($errors->has('region'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('region') }}</strong>
                                    </span>
                                @endif
                            </div>
                        


                            <label><strong>{{ __('Sexo') }}</strong></label>
                            <div class="col-md-2">
                            
                            <select name="sexo" id="sexo" class="form-control{{ $errors->has('sexo') ? ' is-invalid' : '' }}" name="sexo"  value="{{ $cliente->sexo }}" autofocus>
                               
                                <option  value="">{{ $cliente->sexo }}</option>
                                    <option value="Masculino">Masculino</option>
                                    <option value="Femenino">Femenino</option>

                                </select>
                                @if ($errors->has('sexo'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sexo') }}</strong>
                                    </span>
                                @endif
                             </div>

                            <label><strong>{{ __('Estado Civil') }}</strong></label>
                            <div class="col-md-2">
                          
                            <select name="estadocivil" id="estadocivil" class="form-control{{ $errors->has('estadocivil') ? ' is-invalid' : '' }}" name="estadocivil"  value="{{ $cliente->estadocivil }}" autofocus>
                               
                                <option  value="">{{ $cliente->estadocivil }}</option>
                                    <option value="Solter@">Solter@</option>
                                    <option value="Casad@">Casad@</option>
                                    <option value="Divorciad@">Divorciad@</option>
                                    <option value="Viud@">Viud@</option>
                                </select>
                                @if ($errors->has('estadocivil'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('estadocivil') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>
                    </div>

<!-- bloque contactos-->
<div class="col-md-12">
            <div class="card" style="background-color: #BBDEFB    ">
                <div ></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cliente.store') }}" aria-label="{{ __('Registro de Cliente') }}">
 <!-- bloque 1-->    
 
     <center><h3><strong><div  class="alert alert-warning" role="alert">Datos De Contactos</div></strong></h3></center><hr>


                        <div class="form-group row">
                            <label><strong>{{ __('Celular') }}</strong></label>
                            <div class="col-md-3">
                            
                                <input id="dato" type="number" class="form-control{{ $errors->has('dato') ? ' is-invalid' : '' }}" name="dato" value="{{ $cliente->dato }}" >
                                @if ($errors->has('dato'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dato', 'El campo Celular Es Obligatorio') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <label><strong>{{ __('Otro Celular') }}</strong></label>
                            <div class="col-md-3">
                                 <input id="dato2" type="number" class="form-control{{ $errors->has('dato2') ? ' is-invalid' : '' }}" name="dato2" value="{{ $cliente->dato2 }}" >
                            </div>

                          <label><strong>{{ __('Convencional') }}</strong></label>
                            <div class="col-md-3">
                                 <input id="dato3" type="number" class="form-control{{ $errors->has('dato3') ? ' is-invalid' : '' }}" name="dato3" value="{{ $cliente->dato3 }}" >
                                 @if ($errors->has('dato3'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dato3', 'El campo Convencional Es Obligatorio') }}</strong>
                                    </span>
                                @endif
                            </div>
                    
                        </div>
                        <div class="form-group row">
                        <label><strong>{{ __(' Telefono Parentesco') }}</strong></label>
                            <div class="col-md-2">
                            <input id="dato4" type="number" class="form-control{{ $errors->has('dato4') ? ' is-invalid' : '' }}" name="dato4" value="{{ $cliente->dato4 }}" >
                        </div>
                        <label><strong>{{ __(' Tipo de Parentesco') }}</strong></label>
                            <div class="col-md-2">
                                <select name="dato7" id="dato7" class="form-control{{ $errors->has('dato7') ? ' is-invalid' : '' }}" name="dato7"  value="{{ $cliente->dato7 }}" autofocus>
                               
                               <option  value="">{{ $cliente->dato7 }}</option>
                                   <option value="Padre">Padre</option>
                                   <option value="Madre">Madre</option>
                                   <option value="Conyugue">Conyugue</option>
                                   <option value="Hij@">Hijo@</option>
                                   <option value="Herman@">Herman@</option>
                                   <option value="Abul@">Abul@</option>
                                   <option value="Ti@">Ti@</option>
                                   <option value="Sobrin@">Sobrin@</option>
                                   <option value="Prim@">Prim@</option>
                               </select>
                            </div>

                            <label><strong>{{ __('Nombre de Parentesco') }}</strong></label>
                            <div class="col-md-3">
                                <input id="parentesco" type="text" class="form-control{{ $errors->has('parentesco') ? ' is-invalid' : '' }}" name="parentesco" value="{{ $cliente->parentesco }}" autofocus >
                                @if ($errors->has('parentesco'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('parentesco') }}</strong>
                                    </span>
                                @endif
                            </div>
                </div>
<!-- endbloque 1-->

<!-- bloque 2--><div class="card-body">
                        <div class="form-group row">
                            <label><strong>{{ __('Telf Trabajo') }}</strong></label>
                            <div class="col-md-3">
                            <input id="dato5" type="number" class="form-control{{ $errors->has('dato5') ? ' is-invalid' : '' }}" name="dato5" value="{{ $cliente->dato5 }}" >
                            @if ($errors->has('dato5'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dato5', 'El campo Telf Trabajo Es Obligatorio') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <label><strong>{{ __('Correo Electronico') }}</strong></label>
                            <div class="col-md-5">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $cliente->email }}" >
                            </div>
                                
                        </div>
                </div>
<!-- endbloque 2-->


<!-- endbloque contactos-->




            <div class="card" style="background-color: #90CAF9">
                <div ></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('cliente.store') }}" aria-label="{{ __('Registro de Cliente') }}">
 <!-- bloque 1-->    
                        <center><h3><strong><div  class="alert alert-danger" role="alert">Datos De Laborales</div></strong></h3></center><hr>
                        <div class="form-group row">
                        <label><strong>{{ __('Extension') }}</strong></label>
                            <div class="col-md-2">
                            <input id="extension" type="number" class="form-control{{ $errors->has('extension') ? ' is-invalid' : '' }}" name="extension" value="{{ $cliente->extension }}"  >
                            </div>
                            <label><strong>{{ __('Tipo De Empleado') }}</strong></label>
                            <div class="col-md-3">
                            <input id="tipo_empleado" type="text" class="form-control{{ $errors->has('tipo_empleado') ? ' is-invalid' : '' }}" name="tipo_empleado" value="{{ $cliente->tipo_empleado }}" >
                            </div>

                            <label><strong>{{ __('Cargo') }}</strong></label>
                            <div class="col-md-3">
                            <input id="cargo" type="text" class="form-control{{ $errors->has('cargo') ? ' is-invalid' : '' }}" name="cargo" value="{{ $cliente->cargo }}" >
                            </div>

                       
                        </div>
                </div>
<!-- endbloque 1-->

<!-- bloque 2--><div class="card-body">
                        <div class="form-group row">
                        <label><strong>{{ __('Salario') }}</strong></label>
                            <div class="col-md-2">
                            <input id="salario" type="number" class="form-control{{ $errors->has('salario') ? ' is-invalid' : '' }}" name="salario" value="{{ $cliente->salario }}" >
                            </div>
                        
                            <label><strong>{{ __('Antiguedad') }}</strong></label>
                            <div class="col-md-2">
                                
                                <select name="antiguedad" id="antiguedad" class="form-control{{ $errors->has('antiguedad') ? ' is-invalid' : '' }}" name="antiguedad"  value="{{ $cliente->antiguedad }}" autofocus>
                               
                               <option  value="">{{ $cliente->antiguedad }}</option>
                                   <option value="0-1 años">0-1 años</option>
                                   <option value="1-2 años">1-2 años</option>
                                   <option value="2-3 años">2-3 años</option>
                                   <option value="3-4 años">3-4 años</option>
                                   <option value="1-5 años">1-5 año</option>
                                   <option value="1-8 años">1-8 años</option>
                                   <option value="0-10 años">0-10 años</option>
                                   <option value="0-15 años">0-15 años</option>
                                   <option value="0-20 años">0-20 años</option>
                               </select>
                            </div>
                            <label><strong>{{ __('Direccion Laborale') }}</strong></label>
                            <div class="col-md-5">
                                <input id="direccion_trabajo" type="text" class="form-control{{ $errors->has('direccion_trabajo') ? ' is-invalid' : '' }}" name="direccion_trabajo" value="{{ $cliente->direccion_trabajo }}">
                            </div>

                          
                                
                             
                            </div>
                            </div>
                            <div class="card-body">
                        <div class="form-group row"> 
                        <label><strong>{{ __('Estado Laboral') }}</strong></label>
                            <div class="col-md-2">
                                <input id="dato6" type="text" class="form-control{{ $errors->has('dato6') ? ' is-invalid' : '' }}" name="dato6" value="{{ $cliente->dato6 }}">
                            </div>
                        <label><strong>{{ __('Empresa') }}</strong></label>
                            <div class="col-md-4">
                             <input id="empresa" type="text" class="form-control{{ $errors->has('empresa') ? ' is-invalid' : '' }}" name="empresa" value="{{ $cliente->empresa }}">
                             
                        </div>
                        </div>
                        <label><strong>{{ __('Observaciones') }}</strong></label>
                            <div class="col-md-12">
                                <input id="observacion" type="text" class="form-control{{ $errors->has('observacion') ? ' is-invalid' : '' }}" name="observacion" value="{{ $cliente->observacion }}">
                            </div>
                            </div>
                </div>
<!-- endbloque 2-->
                        
                </div>
            </div>

                            
                        
                        &nbsp; &nbsp; 
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-4 offset-md-2">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Actualizar Cliente') }}
                                    </div>      
 <a href="{{ route('cliente.index') }}" class="btn btn-success">Volver a la lista</a>  </div>
    
    </form>

@endsection
