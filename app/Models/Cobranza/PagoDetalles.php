<?php

namespace App\Models\Cobranza;

use Illuminate\Database\Eloquent\Model;

class PagoDetalles extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table ='tbCampañaPersonaPagoDetalle';
}
