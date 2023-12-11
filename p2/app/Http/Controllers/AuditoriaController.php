<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;


class AuditoriaController extends Controller
{
    public function index(){
        $auditoria = Auditoria::all();
        return $auditoria;
    }

    //funcion para guardar/almacenar
    public function store( Request $request){
        $auditoria = new  Auditoria();
        $auditoria->fecha = $request->fecha;
        $auditoria->user_id = $request->user_id;
       
        $auditoria->save();
    }

}
