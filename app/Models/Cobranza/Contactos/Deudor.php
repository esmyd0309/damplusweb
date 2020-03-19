<?php

namespace App\Models\Cobranza\Contactos;

use Illuminate\Database\Eloquent\Model;

class Deudor extends Model
{
    protected $connection = 'sqlsrv';
    protected $table ='TBL_PARENTESCO';
}
