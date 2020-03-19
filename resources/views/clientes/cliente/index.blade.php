@extends('layouts.app')


@section('content')

<div class="container">
<div class="page-header">
    <div class="row">
    <div class="col-md-1">
        <label>Busqueda Avanzada</label> 
        </div>
        <div class="d-inline-block align-top" class="col-md-6" > 
             
                {!! Form::open(['route'=> 'apiclientes', 'method' => 'GET', 'class' => 'form-inline pull-right']) !!}
                
                {{ Form::text('nombres', null, ['class' => 'form-control', 'placeholder' => 'Apellidos']) }}
            
                {{ Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Cedula']) }}
     
                
                
                    <button type='submit' class='btn btn-default'>
                    <span class="glyphicon glyphicon-search">BUSCAR</span>
                    </button>
      

{!! Form::close() !!}

</div>
<div class="col-md-2">
         <!--    <a href="" class="btn btn-primary">Registrar Cliente</a>-->
        </div>
<div class="col-md-2">
             <a href="" class="btn btn-success">Dependientes</a>
        </div>
    </div>
</div>
<hr>
    <div class="row justify-content-center">
    
        <div class="col-md-12">
            <div class="card">
            
                <div class="alert alert-success" class="card-header"  >Listado de Clientes</div>
                
             <table >
                <thead class="thead-dark">
                    
                <th  class='text-center'>Cedula</th>
                <th class='text-center'>Apellidos</th>
                <th class='text-center'>Nombres</th>
                <th class='text-center'>Telf Celular</th>
                <th class='text-center'>Estado Laboral</th>
               
                <center><th  class='text-center'>Accion</th></center>
                </thead>
                <tbody>
                
                @foreach ($clientes as $clientess)
                <tr >
                    <td class='text-center'><small class="text-muted">{{ $clientess->Identificacion }}</small></td> 
                    <td class='text-center'><small class="text-muted">{{ $clientess->IdCampaña }}</small></td> 
                    <td class='text-center'><small class="text-muted">{{ $clientess->Nombres }}</small></td>
                    <td class='text-center'><small class="text-muted">{{ $clientess->TelefonoPrincipal }}</small></td>
                    <td class='text-center'><small class="text-muted">{{ $clientess->Campo4 }}</small></td>
                    
                   <!-- <td class='text-center'><a href="" class="btn btn-success" class="btn btn-default btn-xs">Detalles</a>
                    <a href="" class="btn btn-danger" class="btn btn-default btn-xs">Actualizar</a></td>-->
                </tr>
                @endforeach
                </tbody> 
          
             </table>

              {!! $clientes->render() !!}
               
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
