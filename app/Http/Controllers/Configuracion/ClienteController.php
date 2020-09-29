<?php

namespace App\Http\Controllers\Configuracion;

use App\Anio;
use App\Cliente;
use Carbon\Carbon;
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
        $clientes = Cliente::with('ubicacion_cliente','telefonos','ultimo_cobro.detalle','estados')->get();

        //actualizar estados
        foreach ($clientes as $cliente) {

            $ultimo_cobro = $cliente->ultimo_cobro;
            $cliente->meses_atrasados = 0;

            $now = Carbon::now();
            $year = $now->year;
            $day = $now->day;

            $month = $day > 5 ? $now->month - 1 : $now->month - 2;

            $rest_date = Carbon::createFromDate($year,$month,28);

            if($ultimo_cobro){
                $detalle = $ultimo_cobro->detalle()->with('anio')->get();
                $anio = Anio::where('anio',$year)->first();
                $sort_desc = $detalle->sortByDesc('anio_id')->sortByDesc('mes_id')->values()->first();
                $date_l_month = Carbon::createFromDate($sort_desc->anio->anio,$sort_desc->mes_id,1);
                $mes_atrasado = $date_l_month->diffInMonths($rest_date);
                $cliente->meses_atrasados = $mes_atrasado;

            }else{
                $date_inicio = new Carbon($cliente->fecha_inicio);
                $date_l_month = Carbon::createFromDate($date_inicio->year,$date_inicio->month-1,1);
                $mes_atrasado = $date_l_month->diffInMonths($rest_date);
                $cliente->meses_atrasados = $mes_atrasado;
            }


            
        }
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
        $cliente = Cliente::where('id',$cliente->id)->with('telefonos','ubicacion_cliente','estados','cobros.serie')->first();
        return $this->showOne($cliente);
    }

    //obtener el ultimo pago realizado
    public function getLastPayment($id){
        $payment = DB::table('cobros')->where([
                                        ['cliente_id', '=', $id],
                                        ])->order_by('fecha', 'desc')->first();

        return $this->showOne($payment);
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
