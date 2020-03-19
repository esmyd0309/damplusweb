<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class ClientesVentas extends Model
{
    public $timestamps = false;
    protected $connection = 'logpredictivo';
    protected $table ='ClientesVigentes';
    
   
    public function scopeCedula($query, $cedula)
    {
        if($cedula)
        return $query->where('cedula', 'LIKE', "%$cedula%"); 
    }
}
