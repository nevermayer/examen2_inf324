<?php

namespace App\Http\Controllers;

use App\Models\Chef;
use App\Models\SolicitudChef;
use Illuminate\Http\Request;


class SolicitudChefController extends Controller
{
    public function index()
    {
        $solicitud = SolicitudChef::join('ingredientes', 'ingredientes.id', '=', 'solicitud_chef.ingredientes_id')
        ->join('chef','chef.id','=','solicitud_chef.chef_id')
        ->join('users','users.id','=','chef.id_usuario')
        ->get(['solicitud_chef.id','ingredientes.nombre as ingrediente','users.nombre as chef','solicitud_chef.cantidad','solicitud_chef.status','solicitud_chef.fecha']);
        return $solicitud;
    }
    public function Solicitud(Request $request)
    {
        $status = "pendiente";
        $fecha = date('Y-m-d');
        $data = json_decode($request->items, true);
        $chef = Chef::findOrFail($request->chef_id);
        foreach ($data as $res) {
            $chef->ingredientes()->attach($res['id'], [
                'cantidad' => $res['cantidad'],
                'status' =>  $status,
                'fecha' =>  $fecha
            ]);
            $chef->save();
        }
        $msg = "se creo la solicitud";
        return response()->json([
            "message" => $msg
        ]);
    }
}
