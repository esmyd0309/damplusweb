<?php

namespace App\Models\Cobranza;

use Illuminate\Database\Eloquent\Model;

class TbPersona extends Model
{
    public $timestamps = false;
    protected $connection = 'sqlsrv';
    protected $table ='tbPersona';
}
