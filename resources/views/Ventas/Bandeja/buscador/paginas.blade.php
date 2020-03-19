@if (count($clientes))
   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Cedula</th>
                <th>Nombres</th>
                <th>Campaña</th>
                <th>Venta</th>
            </tr>
            <tbody>
                @foreach ($clientes as $item)
                <tr>
                    <td style="width: 10px">{{ $item->cedula }}</td>
                    <td style="width: 10px">{{ $item->nombres }}</td>
                    <td>{{ $item->campananadescripcion }}</td>
                    <td>{{ $item->estado }}</td>
                    <td style="width: 5px"> <a href="{{ route('clienteventas.show', [$item->campana,$item->cedula]) }}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a></td>
                </tr>
                @endforeach   
            </tbody>
        </thead>
        

    
    </table>
     
             
@endif