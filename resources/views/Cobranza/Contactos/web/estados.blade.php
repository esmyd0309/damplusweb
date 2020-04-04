@extends('layouts.app')

@section('title', 'Estados | Cobranza')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <estados-component></estados-component>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped ">
                    <thead class="thead-dark">
                        <tr>
                            <th class=" text-center" style="width: 7px">ID</th>
                            <th class=" text-center" style="width: 7px">Nombre</th>
                            <th class=" text-center" style="width: 7px">Descripción</th>
                            <th class=" text-center" style="width: 7px">Tipo</th>
                            <th class=" text-center" style="width: 7px">Creado</th>
                            <th class=" text-center" style="width: 7px">Fecha</th>
                            <th class=" text-center" style="width: 7px">Estado</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($estados as  $item)
                            <tr>
                            <td class=" text-center" style="width: 7px">{{ $item->id }}</td>
                            <td class=" text-center" style="width: 7px">{{ $item->nombre }}</td>
                            <td class=" text-center" style="width: 7px">{{ $item->descripcion }}</td>
                            <td class=" text-center" style="width: 7px">{{ $item->tipo }}</td>
                            <td class=" text-center" style="width: 7px">{{ $item->agente }}</td>
                            <td class=" text-center" style="width: 7px">{{ $item->fecha }}</td>
                            @if ($item->estado==1)
                                <td class=" text-center" style="width: 7px">Activo</td>
                            @else
                                <td class=" text-center" style="width: 7px">Inactivo</td>
                            @endif
                          
                            </tr>                           
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
