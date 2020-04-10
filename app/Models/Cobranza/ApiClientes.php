<?php

namespace App\Models\Cobranza;

use Illuminate\Database\Eloquent\Model;

class ApiClientes extends Model
{
    public $timestamps = false;
    //protected $connection = 'sqlsrv';
    protected $table ='clientescobranza';
    

     public function scopeidc($query, $idc)
     {
         if($idc)
         return $query->where('idc', 'LIKE', "%$idc%"); 
     }
    
     public function scopeNombres($query, $nombres)
     {
         if($nombres)
         return $query->where('nombres', 'LIKE', "%$nombres%"); 
     }
      
}
