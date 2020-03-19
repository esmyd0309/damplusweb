<?php

namespace App\Models\Cobranza\Contactos;

use Illuminate\Database\Eloquent\Model;

class Telefonos extends Model
{
    //
    
    protected $connection = 'sqlsrv';
    protected $table ='TBL_TELEFONOS';
}
