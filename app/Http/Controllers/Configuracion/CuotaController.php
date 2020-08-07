<?php

namespace App\Http\Controllers\Configuracion;

use App\Cuota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class CuotaController extends ApiController
{
   public function __construct()
    {
        parent::__construct();//proteger controlador
        #$this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.configuracion.cuota');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $cuotas = Cuota::all();
        return $this->showAll($cuotas);
    }

    //guarda registro en la tabla
    public function store(Request $request)
    {
        $reglas = [
            'cuota' => 'required',
            'extra' =>'required',
            'limite' => 'required'
        ];
        
        $this->validate($request, $reglas);
        DB::table('cuotas')->where('actual', True)->update(array('actual' => False));
        $data = $request->all();
        $cuota = Cuota::create($data);

        return $this->showOne($cuota,201);
    }

    //obtiene registro por id
    public function show(cuota $cuota)
    {
        return $this->showOne($cuota);
    }

    //actualizar registro
    public function update(Request $request, Cuota $cuota)
    {
        $reglas = [
            'cuota' => 'required',
            'extra' => 'required',
            'limite' => 'required'
        ];

        $this->validate($request, $reglas);

        $cuota->cuota = $request->cuota;
        $cuota->limite = $request->limite;
        $cuota->extra = $request->extra;

         if (!$cuota->isDirty()) {
            return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
        }
        $cuota->save();

        return $this->showOne($cuota);
    }

    //actualizar cuota
    public function cambiarEstado($id, Request $request){
        //modificar estados
        DB::table('cuotas')->where('actual', True)->update(array('actual' => False));
        $cuota = Cuota::find($id);
        $cuota->actual = $request->actual;
        $cuota->save();

        return $this->showOne($cuota,201);
    }

    //eliminar registro de la tabla a nivel logico
    public function destroy(Cuota $cuota)
    {
        $cuota->delete();

        return $this->showOne($cuota);
    }
}
