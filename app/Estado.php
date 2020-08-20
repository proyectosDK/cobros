<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    protected $table= 'estados';

    protected $fillable = [
    	'cliente_id',
    	'estado',
    	'fecha',
    	'observaciones'
    ];
}
