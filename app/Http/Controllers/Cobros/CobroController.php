<?php

namespace App\Http\Controllers\Cobros;

use App\Cobro;
use App\Serie;
use App\DetallesCobro;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class CobroController extends ApiController
{
    public function __construct()
    {
        #parent::__construct();//proteger controlador
        #$this->middleware('consulta');
    }

    //retorna vista principal del index
    public function view()
    {
       return view('layout.cobros.cobro');
    }

    //retorna todos los registros de la tabla
    public function index()
    {
        $cobros = Cobro::with('serie','cliente','detalle','cuota','detalle.mes','detalle.anio')->get();
        return $this->showAll($cobros);
    }

    //guarda registro en la tabla
    public function store(Request $request)
    {
        $reglas = [
            'cliente_id' => 'required|integer',
            'serie_id' => 'required|integer',
            'fecha' => 'required',
            'numero' => 'required',
            'detalle' => 'required'
        ];
        
        $this->validate($request, $reglas);

        DB::beginTransaction();

            $data = $request->all();

            $serie = Serie::find($request->serie_id);
            if($request->numero > $serie->total){
                return $this->errorResponse("el numero total de comprobantes se ha agotado, por favor ingrese un nuevo",421);
            }


            $data['no_actual'] = $request->inicio;
            $cobro = Cobro::create($data);

            foreach ($request->detalle as $d) {
                $detalle = new DetallesCobro;
                $detalle->cobro_id = $cobro->id;
                $detalle->agua_extra = $d['agua_extra'];
                $detalle->total_extra = $d['total_extra'];
                $detalle->total_mes = $d['total_mes'];
                $detalle->mes_id = $d['mes_id'];
                $detalle->anio_id = $d['anio_id'];
                $detalle->lectura = $d['lectura'];

                $detalle->save();
            }

            $serie->no_actual = $request->numero;
            $serie->save();

        DB::commit();

        return $this->showOne($cobro,201);
    }

    //obtiene registro por id
    public function show(Cobro $cobro)
    {
        $cobro = Cobro::where('id',$cobro->id)->with('detalle.anio','detalle.mes','detalle.cuota')->first();
        return $this->showOne($cobro);
    }

    //actualizar registro
    public function update(Request $request, Cobro $cobro)
    {
        
    }

    //eliminar registro de la tabla a nivel logico
    public function destroy(Cobro $cobro)
    {
        $cobro->anulado = 1;
        $cobro->save();
        return $this->showOne($cobro);
    }

    public function comprobante($id)
    {
        $cobro = Cobro::where('id',$id)->with('cliente','detalle.mes','detalle.anio', 'cliente.ubicacion_cliente')->first();

        $pdf = PDF::loadView('layout.cobros.comprobante_pdf',['cobro'=>$cobro]);

        #$pdf->setPaper('legal', 'portrait');

        return $pdf->stream('comprobante'.$cobro->numero.'.pdf');
    }
}
