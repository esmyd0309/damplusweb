<?php

namespace App\Models\Predictivo;

use Illuminate\Database\Eloquent\Model;

class Vicidial_log extends Model
{
    
    protected $connection = 'asterisk';
    protected $table ='vicidial_log';
}
