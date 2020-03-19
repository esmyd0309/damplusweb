<?php

namespace App\Models\Ventas\Contactos;

use Illuminate\Database\Eloquent\Model;

class Ruc extends Model
{
    
    protected $connection = 'sqlsrv4';
    protected $table ='TBL_RUC_VTA';
}
