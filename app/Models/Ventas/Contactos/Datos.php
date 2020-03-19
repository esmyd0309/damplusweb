<?php

namespace App\Models\Ventas\Contactos;

use Illuminate\Database\Eloquent\Model;

class Datos extends Model
{
    protected $connection = 'sqlsrv4';
    protected $table ='TBL_CLIENTE_VTA';
}
