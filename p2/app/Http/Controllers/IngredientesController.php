<?php

namespace App\Http\Controllers;

use App\Models\Ingrediente;
use Illuminate\Http\Request;



class IngredientesController extends Controller
{
    
    public function index(){
        $ingredientes = Ingrediente::all();
        return $ingredientes;
    }

    //funcion para guardar/almacenar
    public function store( Request $request){
        $ingrediente = new  Ingrediente();
        $ingrediente->stock = $request->stock;
        $ingrediente->nombre = $request->nombre;
        $ingrediente->imagen = $request->imagen;
        $ingrediente-> fecha_vencimiento= $request->fecha_vencimiento;
        
        $ingrediente->save();
    }

    // Para capturar por id cada ingrediente
    public function show( $id){

       $ingrediente = Ingrediente::find($id);
        return $ingrediente;
    }

    public function update( Request $request,$id){

        $ingrediente = Ingrediente::findOrFail($id);
        $ingrediente->stock = $request->stock;
        $ingrediente->nombre = $request->nombre;
        $ingrediente->imagen = $request->imagen;
        $ingrediente-> fecha_vencimiento= $request->fecha_vencimiento;
        $ingrediente->save();
        return $ingrediente;
     }

     //Para eliminar

     public function destroy($id){
        $ingrediente = Ingrediente::destroy($id);
        return $ingrediente;
     }

}
