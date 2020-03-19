@extends('layouts.app')


@section('content')


<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container" id="particles-js">    
             <!--DATOS PERSONALES -->
    <div id="signupbox" style=" margin-top:100px" class="mainbox col-md-12 ">
        <div class="panel panel-warning " >
            <div class="panel-heading" class="alert alert-secondary">
                <div class="panel-title">Datos Personales </div>
            </div>  
                <div class="alert alert-light  "class="panel-body" id="particles-js">
                    <div class="row" >

                        <div class="col-md-2">
                            <label><strong> Documento: </strong></label>
                                {{ $cliente->tipo_documento }}
                        </div>

                        <div class="col-md-3">
                            <label><strong> Cedula:  </strong></label>
                                {{ $cliente->cedula }}
                         </div>

                           <div class="col-md-3">
                            <label><strong> Fecha de Nacimiento: </strong></label>
                                {{ $cliente->fechanacimiento }}
                         </div>

                        <div class="col-md-3">
                            <strong><label>Apelldos: </strong></label>
                                {{ $cliente->apellidos }}
                        </div>

                        <div class="col-md-3">
                            <label><strong>Nombres: </strong></label>
                                {{ $cliente->nombres }}
                        </div>
                        
                    </div>
                </div> 
                <div class="alert alert-light" class="panel-body">
                    <div class="row">
                        <div class="col-md-5">
                            <label><strong>Direccion:</strong> </label>
                            {{ $cliente->direccion }}
                        </div>
                        <div class="col-md-3">
                            <label ><strong>Provincia</strong></label>
                            {{ $cliente->provincia }}
                        </div>
                        <div class="col-md-3">
                        <label ><strong>Canton</strong></label>
                            {{ $cliente->canton }}
                        </div>
                     
                    </div>
                </div> 

                <div class="alert alert-light  "class="panel-body">
                    <div class="row">

                        <div class="col-md-3">
                            <label ><strong>Parroquia:</strong>
                                {{ $cliente->parroquia }}
                        </div>

                            <div class="col-md-2">
                                <label><strong> Sexo: </strong></label>
                                        {{ $cliente->sexo }}
                            </div>

                            <div class="col-md-2">
                                <label><strong>Estado Civil:</strong></label>
                                    {{ $cliente->estadocivil }}
                            </div>
                    </div>
                </div> 


        <!--DATOS Contactos -->   
        <div id="signupbox" style=" margin-top:100px" class="mainbox col-md-12 ">
            <div class="panel panel-danger" >
                <div class="panel-heading" class="alert alert-secondary">
                    <div class="panel-title">Datos de Contactos</div>
                </div>  
                    <div class="alert alert-light  "class="panel-body">
                        <div class="form-group row" >

                            <div class="col-md-5">
                                <label><strong>Telef Celular</strong></label>
                                    {{ $cliente->dato }}
                            </div>
                            <div class="col-md-5"><label><strong>Telef Celular/A</strong></label>
                                   {{ $cliente->dato2 }}
                            </div>
                            <div class="col-md-3">
                                <label><strong>Convencional</strong></label>
                                   {{ $cliente->dato3 }}
                            </div>
                            <div class="col-md-3">
                                <label><strong>Telefono del Parentesco: </strong></label>
                                   {{ $cliente->dato4 }}
                            </div>
                            <div class="col-md-3">
                                <label><strong>Tipo de Parentesco: </strong></label>
                                   {{ $cliente->dato7 }}
                            </div>
                            <div class="col-md-3">
                                <label><strong>Nombres del Parentesco: </strong></label>
                                   {{ $cliente->parentesco }}
                            </div>
                            <div class="col-md-3">
                                <label><strong>Telf Trabajo: </strong></label>
                                   {{ $cliente->dato4 }}
                            </div>
                            <div class="col-md-3">
                                <label>Exte<strong>Extension</strong></label>
                                   {{ $cliente->extension }}
                            </div>
                            <div class="col-md-3">
                                <label><strong>Email</strong></label>
                                  {{ $cliente->email }}
                            </div>
                        </div>
                        
                    </div> 
               </div>
        </div>
     
   
    <!--DATOS LABORALES -->   
    <div id="signupbox" style=" margin-top:100px" class="mainbox col-md-12 ">
        <div class="panel panel-primary" >
            <div class="panel-heading" class="alert alert-secondary">
                <div class="panel-title">Datos Laborales</div>
            </div>  
                <div class="alert alert-light  "class="panel-body">
                        <div class="row" >
                            <div class="col-md-5">
                                <label><strong>Empresa</strong></label>
                                     {{ $cliente->empresa }}
                            </div>
                            <div class="col-md-3">
                                <label><strong>Empleado</strong></label>
                                    {{ $cliente->tipo_empleado }}
                            </div>
                            <div class="col-md-3">
                                <label><strong>Cargo</strong></label>
                                    {{ $cliente->cargo }}
                            </div>
                        </div>
                    </div> 
                    <div class="alert alert-light  "class="panel-body">
                        <div class="row">
                            <div class="col-md-3">
                                <label><strong>Salario</strong></label>
                                    {{ $cliente->salario }}
                                </div>
                            <div class="col-md-2">
                                <label><strong>Antigüedad:</strong></label>
                                {{ $cliente->antiguedad }}
                            </div>
                            <div class="col-md-6">
                                <label><strong>Direccion Laboral</strong></label>
                               {{ $cliente->direccion_trabajo }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label><strong>Estado Laboral</strong></label>
                                    {{ $cliente->dato6 }}
                                </div>
                            <div class="col-md-2">
                                <label><strong>Observaciones:</strong></label>
                                {{ $cliente->observacion }}
                            </div>
                           
                        </div>
                    </div> 
                </div>
           </div>    
 </div>
 <div class='text-center'>
  <a href="{{ route('cliente.edit', $cliente->id) }}" class="btn btn-danger">Actualizar</a> &nbsp; &nbsp; <a href="{{ route('cliente.index') }}" class="btn btn-success">Volver a la lista</a>  </div></td></div>

<script src="particles.js"></script>
	<script src="particulas.js"></script>
@endsection
