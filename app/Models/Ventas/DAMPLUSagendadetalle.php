<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class DAMPLUSagendadetalle extends Model
{
   
    public $timestamps = false;
    protected $connection = 'sqlsrv4';
    protected $table ='DAMPLUSagendadetalle';
    protected $fillable = [
                            'idc', 
                            'estado',
                            'cedula', 
                            'campana', 
                            'telefonoContacto',
                            'contacto',
                            'telefonoNuevo', 
                            'contactarcel',
                            'codigoArea', 
                            'convencional',
                            'contactarconv', 
                            'turno',
                            'comentario', 
                            'fecha', 
                            'hora',
                            'created_at', 
                            'updated_at',
                            'fecharegistro',
                            'registrado',
                            'actualizado',
                            'registrado',
                            'fecharegistroInicial',
                            'users',
];
    protected $primaryKey = 'id';
}
