<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    protected $table = "cuotas";

    protected $fillable = [
    	'cuota',
    	'limite',
    	'extra',
    	'actual'];
}
