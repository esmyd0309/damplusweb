<?php

namespace App\Models\Cobranza;

use Illuminate\Database\Eloquent\Model;

class ApiClientes extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table ='tbCampañaPersona';
    

     public function scopeCedula($query, $cedula)
     {
         if($cedula)
         return $query->where('Identificacion', 'LIKE', "%$cedula%"); 
     }
    
     public function scopeNombres($query, $nombres)
     {
         if($nombres)
         return $query->where('Nombres', 'LIKE', "%$nombres%"); 
     }
      
}
