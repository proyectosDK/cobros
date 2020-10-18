<?php

namespace App;

use App\Cliente;
use Illuminate\Database\Eloquent\Model;

class TelefonosCliente extends Model
{
    protected $table="telefonos_clientes";

    protected $fillable = ['id_cliente','numero'];

    public function cliente(){
    	return $this->belongsTo(Cliente::class);
    }
}
