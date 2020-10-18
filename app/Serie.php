<?php

namespace App;

use App\Cobro;
use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $table = 'series';

    protected $fillable = [
    	'serie',
    	'inicio',
    	'total',
    	'no_actual',
    	'actual'
    ];

    public function cobros(){
    	return $this->hasMany(Cobro::class);
    }
}
