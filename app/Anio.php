<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Anio extends Model implements Auditable 
{
	use \OwenIt\Auditing\Auditable;

    protected $table = 'anios';
    protected $fillable= [
    	'anio'
    ];
}
