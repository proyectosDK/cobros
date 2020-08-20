<?php

namespace App\Http\Controllers\Configuracion;

use App\Cliente;
use App\TelefonosCliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class ClienteController extends ApiController
{
    public function __construct()
    {
        parent::__construct();//proteger controlador
        #$this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.configuracion.cliente');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $clientes = Cliente::with('ubicacion_cliente','telefonos')->get();
        return $this->showAll($clientes);
    }

    //guarda registro en la tabla
    public function store(Request $request)
    {
        $reglas = [
            'cui'=>'required|integer',
            'ubicacion_id'=>'required|integer',
            'primer_nombre'=>'required|string',
            'primer_apellido'=>'required|string',
            'genero'=>'required|string',
            'fecha_nac'=>'required|date',
            'fecha_inicio'=>'required|date',
            'ubicacion'=>'required|string'
        ];
        

        DB::beginTransaction();
            $this->validate($request, $reglas);

            $data = $request->all();
            $cliente = Cliente::create($data);

            foreach ($request->telefonos as $t) {
                $telefono = new TelefonosCliente;
                $telefono->cliente_id = $cliente->id;
                $telefono->numero = $t['numero'];
                $telefono->save();
            }

        DB::commit();

        return $this->showOne($cliente,201);
    }

    //obtiene registro por id
    public function show(Cliente $cliente)
    {
        $cliente = Cliente::where('id',$cliente->id)->with('telefonos','ubicacion_cliente','estados')->first();
        return $this->showOne($cliente);
    }

    //actualizar registro
    public function update(Request $request, Cliente $cliente)
    {
        $reglas = [
            'cui'=>'required|integer',
            'ubicacion_id'=>'required|integer',
            'primer_nombre'=>'required|string',
            'primer_apellido'=>'required|string',
            'genero'=>'required|string',
            'fecha_nac'=>'required|date',
            'fecha_inicio'=>'required|date',
            'ubicacion'=>'required|string'
        ];

        DB::beginTransaction();
            $this->validate($request, $reglas);

            $cliente->primer_nombre = $request->primer_nombre;
            $cliente->segundo_nombre = $request->segundo_nombre;
            $cliente->primer_apellido = $request->primer_apellido;
            $cliente->segundo_apellido = $request->segundo_apellido;
            $cliente->cui = $cliente->cui;
            $cliente->nit = $cliente->nit;
            $cliente->genero = $cliente->genero;
            $cliente->fecha_nac = $request->fecha_nac;
            $cliente->fecha_inicio = $request->fecha_inicio;
            $cliente->ubicacion = $request->ubicaion;

            $cliente->telefonos()->delete(); //eliminamos los anteriores

            foreach ($request->telefonos as  $tel) {
                $telefono = new TelefonosCliente();
                $telefono->cliente_id = $cliente->id;
                $telefono->numero = $tel['numero'];

                $telefono->save();
            }

            $cliente->save();
        DB::commit();

        return $this->showOne($cliente);
    }

    //actualizar cliente
    public function cambiarEstado($id, Request $request){
        //modificar estados
        DB::table('clientes')->where('actual', True)->update(array('actual' => False));
        $cliente = cliente::find($id);
        $cliente->actual = $request->actual;
        $cliente->save();

        return $this->showOne($cliente,201);
    }

    //eliminar registro de la tabla a nivel logico
    public function destroy(Cliente $cliente)
    {
        $cliente->delete();

        return $this->showOne($cliente);
    }
}
