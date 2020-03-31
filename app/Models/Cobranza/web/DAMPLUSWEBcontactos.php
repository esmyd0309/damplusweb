<?php

namespace App\Models\Cobranza\web;

use Illuminate\Database\Eloquent\Model;

class DAMPLUSWEBcontactos extends Model
{
    public $timestamps = false;
    protected $table ='DAMPLUSWEBcontactos';
    protected $fillable = 
    [
        'cedula', 
        'telefono',
        'prefijo',
        'convensional',
        'telefonoTrabajo',
        'extension',
        'whatsapp',
        'sms',
        'email',
        'direccioncasa',
        'direccionTrabajo',
        'ciudad',
        'ciudadTrabajo',
        'estado',
    ];


}
