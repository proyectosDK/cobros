<?php

namespace App\Http\Controllers\Dashboard;

use App\Anio;
use App\Cobro;
use App\Cliente;
use Carbon\Carbon;
use App\DetallesCobro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiController;

class DashboardController extends ApiController
{
    public function __construct()
    {
        parent::__construct();
        //$this->middleware('admin')->except(['index']);
    }

    public function info()
    {
        $clientes_1 = Cliente::all();
        $total_cobros = Cobro::where('anulado',0)->sum('total');

        $clientes = $clientes_1->count();

        $inactivos = $clientes_1->where('estado','=','I')->count();  
        $deudores = $clientes_1->where('deudor','=',1)->count();

        return response()->json([
            'clientes'=>$clientes,
            'total_cobros'=>$total_cobros,
            'inactivos'=>$inactivos,
            'deudores'=>$deudores
            ], 200);
    }

    public function cobrosMeses(){
        $labels = array();
        $values = array();

        $cobros = DB::table('detalles_cobros')
                     ->join('cobros', 'cobros.id', '=', 'detalles_cobros.cobro_id')
                     ->join('anios', 'anios.id', '=', 'detalles_cobros.anio_id')
                     ->join('mes', 'mes.id', '=', 'detalles_cobros.mes_id')
                     ->select(DB::raw('sum(detalles_cobros.total_mes) as total_cobros,anios.anio as anio, mes.mes as mes'))
                     ->where('cobros.anulado', '=', 0)
                     ->groupBy('anio','mes.id','mes')
                     ->orderBy('anio','desc')
                     ->orderBy('mes.id','desc')
                     ->take(12)
                     ->get();

        foreach ($cobros as $c) {
            array_push($labels, $c->mes.'/'.$c->anio);
            array_push($values, $c->total_cobros);
       }

       return response()->json(['info'=>$values,'labels'=>$labels], 200);
    }

    public function cobrosAnios(){
        $labels = array();
        $values = array();

        $cobros = DB::table('cobros')
                     ->join('detalles_cobros', 'cobros.id', '=', 'detalles_cobros.cobro_id')
                     ->join('anios', 'anios.id', '=', 'detalles_cobros.anio_id')
                     ->join('mes', 'mes.id', '=', 'detalles_cobros.mes_id')
                     ->select(DB::raw('sum(detalles_cobros.total_mes) as total_cobros,anios.anio'))
                     ->where('cobros.anulado', '=', 0)
                     ->groupBy('anios.anio')
                     ->orderBy('anios.anio','desc')
                     ->limit(12)
                     ->get();

        #$cobros = $cobros->sortBy('id')->sortBy('anio');

        foreach ($cobros as $c) {
            array_push($labels, $c->anio);
            array_push($values, $c->total_cobros);
       }

       return response()->json(['info'=>$values,'labels'=>$labels], 200);
    }

    public function infoUbicacion(){
        $labels = array();
        $values = array();

        $clientes = DB::table('clientes')
                    ->join('ubicacions','ubicacions.id','=','clientes.ubicacion_id')
                    ->select(DB::raw('count(clientes.ubicacion_id) as cantidad, ubicacions.nombre'))
                    ->groupBy('ubicacions.nombre')
                    ->get();

        foreach ($clientes as $c) {
            array_push($labels, $c->nombre);
            array_push($values, $c->cantidad);
        }

       return response()->json(['info'=>$values,'labels'=>$labels], 200);
    }

    public function infoUbicacionDeudores(){
        $labels = array();
        $values = array();

        $clientes = DB::table('clientes')
                    ->join('ubicacions','ubicacions.id','=','clientes.ubicacion_id')
                    ->select(DB::raw('count(clientes.ubicacion_id) as cantidad, ubicacions.nombre'))
                    ->where('clientes.deudor','=',1)
                    ->groupBy('ubicacions.nombre')
                    ->get();

        foreach ($clientes as $c) {
            array_push($labels, $c->nombre);
            array_push($values, $c->cantidad);
        }

       return response()->json(['info'=>$values,'labels'=>$labels], 200);
    }
}
