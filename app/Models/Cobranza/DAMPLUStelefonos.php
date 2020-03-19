<?php

namespace App\Models\Cobranza;

use Illuminate\Database\Eloquent\Model;

class DAMPLUStelefonos extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table ='DAMPLUStelefonos';

    protected $fillable = [
        'idc', 
        'telefono1',
        'telefono2', 
        'telefono3', 
        'telefono4',
        'email',
        'convencional',
        'convencionaltrabajo',
        'extension',
        'direccioncasa',
        'direcciontrabajo',
        'telefonoparentesco',
        'parentesco1',
        'users',
        'usersedit',
        'estadolab',
        'observacion',

        'contesta',
        'pagar',
        'estadoclientes',
        'observacionestadocliente',
        'fecha_creado',
        'created_at',
        'updated_at',
        
];
protected $primaryKey = 'id';
}

