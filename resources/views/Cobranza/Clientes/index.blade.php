@extends('layouts.app')
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

@section('title', 'Clientes | Cobranza')
@section('content')

<div class="col-md-12">
    <div class="alert alert-secondary" role="alert">
      <center> <small>BUSCAR CLIENTES COBRANZA</small> </center>
      </div>
    <div class="card card-primary">
      <div class="input-group">
        <input type="text" class="form-control" id="texto" placeholder="Ingrese la Cedula">
        <div class="input-group-append"><span class="input-group-text">Buscar</span></div>
      </div>
      <div id="resultados" class="bg-light border">
      </div>
    </div>
    
</div>
    <?php $clientess = Null; ?>
    @foreach ($porgestionar as $cliente)
      <?php $clientess += $cliente->Identificacion;?><!-- VALIDAR SI TIENES CLIENTES ASIGNADOS Y MOSTRAR LA BANDEJA O NO-->
    @endforeach
      @if (!is_null($clientess))
      
     
      
      <hr/><hr/><br/>

        <div class="alert alert-primary" role="alert">
          <center> <small>Bandeja Asesor</small> </center>
        </div>
        <br/>
       
        
       
              <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                      <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">
                          <i class="fas fa-chalkboard-teacher"></i>
                          Por Trabajar  {{ $porgestionar->count() }}
                        </h3>
                        <ul class="nav nav-pills ml-auto p-2">
                          <li class="nav-item">
                            <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Descargar</a>
                          </li>
                        </ul>
                      </div><!-- /.card-header -->
                      <div class="card-body">
                        <div class="tab-content p-0">
                          <!-- Morris chart - Sales -->
                          {!! Form::open(['route'=> 'clientes.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) !!}
            
                            {{ Form::text('cedulaxge', null, ['class' => 'form-control', 'placeholder' => 'Cedula']) }}
                           
                            
                          
                                <button type='submit' class='btn btn-default'>
                                <span class="glyphicon glyphicon-search">BUSCAR</span>
                                </button>
                        {!! Form::close() !!}

                        <div class="card-body p-0">
                            <table class="table table-striped table-valign-middle">
                              <thead>
                              <tr>
                                  <th class='text-center' >id</th>
                                  <th class='text-center'>Campaña</th> 
                                  <th class='text-center'>Agente</th> 
                                  <th class='text-center'>Area</th>
                                  <th class='text-center' >Cedula</th>    
                                  <th  class='text-center'>Nombres</th>
                                  <th class='text-center'>Deuda </th>
                                  <th class='text-center'>Saldo </th>
                                  <th class='text-center'>Promesa </th>
                                  <th class='text-center'>FechaComp </th>
                                  <tbody>
                               @foreach ($porgestionar as $cliente)
                
                                  <tr > 
                                      <td class='text-center'  ><small class="text-muted"> {{ $cliente->IdCampaña . $cliente->Identificacion }} </small></td>
                                      <td class='text-center'  ><small class="text-muted"> {{ $cliente->Descripcion }}</small></td>
                                      <td class='text-center'  ><small class="text-muted"> {{ $cliente->IdAgente }}</small></td>
                                      <td class='text-center'  ><small class="text-muted"> {{ $cliente->Campo9 }}</small></td>
                                      <td class='text-center'  ><small class="text-muted"> {{ $cliente->Identificacion }}</small></td>
                                      <td class='text-center'  ><small class="text-muted"> {{ $cliente->Nombres }} </small></td>
                                      <td class='text-center'  ><small class="text-muted"> {{ $cliente->ValorDeuda }}</small></td>
                                      <td class='text-center'  ><small class="text-muted"> {{ $cliente->SaldoDeuda }}</small></td>
                                      <td class='text-center'  ><small class="text-muted"> {{ $cliente->PromesaMontoPago }}</small></td>
                                      <td class='text-center'  ><small class="text-muted"> {{ $cliente->PromesaMonto }}</small></td>
                                      @can('clientes.edit')
                                      <td>    
                                          <a href="{{route('clientes.edit', [$cliente->IdCampaña , $cliente->Identificacion])}}" class="btn btn-sm btn-danger"><i class="fas fa-edit"></i>
                                          </a>
                                      </td>  
                                      @endcan
                                      <td>    
                                          <a href="{{route('clientes.show', [$cliente->IdCampaña , $cliente->Identificacion])}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>
                                          </a>
                                      </td> 
                                  </tr>
                                  
                                @endforeach
                              
                              </tbody>
                            </table>
                            {!! $porgestionar->render() !!}
                          </div>


                        </div>
                      </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                     <!-- Custom tabs (Charts with tabs)-->
                     <div class="card">
                        <div class="card-header d-flex p-0">
                          <h3 class="card-title p-3">
                            
                            <i class="fas fa-calendar-check"></i>
                            COMPROMISOS   {{ $compromisospendientes->count() }}
                          </h3>
                          <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item">
                              <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Descargar</a>
                            </li>
                          </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                          <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                            {!! Form::open(['route'=> 'compromisos', 'method' => 'GET', 'class' => 'form-inline pull-right']) !!}
              
                              {{ Form::text('cedulacmp', null, ['class' => 'form-control', 'placeholder' => 'Cedula']) }}
                             
                              
                            
                                  <button type='submit' class='btn btn-default'>
                                  <span class="glyphicon glyphicon-search">BUSCAR</span>
                                  </button>
                          {!! Form::close() !!}
  
                          <div class="card-body p-0">
                              <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th class='text-center' >id</th>
                                    <th class='text-center'>Campaña</th> 
                                    <th class='text-center'>Agente</th> 
                                    <th class='text-center'>Area</th>
                                    <th class='text-center' >Cedula</th>    
                                    <th  class='text-center'>Nombres</th>
                                    <th class='text-center'>Deuda </th>
                                    <th class='text-center'>Saldo </th>
                                    <th class='text-center'>Promesa </th>
                                    <th class='text-center'>FechaComp </th>
                                  <tbody>
                                 @foreach ($compromisospendientes as $cliente)
                  
                                    <tr > 
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->IdCampaña . $cliente->Identificacion }} </small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->Descripcion }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->IdAgente }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->Campo9 }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->Identificacion }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->Nombres }} </small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->ValorDeuda }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->SaldoDeuda }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->PromesaMontoPago }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->PromesaMonto }}</small></td>
                                        @can('clientes.edit')
                                        <td>    
                                            <a href="{{route('clientes.edit', [$cliente->IdCampaña , $cliente->Identificacion])}}" class="btn btn-sm btn-danger"><i class="fas fa-edit"></i>
                                            </a>
                                        </td>  
                                        @endcan
                                        <td>    
                                            <a href="{{route('clientes.show', [$cliente->IdCampaña , $cliente->Identificacion])}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>
                                            </a>
                                        </td> 
                                    </tr>
                                    
                                  @endforeach
                                </tbody>
                              </table>
                              {!! $compromisospendientes->render() !!}
                            </div>
  
  
                          </div>
                        </div><!-- /.card-body -->
                      </div>
                      <!-- /.card -->

                       <!-- Custom tabs (Charts with tabs)-->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                          <h3 class="card-title p-3">
                            <i class="fas fa-dollar-sign mr-1"></i>
                            PAGOS  {{ $pagoss->count() }}
                          </h3>
                          <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item">
                              <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Descargar</a>
                            </li>
                          </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                          <div class="tab-content p-0">
                            <!-- Morris chart - Sales -->
                            {!! Form::open(['route'=> 'clientes.index', 'method' => 'GET', 'class' => 'form-inline pull-right']) !!}
              
                              {{ Form::text('cedulapag', null, ['class' => 'form-control', 'placeholder' => 'Cedula']) }}
                            
                            
                                  <button type='submit' class='btn btn-default'>
                                  <span class="glyphicon glyphicon-search">BUSCAR</span>
                                  </button>
                          {!! Form::close() !!}
  
                          <div class="card-body p-0">
                              <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th class='text-center' >id</th>
                                    <th class='text-center'>Campaña</th> 
                                    <th class='text-center'>Agente</th> 
                                    <th class='text-center'>Area</th>
                                    <th class='text-center' >Cedula</th>    
                                    <th  class='text-center'>Nombres</th>
                                    <th class='text-center'>Deuda </th>
                                    <th class='text-center'>Saldo </th>
                                  <tbody>
                                 @foreach ($pagoss as $cliente)
                                  <tbody>
                                    <tr > 
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->IdCampaña . $cliente->Identificacion }} </small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->Descripcion }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->IdAgente }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->Campo9 }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->Identificacion }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->Nombres }} </small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->ValorDeuda }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->SaldoDeuda }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->PromesaMontoPago }}</small></td>
                                        <td class='text-center'  ><small class="text-muted"> {{ $cliente->PromesaMonto }}</small></td>
                                        @can('clientes.edit')
                                        <td>    
                                            <a href="{{route('clientes.edit', [$cliente->IdCampaña , $cliente->Identificacion])}}" class="btn btn-sm btn-danger"><i class="fas fa-edit"></i>
                                            </a>
                                        </td>  
                                        @endcan
                                        <td>    
                                            <a href="{{route('clientes.show', [$cliente->IdCampaña , $cliente->Identificacion])}}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>
                                            </a>
                                        </td> 
                                    </tr>
                                    
                                  @endforeach
                                </tbody>
                              </table>
                              {!! $pagoss->render() !!}
                            </div>
  
  
                          </div>
                        </div><!-- /.card-body -->
                      </div>
                      <!-- /.card -->
        

                    


                 
               </div>

            
           <!--    <div class="container">
                <h1>Laravel 5.8 Datatables Tutorial <br/> HDTuto.com</h1>
                <table id="p" class="table table-bordered data-table">
                    <thead>
                        <tr>
                           
                            <th>idc</th>
                           
                            <th width="100px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>-->
      @endif
        
      @endsection 
 
 @section('script')
 <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js " defer></script>
 <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js" defer></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" defer></script>
 <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js" defer></script>
 <script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('clientes.index') }}",
        columns: [
            
            {data: 'idc', name: 'idc'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            
        ]
    });
   
    
  });
</script>
        
          <script>
            window.addEventListener('load',function(){
                document.getElementById("texto").addEventListener("keyup", () => {
                    if((document.getElementById("texto").value.length)>=0)
                        fetch(`buscadorcobranza?texto=${document.getElementById("texto").value}`,{ method:'get' })
                        .then(response  =>  response.text() )
                        .then(html      =>  {   document.getElementById("resultados").innerHTML = html  })
                    else
                        document.getElementById("resultados").innerHTML = "No encotrado";
                })
            });  
          </script>
        
        <script>
            window.onload = function(){
              var contenedor = document.getElementById('contenedor_carga');
              contenedor.style.visibility = 'hidden';
              contenedor.style.opacity = 0;
            }
          </script>
      
@endsection



