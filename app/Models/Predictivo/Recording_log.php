<?php

namespace App\Models\Predictivo;

use Illuminate\Database\Eloquent\Model;

class Recording_log extends Model
{
    protected $connection = 'asterisk';
    protected $table ='recording_log';
}
