<?php

namespace App\Models\Ventas\Contactos;

use Illuminate\Database\Eloquent\Model;

class Deudor extends Model
{
    protected $connection = 'sqlsrv4';
    protected $table ='TBL_PARENTESCO_VTA';
}
