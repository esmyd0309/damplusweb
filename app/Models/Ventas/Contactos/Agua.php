<?php

namespace App\Models\Ventas\Contactos;

use Illuminate\Database\Eloquent\Model;

class Agua extends Model
{
    protected $connection = 'sqlsrv4';
    protected $table ='TBL_MEDIDOR_AGUA_VTA';
}
