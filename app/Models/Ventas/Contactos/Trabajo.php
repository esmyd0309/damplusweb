<?php

namespace App\Models\Ventas\Contactos;

use Illuminate\Database\Eloquent\Model;

class Trabajo extends Model
{
    //
    
    protected $connection = 'sqlsrv4';
    protected $table ='TBL_TRABAJO_VTA';
}
