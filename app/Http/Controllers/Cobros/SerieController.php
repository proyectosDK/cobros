<?php

namespace App\Http\Controllers\Cobros;

use App\Serie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class SerieController extends ApiController
{
   public function __construct()
    {
        parent::__construct();//proteger controlador
        #$this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.cobros.serie');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $series = Serie::all();
        return $this->showAll($series);
    }

    //guarda registro en la tabla
    public function store(Request $request)
    {
        $reglas = [
            'serie' => 'required',
            'inicio' => 'required',
            'total' => 'required'
        ];
        
        $this->validate($request, $reglas);
        $data = $request->all();
        $data['no_actual'] = $request->inicio;
        $serie = Serie::create($data);

        return $this->showOne($serie,201);
    }

    //obtiene registro por id
    public function show(Serie $series)
    {
        return $this->showOne($series);
    }

    //actualizar registro
    public function update(Request $request, Serie $series)
    {
        $reglas = [
            'serie' => 'required',
            'inicio' => 'required',
            'total' => 'required'
        ];

        $this->validate($request, $reglas);

        if($series->inicio != $request->inicio){
           if(count($series->cobros)) return $this->errorResponse('serie ya fue utilizada en recibo de cobros, no se puede modificar valor de inicio',422); 
        }

        $series->serie = $request->serie;
        $series->inicio = $request->inicio;
        $series->total = $request->total;
        $series->no_actual = $request->inicio;

         if (!$series->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }
        $series->save();

        return $this->showOne($series);
    }

    //eliminar registro de la tabla a nivel logico
    public function destroy(Serie $series)
    {
        $series->delete();
        return $this->showOne($series);
    }
}
