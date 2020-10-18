<?php

namespace App;

use App\Cobro;
use App\Estado;
use App\Ubicacion;
use App\TelefonosCliente;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "clientes";

    protected $fillable = [
    	'cui',
    	'nit',
    	'ubicacion_id',
    	'primer_nombre',
    	'segundo_nombre',
    	'primer_apellido',
    	'segundo_apellido',
    	'genero',
    	'fecha_nac',
    	'fecha_inicio',
    	'ubicacion',
    	'estado',
    	'deudor'
    ];

    public function ubicacion_cliente(){
    	return $this->belongsTo(Ubicacion::class,'ubicacion_id');
    }

    public function telefonos(){
        return $this->hasMany(TelefonosCliente::class);
    }

    public function estados(){
        return $this->hasMany(Estado::class);
    }

    public function ultimo_cobro(){
        return $this->hasOne(Cobro::class)->where('anulado',false)->latest();
    }

    public function cobros(){
        return $this->hasMany(Cobro::class);
    }
}
