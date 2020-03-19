<div class="card-header">
        <h3 class="card-title">Crea Nueva Agenda</h3>
      </div>

      <div class="card-body">
          <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="form-group">
                      {!! Form::label('telefonoContacto' , 'Telefono Contacto *') !!}
                      {!! Form::text('telefonoContacto' , null, ['id'=>'telefonoContacto','class' =>'form-control my-colorpicker1',  'placeholder' => ' Min 9 - Max 10 caracteres', 'maxlength' => '10' ]) !!}
                  </div>
              </div>

              <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="form-group">
                      {{ Form::label('contacto', 'Contacto *') }}
                      {!! Form::select('contacto', [null => 'Seleccione estado Contacto'] + ['titular' => 'Titular','padres'=>'Padres','conyugue'=>'Conyugue','hermano'=>'Hermano', 'otros'=>'Otros'], null, ['id'=>'contacto','class' => 'form-control']) !!}
                  </div>
              </div>
          </div>
          <hr>
          <div class="row">
              <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="form-group">
                      {!! Form::label('telefonoNuevo' , 'Telefono A Llamar *') !!}
                      {!! Form::text('telefonoNuevo' , null, ['id'=>'telefonoNuevo','class' =>'form-control my-colorpicker1',  'placeholder' => ' Min 9 - Max 10 caracteres', 'maxlength' => '10'  ]) !!}
                  </div>
              </div>
              <div class="col-md-6 col-sm-6 col-xs-6">
                  <div class="form-group">
                      {{ Form::label('contactar', 'Contactar *') }}
                      {!! Form::select('contactarcel', [null => 'Seleccione estado Contacto'] + ['titular' => 'Titular','padres'=>'Padres','conyugue'=>'Conyugue','hermano'=>'Hermano', 'otros'=>'Otros'], null, ['id'=>'contactarcel','class' => 'form-control']) !!}
                  </div>
              </div> 
          </div> 

          <div class="row">
              <LAbel>Convencional</LAbel>
              <div class="col-md-2 col-sm-2 col-xs-3">
                  <div class="form-group">
                      {!! Form::label('' , '') !!}
                      {!! Form::select('codigoArea', [null => 'CodigoArea'] + ['02' => '02','03'=>'03','04'=>'04','05'=>'05', '06'=>'06', '07'=>'07', '08'=>'08'], null, ['id'=>'contacto','class' => 'form-control']) !!}
                  </div>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                  <div class="form-group">
                      {!! Form::label('' , '') !!}
                      {!! Form::text('convencional' , null, ['id'=>'convencional','class' =>'form-control my-colorpicker1',  'placeholder' => '1234567' , 'maxlength' => '7' ]) !!}
                  </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-3">
                  <div class="form-group">
                      {{ Form::label('', '') }}
                      {!! Form::select('contactarconv', [null => 'Referencia Contacto'] + ['casa' => 'Casa','trabajo'=>'Trabajo'], null, ['id'=>'contactarconv','class' => 'form-control']) !!}
                  </div>
              </div>
          </div>
          <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                      {!! Form::label('comentario' , 'Comentario *') !!}
                      {!! Form::textarea('comentario' , null, ['id' => 'comentario', 'rows' => 2, 'cols' => 54, 'style' => 'resize:none','class' => 'form-control']) !!}
                  </div>
              </div>
          </div>

          <div class="row">
                  <label>Contactar</label>
              <div class="col-md-3 col-sm-3 col-xs-3">
                  <div class="form-group">
                      {!! Form::date('fecha', \Carbon\Carbon::now()->format('Y-m-d'), ['id' => 'fecha','class' => 'form-control'])  !!}
                  </div>
              </div>
              <div class="col-md-3 col-sm-3 col-xs-3">
                  <div class="form-group">
                      {!! Form::Time('hora', \Carbon\Carbon::now()->format('H:i'), ['id' => 'hora','class' => 'form-control'])  !!}
                  </div>
              </div>
              <div class="col-md-4 col-sm-4 col-xs-4">
                  <div class="form-group">
                      {!! Form::select('turno', [null => 'Select Turno'] + ['manana' => 'Mañana','tarde'=>'Tarde','noche'=>'Noche'], null, ['id' => 'turno','class' => 'form-control']) !!}
                  </div>
              </div>
          </div>
          
      </div>
      <input id ='IdCampañaPersona' name="IdCampañaPersona" type="hidden" value="{{ $ced }}">
      <input id ='IdCampaña' name="IdCampaña" type="hidden" value="{{ $idc }}">
      <input id ='nombres' name="nombres" type="hidden" value="{{ $datos->Campo2 }}">
      <input id ='descripcion' name="campanadescripcion" type="hidden" value="{{ $datos->Descripcion }}">
      <center><button id="registro" class="btn btn-primary" type="#"> Registrar </button></center>
    </div>