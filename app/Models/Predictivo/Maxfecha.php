<?php

namespace App\Models\Predictivo;

use Illuminate\Database\Eloquent\Model;

class Maxfecha extends Model
{
    public $timestamps = false;
    protected $connection = 'asterisk';
    protected $table ='maxfecha';
    protected $fillable = ['fecha',];

  
}
