<?php

namespace App\Http\Controllers\Reporte;

use App\Anio;
use App\Cobro;
use App\Cliente;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class ReporteController extends ApiController
{
	public function __construct()
    {
        parent::__construct();
        //$this->middleware('admin')->except(['index']);
    }

	public function view()
    {
       return view('layout.reportes.reporte');
    }

    public function cobros($inicio,$fin){

    	if($inicio != 0 && $fin!=0){
    		$cobros = Cobro::whereBetween('fecha', [$inicio, $fin])->with('cliente.ubicacion_cliente','serie')->where('anulado',false)->get();
    	}else{
    		$cobros = Cobro::with('cliente.ubicacion_cliente','serie')->where('anulado',false)->get();
    	}

    	$pdf = PDF::loadView('layout.reportes.cobros_pdf',['cobros'=>$cobros,'inicio'=>$inicio,'fin'=>$fin])->setPaper('a4', 'landscape');

        #$pdf->setPaper('legal', 'portrait');

        return $pdf->stream('cobros-'.$inicio.'-'.$fin.'.pdf');
    
    }

    public function clientes($opcion){
    	if($opcion == 2){
    		$clientes = Cliente::with('ubicacion_cliente')->where('estado',"A")->get();
    	}else if($opcion == 3){
    		$clientes = Cliente::with('ubicacion_cliente')->where('estado',"I")->get();
    	}else if($opcion == 4){
    		$clientes = Cliente::with('ubicacion_cliente')->where('deudor',true)->get();
    	}else{
    		$clientes = Cliente::with('ubicacion_cliente')->get();
    	}

    	foreach ($clientes as $cliente) {
            $meses_atrasados = $this->checkMeses($cliente);
            $meses_atrasados > 0 ? $cliente->deudor = 1 : $cliente->deudor = 0;
            $cliente->meses_atrasados = $meses_atrasados;
        }

        $option = $opcion == 2 ? 'ACTIVOS' : ($opcion == 3 ? 'INACTIVOS' : ($opcion == 4 ? 'DEUDORES': ''));

    	$pdf = PDF::loadView('layout.reportes.clientes_pdf',['clientes'=>$clientes,'option'=>$option])->setPaper('a4', 'landscape');

        #$pdf->setPaper('legal', 'portrait');

        return $pdf->stream('clientes.pdf');
    
    }

    public function checkMeses(Cliente $cliente){
        $ultimo_cobro = Cobro::where([['cliente_id',$cliente->id],['anulado',0]])->orderBy('id','desc')->take(1)->first();
        $meses_atrasados = 0;

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
            $meses_atrasados = $mes_atrasado;

        }else{
            $date_inicio = new Carbon($cliente->fecha_inicio);
            $date_l_month = Carbon::createFromDate($date_inicio->year,$date_inicio->month-1,1);
            $mes_atrasado = $date_l_month->diffInMonths($rest_date);
            $meses_atrasados = $mes_atrasado;
        }

        return $meses_atrasados;
    }
}
