<?php

namespace App;

use App\Cliente;
use App\DetallesCobro;
use Illuminate\Database\Eloquent\Model;

class Cobro extends Model
{
    protected $table = 'cobros';

    protected $fillable = [
    	'cliente_id',
    	'serie_id',
        'cuota_id',
    	'numero',
    	'fecha',
    	'total',
    	'anulado'
    ];

    public function cliente(){
    	return $this->belongsTo(Cliente::class);
    }

    public function serie(){
    	return $this->belongsTo(Serie::class);
    }

    public function detalle(){
    	return $this->hasMany(DetallesCobro::class);
    }

    public function cuota(){
        return $this->belongsTo(Cuota::class);
    }
}
