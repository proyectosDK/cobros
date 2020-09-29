<?php

namespace App\Http\Controllers\Configuracion;

use App\Mes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class MesController extends ApiController
{
    public function __construct()
    {
        parent::__construct();//proteger controlador
        #$this->middleware('consulta');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $meses = Mes::all();
        return $this->showAll($meses);
    }
}
