<?php

namespace App\Http\Controllers;

use App\Contrato;
use App\Empleado;
use App\User;
use Illuminate\Support\Facades\DB;
use Charts;
use App\Http\Controllers\ApiController;
use App\TipoContrato;
use App\Unidad;
use App\UnidadCargo;

class HomeController extends ApiController
{
	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        return view('home');
    }
}
