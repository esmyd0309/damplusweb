<?php

namespace App\Models\Ventas\Contactos;

use Illuminate\Database\Eloquent\Model;

class Telefonos extends Model
{
    //
    
    protected $connection = 'sqlsrv4';
    protected $table ='TBL_TELEFONOS_VTA';
}
