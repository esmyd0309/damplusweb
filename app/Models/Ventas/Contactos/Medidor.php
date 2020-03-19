<?php

namespace App\Models\Ventas\Contactos;

use Illuminate\Database\Eloquent\Model;

class Medidor extends Model
{
    protected $connection = 'sqlsrv4';
    protected $table ='TBL_MEDIDOR_VTA';
}
