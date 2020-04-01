

<div class="container">
    <div class="row">
        <div  class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01" >Tipo</label>
                </div>
                <select class="custom-select"  name="tipo" required>
                  <option selected disabled>Seleccione el Tipo </option>
                    <option value="convensional">Convensional</option>
                    <option value="convensional">Celular</option>
                </select>
            </div>
        </div>
        <div  class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Prefijo</label>
                </div>
                <select class="custom-select"  name="prefijo" required>
                  <option selected disabled>Seleccione un Prefijo</option>
                    <option value="02">02</option>
                    <option value="03">03</option>
                    <option value="04">04</option>
                    <option value="05">05</option>
                    <option value="06">06</option>
                    <option value="07">07</option>
                    <option value="08">08</option>
                    <option value="09">09</option>
                 
                </select>
            </div>
        </div>
        <div class="col">
            <div class="col-auto">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" >Numero</label>
                    </div>
                    {!! Form::text('numero' , null, ['id'=>'numero','class' =>'form-control my-colorpicker1',  'placeholder' => ' Min 7 - Max 9 caracteres','maxlength'=> '8','minlength'=> '7' ]) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div  class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text">Contacto</label>
                </div>
                <select class="custom-select"  name="contacto" required>
                  <option selected disabled>Seleccione Un Contacto</option>
                  
                  <option value="personal">Personal</option>
                  <option value="trabajo">Trabajo</option>
                  <option value="casa">Casa</option>
                  <option value="pariente">Pariente</option>                 
                </select>
            </div>
        </div>
        <div  class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text">Referencia</label>
                </div>
                <select class="custom-select"  name="referencia" required>
                  <option selected disabled>Seleccione Un Valor...</option>
                  
                  <option value="titular">Titular</option>
                  <option value="padre"> Padre</option>
                  <option value="hermano"> Hermano</option>
                  <option value="hijo"> Hijo</option>
                  <option value="nieto"> Nieto</option>
                  <option value="primo"> Primo</option>
                  <option value="tio">Tio</option>
                  <option value="cuñado"> Cuñado</option>
                  <option value="suegra"> Suegra</option>
                  <option value="nuera"> Nuera</option>
                  <option value="otros"> Otros</option>                  
                </select>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col">
        
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Observación</label>
                </div>
                <textarea class="form-control" aria-label="With textarea" name="observacion" required></textarea>
            </div>
            
        </div>
    </div>
</div>
<input name="cedula" type="hidden" value="{{ $datos->cedula }}">

