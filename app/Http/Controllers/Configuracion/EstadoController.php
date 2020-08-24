<?php

namespace App\Http\Controllers\Configuracion;

use App\Estado;
use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class EstadoController extends ApiController
{
   public function __construct()
    {
        parent::__construct();//proteger controlador
        #$this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.configuracion.estado');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $estados = Estado::all();
        return $this->showAll($estados);
    }

    //guarda registro en la tabla
    public function store(Request $request)
    {
        $reglas = [
            'cliente_id' => 'required|integer',
            'fecha' => 'required|date',
            'observaciones' =>'required',
            'estado' => 'required'
        ];
        
        DB::beginTransaction();
            $this->validate($request, $reglas);
            $data = $request->all();
            $estado = Estado::create($data);

            $cliente = Cliente::find($request->cliente_id);
            $cliente->estado = $request->estado == 1 ? 'A':'I';
            $cliente->save();

        DB::commit();

        return $this->showOne($estado,201);
    }

    //obtiene registro por id
    public function show(Estado $estado)
    {
        return $this->showOne($estado);
    }

    //actualizar registro
    public function update(Request $request, Estado $estado)
    {
        $reglas = [
            'estado' => 'required'
        ];

        $this->validate($request, $reglas);

        DB::beginTransaction();
            $estado->estado = $request->estado;


             if (!$estado->isDirty()) {
                return $this->errorResponse('Se debe especificar al menos un valor diferente para actualizar', 422);
            }

            $cliente = Cliente::find($estado->cliente_id);
            $cliente->estado = $request->estado == 1 ? 'A':'I';
            $cliente->save();

            $estado->save();
        DB::commit();
        return $this->showOne($estado);
    }

    //eliminar registro de la tabla a nivel logico
    public function destroy(Estado $estado)
    {
        DB::beginTransaction();

            $estado->delete();

            $last_estado = DB::table('estados')->latest('fecha')->first();//obtenemos el ultimo estado

            $cliente = Cliente::find($estado->cliente_id);
            $cliente->estado = $last_estado->estado == 1 ? 'A':'I';//actalizar estado decliente
            $cliente->save();

        DB::commit();
        return $this->showOne($estado);
    }
}
