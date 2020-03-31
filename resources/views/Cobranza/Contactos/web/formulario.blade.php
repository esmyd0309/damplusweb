

<div class="container">

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      Cliente <strong> {{ $datos->Nombres }}</strong>  Saldo Actual de <strong>  ${{ $datos->saldodeuda }}</strong> 
    </div>
    

    <div class="row">
        <div class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text">$</span>
                  <span class="input-group-text">0.00</span>
                </div>
                <input name="valor" type="text" class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
            </div>
        </div>
        <div  class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Forma de Pago</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="formapago">
                  <option selected disabled>Seleccione la forma de Pago...</option>
                  @foreach ($formas_pagos as $item)
                    <option value="{{$item->nombre}}">{{$item->nombre}}</option>
                  @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <div class="col-auto">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Nuemero Documento</label>
                    </div>
                    <input type="number" class="form-control" name="documento" placeholder="Numero de Documento">
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div  class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Banco Origen</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="origen">
                  <option selected disabled>Seleccione un Banco De Origen...</option>
                  @foreach ($bancos as $item)
                    <option value="{{$item->nombre}}">{{$item->nombre}}</option>
                  @endforeach
                </select>
            </div>
        </div>
        <div  class="col">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Banco Destino</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="destino">
                  <option selected disabled>Seleccione un Banco De Destino...</option>
                  @foreach ($bancos as $item)
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
                    <label class="input-group-text" for="inputGroupSelect01">Fecha Deposito</label>
                </div>
                {!! Form::date('fechapago', \Carbon\Carbon::now()->format('Y-m-d'), ['id' => 'fecha','class' => 'form-control'])  !!}
            </div>
        </div>
        <div  class="col">
            <div class="input-group mb-6">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Recibo</label>
                </div>
                <div class="custom-file">
                    <input type="file" for="validatedCustomFile" class="custom-file-input" name="archivo" aria-describedby="inputGroupFileAddon01">
                    <label class="custom-file-label" for="inputGroupFile01">Subir Archivo</label>
                </div>
            </div>
        </div>
        <div class="col">

            
        
        </div>
    </div>
    <div class="row">
        <div class="col">
        
            <div class="input-group">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="inputGroupSelect01">Comentario</label>
                </div>
                <textarea class="form-control" aria-label="With textarea" name="comentario"></textarea>
            </div>
            
        </div>
    </div>
</div>
<input name="idc" type="hidden" value="{{ $datos->idc }}">
<input name="cedula" type="hidden" value="{{ $datos->cedula }}">

