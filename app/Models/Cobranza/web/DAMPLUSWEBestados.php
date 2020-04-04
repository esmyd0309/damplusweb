<?php

namespace App\Models\Cobranza\web;

use Illuminate\Database\Eloquent\Model;

class DAMPLUSWEBestados extends Model
{
    public $timestamps = false;
    protected $table ='estados';
    protected $fillable = 
    [
        'nombre', 
        'descripcion',
        'tipo',
        'fecha',
        'agente',
        
    ];


}
