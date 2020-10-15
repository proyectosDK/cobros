<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Cuota extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    protected $table = "cuotas";

    protected $fillable = [
    	'cuota',
    	'limite',
    	'extra',
    	'actual'];
}
