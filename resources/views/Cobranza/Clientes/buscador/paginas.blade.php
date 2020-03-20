@if (count($clientes))
   
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Idc</th>
                <th>Cedula</th>
                <th>Nombres</th>
                <th>Deuda</th>
                <th>Saldo</th>
                <th>Campaña</th>
                <th>Area</th>
                <th>Agente</th>
            </tr>
            <tbody>
                @foreach ($clientes as $item)
                <tr>
                    <td style="width: 10px">{{ $item->idc }}</td>
                    <td style="width: 10px">{{ $item->cedula }}</td>
                    <td >{{ $item->Nombres }}</td>
                    <td style="width: 10px">{{ $item->valordeuda }}</td>
                    <td style="width: 10px">{{ $item->saldodeuda }}</td>
                    <td>{{ $item->descripcion }}</td>
                    <td>{{ $item->area }}</td>
                    <td>{{ $item->agente }}</td>
                    <td style="width: 5px"> <a href="{{ route('deudor.show', $item->idc )}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a></td>
                </tr>
                @endforeach   
            </tbody>
        </thead>
        

    
    </table>
     
             
@endif