<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Estado extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    protected $table= 'estados';

    protected $fillable = [
    	'cliente_id',
    	'estado',
    	'fecha',
    	'observaciones'
    ];
}
