<?php

namespace App\Models\Ventas;

use Illuminate\Database\Eloquent\Model;

class DAMPLUSpredictivo extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv4';
    protected $table ='DAMPLUSpredictivo';
    protected $fillable = [
                            'asesor', 
                            'grupo',
                            'fecha',
                            'fecha', 
                            'cedula',
                            'telefono',
                            'telefono_adicional',
                            'telefono_parentesco',
                            'nombre_parentesco', 
                            'confirmacion',
                            'negociacion',
                            'contacto',
                            'estado',
                            'campana', 
                            'list',
                            'lead_id', 
                            'uniqueid',
                            'title'];
    protected $primaryKey = 'id';
    
   
   
}
