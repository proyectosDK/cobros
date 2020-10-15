<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TipoUsuario extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    protected $table = 'tipo_usuarios';
    protected $fillable= [
    	'nombre'
    ];
}
