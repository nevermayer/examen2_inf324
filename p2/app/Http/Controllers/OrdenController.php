<?php

namespace App\Http\Controllers;

use App\Models\Orden;
use App\Models\Producto;
use App\Models\Mesa;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    public function index()
    {
        $orden = Orden::all();
        return $orden;
    }

    //funcion para guardar/almacenar
    public function store(Request $request)
    {
        $orden = new  Orden();
        $orden->nombre = $request->nombre;
        $orden->apellido_pat = $request->apellido_pat;
        $orden->total = $request->total;
        $orden->estado = $request->estado;
        $orden->fecha = $request->fecha;
        $orden->hora = $request->hora;
        $orden->telefono = $request->telefono;
        $orden->chef_id = $request->chef_id;
        $orden->camarero_id = $request->camarero_id;
        $orden->save();
    }

    // Para capturar por id cada orden
    public function show($id)
    {
        $orden = Orden::find($id);
        isset($orden->productos);
        return $orden;
    }

    public function update(Request $request, $id)
    {

        $orden = Orden::findOrFail($id);
        $orden->nombre = $request->nombre;
        $orden->apellido_pat = $request->apellido_pat;
        $orden->total = $request->total;
        $orden->estado = $request->estado;
        $orden->fecha = $request->fecha;
        $orden->hora = $request->hora;
        $orden->telefono = $request->telefono;
        $orden->chef_id = $request->chef_id;
        $orden->camarero_id = $request->camarero_id;
        $orden->save();
        return $orden;
    }

    //Para eliminar

    public function destroy($id)
    {
        $orden = Orden::destroy($id);
        return $orden;
    }
    public function createorder(Request $request)
    {
        $data = json_decode($request->items, true);
        $all_ids = array();
        foreach ($data as $el) {
            array_push($all_ids, $el['id']);
        }
        $productos = Producto::select('id', 'cantidad')->whereIn('id', $all_ids)->pluck('cantidad', 'id');
        foreach ($data as $res) {
            if (!isset($productos[$res['id']]) || $productos[$res['id']] < $res['qty']) {
                $msg = 'sin existencias de: ' . $res['nombre'];
                return response()->json([
                    "message" => $msg
                ]);
            }
        }
        $fecha = date('Y-m-d');
        $orden = Orden::create([
            'total' => $request->total,
            'estado' => 'Elaboracion',
            'fecha' => $fecha,
            'camarero_id' => $request->camarero_id,
            'mesa_id'=>$request->mesa_id
        ]);
        foreach ($data as $res) {
            $orden->productos()->attach($res['id'], [
                'cantidad' => $res['qty']
            ]);
            Producto::find($res['id'])->decrement('cantidad', $res['qty']);
        }
        $mesa=Mesa::findOrFail($request->mesa_id);
        $mesa->camarero_id=$request->camarero_id;
        $mesa->status='ocupado';
        $mesa->save();
        $msg = "se creo la orden";
        return response()->json([
            "message" => $msg
        ]);
    }
    public function ordenfactura($id)
    {
        $orden=Orden::where('id','=',$id)->first();
        if(!isset($orden->factura_id)){
isset($orden->productos);
return response()->json([
    "message" => "false",
"data"=>$orden]);
        }
        return response()->json([
            "message" => "La Orden ya ha sido facturada"]);        
    }
    public function changeStatus(Request $request, $id){
        $orden = Orden::findOrFail($id);
        $orden->estado = $request->estado;
        $orden->save();
    }
}
