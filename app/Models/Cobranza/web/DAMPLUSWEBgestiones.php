<?php

namespace App\Models\Cobranza\web;

use Illuminate\Database\Eloquent\Model;

class DAMPLUSWEBgestiones extends Model
{
    public $timestamps = false;
    protected $table ='DAMPLUSWEBgestiones';
    protected $fillable = ['idc','cedula', 'telefono','comentario','estado','agente','fecha',];


}
