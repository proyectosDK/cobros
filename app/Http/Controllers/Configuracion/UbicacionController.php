<?php

namespace App\Http\Controllers\Configuracion;

use App\Ubicacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class UbicacionController extends ApiController
{
    public function __construct()
    {
        parent::__construct();//proteger controlador
        #$this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.configuracion.ubicacion');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $ubicacions = Ubicacion::all();
        return $this->showAll($ubicacions);
    }

    //guarda registro en la tabla
    public function store(Request $request)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $ubicacion = Ubicacion::create($data);

        return $this->showOne($ubicacion,201);
    }

    //obtiene registro por id
    public function show(Ubicacion $ubicacion)
    {
        return $this->showOne($ubicacion);
    }

    //actualizar registro
    public function update(Request $request, Ubicacion $ubicacion)
    {
        $reglas = [
            'nombre' => 'required|string'
        ];

        $this->validate($request, $reglas);

        $ubicacion->nombre = $request->nombre;

         if (!$ubicacion->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }
        $ubicacion->save();

        return $this->showOne($ubicacion);
    }

    //eliminar registro de la tabla a nivel logico
    public function destroy(Ubicacion $ubicacion)
    {
        $ubicacion->delete();
        return $this->showOne($ubicacion);
    }
}
