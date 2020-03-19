
                    <div class="card-body">
                        <div class="container">
                             
                            <div class="row">
                                <div class="col-sm">   
                                    <div class="form-group">
                                        {{ form::label('telefono1', 'Telefono WhatsApp') }}
                                        {{ form::text('telefono1', null, ['class' => 'form-control','disabled']) }}
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-group">
                                        {{ form::label('telefono1', 'Telefono WhatsApp') }}
                                        {{ form::text('telefono1', null, ['class' => 'form-control','id' => 'telefono1','maxlength'=> '10','minlength'=> '10']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">  
                                    <div class="form-group">
                                        {{ form::label('telefono2', 'SMS / Llamar') }}
                                        {{ form::text('telefono2', null, ['class' => 'form-control','disabled']) }}
                                        </div>   
                                    </div>
                               
                                <div class="col-sm">
                                    <div class="form-group">
                                        {{ form::label('telefono2', 'SMS  / Llamar') }}
                                        {{ form::text('telefono2', null, ['class' => 'form-control','id' => 'telefono2','maxlength'=> '10','minlength'=> '10']) }}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm">  
                                    <div class="form-group">
                                        {{ form::label('convencional', 'Convencional') }}
                                        {{ form::text('convencional', null, ['class' => 'form-control','disabled']) }}
                                        </div>   
                                    </div>
                                
                                <div class="col-sm">
                                    <div class="form-group">
                                        {{ form::label('convencional', 'Convencional') }}
                                        {{ form::text('convencional', null, ['class' => 'form-control','id' => 'convencional','maxlength'=> '9','minlength'=> '9']) }}
                                    </div>
                                </div>
                            </div>
                            
                                <div class="row">
                                    <div class="col-sm">  
                                        <div class="form-group">
                                            {{ form::label('convencionaltrabajo', 'Telefono Trabajo') }}
                                            {{ form::text('convencionaltrabajo', null, ['class' => 'form-control','disabled']) }}
                                            </div>   
                                        </div>
                                    
                                    <div class="col-sm">
                                        <div class="form-group">
                                            {{ form::label('convencionaltrabajo', 'Telefono Trabajo') }}
                                            {{ form::text('convencionaltrabajo', null, ['class' => 'form-control','id' => 'convencionaltrabajo','maxlength'=> '10','minlength'=> '9']) }}
                                        </div>
                                    </div>
                                </div>
                                    <div class="row">
                                            <div class="col-sm">  
                                                <div class="form-group">
                                                    {{ form::label('extension', 'Extension') }}
                                                    {{ form::text('extension', null, ['class' => 'form-control','disabled']) }}
                                                    </div>   
                                                </div>
                                           
                                            <div class="col-sm">
                                                <div class="form-group">
                                                    {{ form::label('extension', 'Extension') }}
                                                    {{ form::text('extension', null, ['class' => 'form-control','id' => 'extension','maxlength'=> '9','minlength'=> '3']) }}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                                <div class="col-sm">  
                                                    <div class="form-group">
                                                        {{ form::label('telefonoparentesco', 'Telefono Pariente') }}
                                                        {{ form::text('telefonoparentesco', null, ['class' => 'form-control','maxlength'=> '10','minlength'=> '9']) }}
                                                        </div>   
                                                    </div>
                                                
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        {{ form::label('parentesco1', 'Parentesco') }}
                                                        {!! Form::select('parentesco1', [null => 'Parentesco'] + ['padres' => 'Padres','hermano'=>'Hermano','conyugue'=>'Conyugue','tio'=>'Tio','otros'=>'Otros'], null, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                            </div>
                                        <div class="row">
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        {{ form::label('direccioncasa', 'Direcciòn Domicilio') }}
                                                        {{ form::text('direccioncasa', null, ['class' => 'form-control','id' => 'direccioncasa','maxlength'=> '255','minlength'=> '10']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm"> 
                                                    <div class="form-group">
                                                        {{ form::label('estadolab', 'Estado') }}
                                                        {!! Form::select('estadolab', [null => 'Seleccione Estado'] + ['independiente' => 'Independiente','dependiente '=>'Dependiente ','cesante'=>'Cesante'], null, ['class' => 'form-control']) !!}
                                                    </div>
                                                </div>
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        {{ form::label('observacion', 'Observación') }}
                                                        {{ form::text('observacion', null, ['class' => 'form-control','maxlength'=> '255','minlength'=> '9']) }}
                                                    </div>   
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm">
                                                    <div class="form-group">
                                                        {{ form::label('direcciontrabajo', 'Direcciòn Laboral') }}
                                                        {{ form::text('direcciontrabajo', null, ['class' => 'form-control','id' => 'direcciontrabajo','maxlength'=> '255','minlength'=> '10']) }}
                                                    </div>
                                                </div>
                                            </div>
                                            
                            <div class="row">
                                <div class="col-sm">  
                                    <div class="form-group">
                                        {{ form::label('email', 'Correo Actual') }}
                                        {{ form::text('email', null, ['class' => 'form-control','disabled']) }}
                                        </div>   
                                    </div>
                               
                                <div class="col-sm">
                                    <div class="form-group">
                                        {{ form::label('email', 'Correo Nuevo') }}
                                        {{ form::text('email', null, ['class' => 'form-control','id' => 'email']) }}
                                    </div>
                                </div>
                            </div>
                    </div>
                   
                </div>
                            
      
   
    
    