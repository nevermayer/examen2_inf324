<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportesController extends Controller
{
    public function index(Request $request)
    {
        $fecha = date('Y-m-d');
        $month = date("m");
        $year=date('Y');
        $factura = Factura::where('fecha','=', $fecha)->sum('total');
        /*  $from = date('2018-01-01');
        $to = date('Y-m-d');
        
        $semana=Factura::whereBetween('fecha',[$from, $to])->sum('total');
        return response()->json([
            "hoy" => $factura,
        "semana"=>$semana]);
        */
        $current_week = Factura::whereBetween('fecha', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total');
        $Mes = Factura::whereYear('fecha', '=', $year)
              ->whereMonth('fecha', '=', $month)
              ->sum('total');
        //$meses = Factura::where('fecha', $mes)->sum('total');
        return response()->json([
            "dia" => $factura,
            "mes"=>$Mes,
            "semana"=>$current_week
        ]);
    }
}
