<?php

namespace App;

use App\Mes;
use App\Anio;
use App\Cobro;
use App\Cuota;
use Illuminate\Database\Eloquent\Model;

class DetallesCobro extends Model
{
    protected $table = 'detalles_cobros';

    protected $fillable = [
        'cobro_id',
    	'anio_id',
    	'mes_id',
        'lectura',
    	'agua_extra',
    	'total_extra',
    	'total_mes'
    ];


    public function anio(){
    	return $this->belongsTo(Anio::class);
    }

    public function cobro(){
    	return $this->belongsTo(Cobro::class);
    }

    public function cuota(){
    	return $this->belongsTo(Cuota::class);
    }

    public function mes(){
    	return $this->belongsTo(Mes::class);
    }
}
