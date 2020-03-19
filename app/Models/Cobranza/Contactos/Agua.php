<?php

namespace App\Models\Cobranza\Contactos;

use Illuminate\Database\Eloquent\Model;

class Agua extends Model
{
    protected $connection = 'sqlsrv';
    protected $table ='TBL_MEDIDOR_AGUA';
}
