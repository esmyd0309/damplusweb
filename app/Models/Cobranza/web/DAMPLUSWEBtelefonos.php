<?php

namespace App\Models\Cobranza\web;

use Illuminate\Database\Eloquent\Model;

class DAMPLUSWEBtelefonos extends Model
{
    public $timestamps = false;
    protected $table ='DAMPLUSWEBtelefonos';
    protected $fillable = 
    [
        'cedula', 
        'telefono',
        'prefijo',
        'tipo',
        'numero',
        'referencia',
        'contacto',
        'observacion'
       
    ];


}
