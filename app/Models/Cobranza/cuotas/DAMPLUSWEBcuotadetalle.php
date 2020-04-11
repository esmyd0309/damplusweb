<?php

namespace App\Models\Cobranza\cuotas;

use Illuminate\Database\Eloquent\Model;

class DAMPLUSWEBcuotadetalle extends Model
{
    public $timestamps = false;
    protected $table ='dampluswebcuotadetalle';
    protected $fillable = [
                            'cuota_id',
                            'periodo', 
                            'saldo_inicial',
                            'interes',
                            'cuota',
                            'abono',
                            'fecha_pago',
                            'saldo_final',
                            'asesor',
                            'fecha_registro',
                            'estado',
                            ];
}
