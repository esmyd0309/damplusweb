<?php

namespace App\Exports;

use App\Models\Cobranza\DAMPLUStelefonos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class DAMPLUStelefonosExport implements FromQuery,WithHeadings
{
   
    use Exportable;

   

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Fecha',
            'idc',
            'Asesor',
            'Estado Laboral',
            'Observación',
            'Intensiones',
            'Estado Cliente',
            'Observación',
            'contesta',
            
            
            
        ];
    }


   


    public function query()
    {
        
        return DAMPLUStelefonos::query()->select(
        'created_at',
        'idc',
        'users',
        'estadolab',
        'observacion',
        'pagar',
        'estadoclientes',
        'observacionestadocliente',
        'contesta'
       )
        ->from('DAMPLUStelefonos');
       

       
    }
    
}
