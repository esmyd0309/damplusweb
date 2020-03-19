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
                    <td style="width: 10px">{{ $item->IdCampaña }}</td>
                    <td style="width: 10px">{{ $item->Identificacion }}</td>
                    <td >{{ $item->Nombres }}</td>
                    <td style="width: 10px">{{ $item->ValorDeuda }}</td>
                    <td style="width: 10px">{{ $item->SaldoDeuda }}</td>
                    <td>{{ $item->Descripcion }}</td>
                    <td>{{ $item->Campo9 }}</td>
                    <td>{{ $item->IdAgente }}</td>
                    <td style="width: 5px"> <a href="{{ route('deudor.show', [$item->IdCampaña , $item->Identificacion])}}" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a></td>
                    <td style="width: 5px"> <a href="{{ route('clientes.show', [$item->IdCampaña , $item->Identificacion]) }}" class="btn btn-sm btn-info"><i class="fas fa-money-check-alt"></i></a></td>
                </tr>
                @endforeach   
            </tbody>
        </thead>
        

    
    </table>
     
             
@endif