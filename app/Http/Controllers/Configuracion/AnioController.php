<?php

namespace App\Http\Controllers\Configuracion;

use App\Anio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Log;

class AnioController extends ApiController
{
    public function __construct()
    {
        parent::__construct();//proteger controlador
        $this->middleware('admin')->except('index');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.configuracion.anio');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $anios = Anio::all();
        return $this->showAll($anios);
    }

    //guarda registro en la tabla
    public function store(Request $request)
    {
        $reglas = [
            'anio' => 'required|integer'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $anio = Anio::create($data);

        return $this->showOne($anio,201);
    }

    //obtiene registro por id
    public function show(Anio $anio)
    {
        return $this->showOne($anio);
    }

    //actualizar registro
    public function update(Request $request, anio $anio)
    {
        $reglas = [
            'anio' => 'required|integer'
        ];

        $this->validate($request, $reglas);

        $anio->anio = $request->anio;

         if (!$anio->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }
        $anio->save();

        return $this->showOne($anio);
    }

    //eliminar registro de la tabla a nivel logico
    public function destroy(Anio $anio)
    {
        $anio->delete();

        return $this->showOne($anio);
    }
}
