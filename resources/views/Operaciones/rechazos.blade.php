@extends('layouts.app')

@section('title', 'Descargar Rechazos')
@section('content')

    <center>  <div class="alert alert-primary" role="alert">
        DESCARGAR RECHAZOS PACIFICARD
    </div></center>
<div class="container">
    <div class="row">
        <div class="col-3"></div>
        <div class="col-6">
            {!! Form::open(['route' => 'rechazos.exportar']) !!}

                <div class="form-group col-6">
                    {{ form::label('fechadesde', 'Fecha  desde') }}
                    {{ Form::date('fechadesde', \Carbon\Carbon::now()->format('Y-m-d'),['class' => 'form-control','min' => "2019-11-01", 'max' => \Carbon\Carbon::now()->format('Y-m-d')]) }}
                </div>
                <div class="form-group col-6">
                    {{ form::label('fechahasta', 'Fecha  Hasta') }}
                    {{ Form::date('fechahasta', \Carbon\Carbon::now()->format('Y-m-d'),['class' => 'form-control','min' => "2019-11-01", 'max' => \Carbon\Carbon::now()->format('Y-m-d')]) }}
                </div>
            <center> {{ form::submit('Descargar Excel', ['class' => 'btn btn-sm btn-success ']) }} </center>
            {!! Form::close() !!}
        </div>
        <div class="col-3"></div>
    </div>
</div>


@endsection