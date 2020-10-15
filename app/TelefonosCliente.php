<?php

namespace App;

use App\Cliente;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TelefonosCliente extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
    protected $table="telefonos_clientes";

    protected $fillable = ['id_cliente','numero'];

    public function cliente(){
    	return $this->belongsTo(Cliente::class);
    }
}
