<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Ubicacion extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    protected $table = "ubicacions";

    protected $fillable = ['nombre'];
}
