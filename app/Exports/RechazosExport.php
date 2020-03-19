<?php

namespace App\Exports;

use App\Models\Operaciones\Rechazos;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;

class RechazosExport implements FromQuery,WithHeadings
{
   
    use Exportable;

   

    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
        return [
            'Cedula',
            'Codigo',
            'Descripcion',
            'Fecha',
            'Hora',
            
            
            
        ];
    }


    public function __construct( $fechadesde,$fechahasta)
    {
        
        $this->fechadesde = $fechadesde;
        $this->fechahasta = $fechahasta;
        return $this;
    }



    public function query()
    {
        
        return Rechazos::query()->select(
        'CEDULA',
        'codigo',
        'descripcion',
        'fecha',
        'hora'
       )
        ->from('DAMPLUSrechazos')
        ->where('fecha','>=',$this->fechadesde)
        ->where('fecha','<=',$this->fechahasta);
       

       
    }
    
}
