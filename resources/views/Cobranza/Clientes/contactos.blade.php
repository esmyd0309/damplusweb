@extends('layouts.app')

@section('title', 'Reportes')
@section('content')

<div class="card-header">
    <h3 class="card-title">Clientes Segmentados  <a href="{{ route('contactos.exportartodo')}}" class="btn btn-sm btn-info"> {{ $clientes->count() }} <i class="fas fa-arrow-circle-down"></i> </a> </h3>
  </div>
<table class="table table-hover table-condensed">
    <thead>
        <th><center>Cantidad</th>
        <th><center>Asesor</center></th>
        
    </thead>
    <tbody>
        @foreach ($agentes as $item)
        <tr>
            <td><center>{{ $item->cant }}</center></td>   
            <td><center>{{ $item->users }}</center></td>
            <td style="width: 5px"> <a href="{{ route('contactos.exportaragente', $item->users )}}" class="btn btn-sm btn-info"><i class="fas fa-arrow-circle-down"></i></a></td>
        @endforeach
        
        
    </tbody>
</table>

@endsection