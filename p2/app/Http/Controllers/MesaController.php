<?php

namespace App\Http\Controllers;

use App\Models\Mesa;
use Illuminate\Http\Request;


class MesaController extends Controller
{
    public function index(){
        $mesa = Mesa::all();
        return $mesa;
    }

    //funcion para guardar/almacenar
    public function store( Request $request){
        $mesa = new  Mesa();
        $mesa->nombre = $request->nombre;
        $mesa->min_capacidad = $request->min_capacidad;
        $mesa->max_capacidad = $request->max_capacidad;
        $mesa->status = $request->status;
        $mesa->camarero_id = $request->camarero_id;
        $mesa->cliente_id = $request->cliente_id;
        $mesa->save();
    }

    // Para capturar por id cada mesa
    public function show( $id){

       $mesa = Mesa::find($id);
        return $mesa;
    }

    public function update( Request $request,$id){

        $mesa = Mesa::findOrFail($id);
        $mesa->nombre = $request->nombre;
        $mesa->min_capacidad = $request->min_capacidad;
        $mesa->max_capacidad = $request->max_capacidad;
        $mesa->status = $request->status;
        $mesa->camarero_id = $request->camarero_id;
        $mesa->cliente_id = $request->cliente_id;
        $mesa->save();
        return $mesa;
     }

     //Para eliminar

     public function destroy($id){
        $mesa = Mesa::destroy($id);
        return $mesa;
     }
     public function setCamarero(Request $request)
     {
         $mesa = Mesa::find($request->mesa_id);
         $mesa->camarero_id=$request->camarero_id;
         $mesa->save();
         return response()->json([
            "success" => true,
            "message" => "se asigno camarero satisfactoriamente"
        ]);
    }
}
