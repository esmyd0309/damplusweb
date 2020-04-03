

<div class="container">

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      Cliente <strong> {{ $datos->Nombres }}</strong>  Saldo Actual de <strong>  ${{ $datos->saldodeuda }}</strong> 
    </div>
    

    <div class="row">
        <div class="col">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" >$0.00</label>
                </div>
                <input name="valor" type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
            </div>
        </div>
        <div  class="col">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" >Pago</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="formapago">
                  <option selected disabled>Seleccione la forma de Pago...</option>
                  @foreach ($formas_pagos as $item)
                    <option value="{{$item->nombre}}">{{$item->nombre}}</option>
                  @endforeach
                </select>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text">Documento</label>
                </div>
                <input type="number" class="form-control" name="documento" placeholder="Numero de Documento">
            </div>
        </div>
        <div  class="col">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text">Origen</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="origen">
                  <option selected disabled>Seleccione un Banco De Origen...</option>
                  @foreach ($bancos as $item)
                    <option value="{{$item->nombre}}">{{$item->nombre}}</option>
                  @endforeach
                </select>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div  class="col">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text">Destino</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="destino">
                  <option selected disabled>Seleccione un Banco De Destino...</option>
                  @foreach ($bancos as $item)
                    <option value="{{$item->nombre}}">{{$item->nombre}}</option>
                  @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text">Fecha Deposito</label>
                </div>
                {!! Form::date('fechapago', \Carbon\Carbon::now()->format('Y-m-d'), ['id' => 'fecha','class' => 'form-control'])  !!}
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div  class="col">
            <!-- COMPONENT START -->
            <div class="form-group">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <label class="input-group-text">Recibo </label>
                    </div>
                    <div class="custom-file">
                        <input type="file" name="archivo" class="form-control" placeholder='Choose a file...' />
                    </div>
                </div>
            </div>
            <!-- COMPONENT END -->
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col">
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text">Comentario </label>
                </div>
                <textarea class="form-control" aria-label="With textarea" name="comentario"></textarea>
            </div>
        </div>
    </div>

</div>
<input name="idc" type="hidden" value="{{ $datos->idc }}">
<input name="cedula" type="hidden" value="{{ $datos->cedula }}">

