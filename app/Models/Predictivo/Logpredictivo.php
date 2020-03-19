<?php

namespace App\Models\Predictivo;

use Illuminate\Database\Eloquent\Model;

class Logpredictivo extends Model
{
    protected $connection = 'logpredictivo';
    protected $table = 'BD_RESUMEN_MANUAL_ULTIMO_back';
    

    public function scopeCedula($query, $cedula)
    {
        if($cedula)
        return $query->where('cedula', 'LIKE', "%$cedula%"); 
    }
     
    public function scopeTelefono($query, $telefono)
    {
        if($telefono)
        return $query->where('telefono', 'LIKE', "%$telefono%"); 
    }
    
    
    public function scopeStatus($query, $status)
    {
        if($status)
        return $query->where('status', 'LIKE', "%$status%"); 
    }

}
