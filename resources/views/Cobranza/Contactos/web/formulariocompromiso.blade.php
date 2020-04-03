

<div class="container">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button >
        <center>Cliente <strong> {{ $datos->Nombres }}</strong>  Saldo Actual de <strong>  ${{ $datos->saldodeuda }}</strong> </center>
      </div>
    <div class="row">
        <div  class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" >Telefono Contacto</label>
                </div>
                <select class="custom-select"  name="contacto" required>
                  <option selected disabled value="">Seleccione Telefono Contacto...</option>
                  @foreach ($telefonosagregados as $item)
                    <option value="{{$item->telefono}}">{{$item->telefono}}</option>
                  @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">Valor</span>
                  <span class="input-group-text">$0.00</span>
                </div>
                <input name="valor" type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)"  required>
            </div>
        </div>
        <div  class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" >Forma de Pago</label>
                </div>
                <select class="custom-select"  name="formapago" required>
                  <option selected disabled value="">Seleccione la forma de Pago...</option>
                  @foreach ($formas_pagos as $item)
                    <option value="{{$item->nombre}}">{{$item->nombre}}</option>
                  @endforeach
                </select>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" >Fecha Pago</label>
                </div>
                {!! Form::date('fechapago', \Carbon\Carbon::now()->format('Y-m-d'), ['id' => 'fecha','class' => 'form-control', 'min' => \Carbon\Carbon::now()->format('Y-m-d'), 'required' => 'required'])  !!}
            </div>
        </div>
    
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" >Tipo Compromiso</label>
                </div>
                <select class="custom-select"  name="tipocompromiso">
                  <option selected disabled>Seleccione el Tipo de Compromiso...</option>
                    <option value="compromisoTitular">Compromiso Titular</option>
                    <option value="CompromisoTercero">Compromiso Tercero</option>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" >Tipo Contacto</label>
                </div>
                <select class="custom-select"  name="tipocontacto">
                  <option selected disabled>Seleccione el Tipo de Contacto...</option>
                    <option value="titular">Titular</option>
                    <option value="padre"> Padre</option>
                    <option value="hermano"> Hermano</option>
                    <option value="hijo"> Hijo</option>
                    <option value="nieto"> Nieto</option>
                    <option value="primo"> Primo</option>
                    <option value="tio"> Tio</option>
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
                    <label class="input-group-text" >Comentario</label>
                </div>
                <textarea class="form-control" aria-label="With textarea" name="comentario" placeholder="minimo 20 caracteres permitidos..."></textarea>
            </div>
            
        </div>
    </div>
</div>
<input name="idc" type="hidden" value="{{ $datos->idc }}">
<input name="cedula" type="hidden" value="{{ $datos->cedula }}">
<input name="idcampana" type="hidden" value="{{ $datos->idcampana }}">


