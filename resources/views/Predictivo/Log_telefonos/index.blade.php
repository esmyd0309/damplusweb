@extends('layouts.app')


@section('content')

<div class="container">
<div class="page-header">
    <div class="row">
        <div class="col-md-2">
        <label style="color:red;">Busqueda Avanzada</label> 
        </div>
        <div class="d-inline-block align-top" class="col-md-12" >
        
             
                {!! Form::open(['route'=> 'logpredictivo', 'method' => 'GET', 'class' => 'form-inline pull-right']) !!}
                
                {{ Form::text('cedula', null, ['class' => 'form-control', 'placeholder' => 'Cedula']) }}
            
                {{ Form::text('status', null, ['class' => 'form-control', 'placeholder' => 'Estado']) }}

                {{ Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => 'Telefono']) }}
                
             
                
                
                    <button type='submit' class='btn btn-default'>
                    <span class="glyphicon glyphicon-search">BUSCAR</span>
                    </button>
      

{!! Form::close() !!}
</div>
    </div>
</div>
<hr>
    <div class="row justify-content-center">
    
        <div class="col-md-12">
            <div class="card">
            
                <div class="alert alert-info" class="card-header"  >Listado de Registros </div>
                
             <table class="table table-striped" >
                <thead class="thead-dark">
                <th class='text-center' class="thead-dark">Fecha</th>
                <th class='text-center' class="thead-dark">Campaña</th>
                <th class='text-center' class="thead-dark">Cedula</th>
                <th class='text-center' class="thead-dark">Estatus</th>
                <th  class='text-center' class="thead-dark">Cantidad</th>
                <th class='text-center' class="thead-dark">Telefono</th>
             
                </thead>
                <tbody>
                
                @foreach ($logredictivos as $logredictivoss)
                <tr >
                <td class='text-center'><small class="text-muted">{{ $logredictivoss->call_date }}</small></td>
                <td class='text-center'><small class="text-muted">{{ $logredictivoss->campaign_id }}</small></td>
                <td class='text-center'><small class="text-muted">{{ $logredictivoss->cedula }}</small></td>
                <td class='text-center'><small class="text-muted">{{ $logredictivoss->status }}</small></td>
                <td class='text-center'><small class="text-muted">{{ $logredictivoss->cantidad }}</small></td>
                <td class='text-center'><small class="text-muted">{{ $logredictivoss->TELEFONO_F }}</small></td>
                
               </tr>
                @endforeach
                </tbody> 
          
             </table>

             {!! $logredictivos->render() !!}
               
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
