<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Factura;
use App\Models\Orden;
class FacturaController extends Controller
{

    public function index()
    {
        $facturas = Factura::all();
        return $facturas;
    }
    public function store(Request $request)
    {
        $fecha = date('Y-m-d');
        $ordenes =$request->ordenes;
       $factura = Factura::create([
            'total' => $request->total,
            'fecha' => $fecha,
            'cliente_id'=>$request->cliente_id,
            'cajero_id' => $request->cajero_id,
        ]);
        foreach($ordenes as $id){
            $orden=Orden::find($id);
            $orden->factura_id=$factura->id;
            $orden->save();
        }
        return response()->json([
            "data" => $factura->id]);
    }
    public function show($id)
    {
        $factura = Factura::find($id);
        $orden=Orden::where('factura_id','=',$id)
        ->with('productos')
        ->get();
        return response()->json([
            "factura" => $factura,
            "consumo"=>$orden,
            "cliente"=>$factura->cliente
        ]);
    }
    public function update(Request $request, $id)
    {
        $factura = Factura::findOrFail($request->id);
        $factura->total = $request->total;
        $factura->fecha = $request->fecha;
        $factura->cajero_id = $request->cajero_id;
        $factura->orden_id = $request->orden_id;
        $factura->cliente_id = $request->cliente_id;

        $factura->save();
        return response()->json([
            "success" => true,
            "data" => $factura
        ]);
    }
    public function destroy($id)
    {
        $factura = Factura::destroy($id);
        return response()->json([
            "success" => true,
            "data" => $factura
        ]);
    }
}
