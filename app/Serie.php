<?php

namespace App;

use App\Cobro;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Serie extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
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
