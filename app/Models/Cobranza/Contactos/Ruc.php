<?php

namespace App\Models\Cobranza\Contactos;

use Illuminate\Database\Eloquent\Model;

class Ruc extends Model
{
    
    protected $connection = 'sqlsrv';
    protected $table ='TBL_RUC';
}
