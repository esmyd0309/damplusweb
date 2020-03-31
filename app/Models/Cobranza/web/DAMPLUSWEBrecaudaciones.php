<?php

namespace App\Models\Cobranza\web;

use Illuminate\Database\Eloquent\Model;

class DAMPLUSWEBrecaudaciones extends Model
{
    public $timestamps = false;
    protected $table ='dampluswebrecaudaciones';
    protected $fillable = ['idc','cedula', 'fecha','agente','origen','destino',
    'formapago','fechapago','valor','valor','archivo'];


}
