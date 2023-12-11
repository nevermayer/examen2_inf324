<?php

namespace App\Http\Controllers;

use App\Models\Auditoria;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::all();
        return $clientes;
    }
    public function store(Request $request)
    {
        $cliente = new Cliente();
        $cliente->id = $request->ci;
        $cliente->nombre = $request->nombre;
        $cliente->apellido_pat = $request->apellido_pat;
        $cliente->apellido_mat = $request->apellido_mat;
        $cliente->email = $request->email;
        $cliente->password = Hash::make($request->password);
        $cliente->telefono = $request->telefono;
        $cliente->activo = $request->activo;
        $cliente->save();
        return $cliente;
    }
    public function show($id)
    {
        $cliente = Cliente::find($id);
        if (isset($cliente->id))
            return response()->json([
                "message" => true,
                "data" => $cliente
            ]);
        return response()->json([
            "message" => false
        ]);
    }
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($request->id);
        $cliente->nombre = $request->nombre;
        $cliente->apellido_pat = $request->apellido_pat;
        $cliente->apellido_mat = $request->apellido_mat;
        $cliente->email = $request->email;
        $cliente->password = Hash::make($request->password);
        $cliente->telefono = $request->telefono;
        $cliente->activo = $request->activo;

        $cliente->save();
        return $cliente;
    }
    public function destroy($id)
    {
        $cliente = Cliente::destroy($id);
        return $cliente;
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $usuario = User::where("nombre_cuenta", "=", $request->email)->first();
        if (isset($usuario->id)) {
            if (Hash::check($request->password, $usuario->password)) {
                if (count($usuario->camareros) > 0)
                    $role = 'camarero';
                if (count($usuario->cajeros)> 0)
                    $role = 'cajero';
                if (count($usuario->chefs)>0)
                    $role = 'chef';
                if (count($usuario->administradors)>0)
                    $role = 'admin';
                $token = $usuario->createToken("auth_token")->plainTextToken;
                return response()->json([
                    "success" => true,
                    "message" => "Usuario logueado exitosamente",
                    "access_token" => $token,
                    "user" => $usuario,
                    "role" => $role
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "el password es incorrecto",
                ]);
            }
        } else {
            $cliente = Cliente::where("email", "=", $request->email)->first();

            if (isset($cliente->id)) {
                if (Hash::check($request->password, $cliente->password)) {
                    return response()->json([
                        "success" => true,
                        "message" => "Usuario logueado exitosamente",
                        "user" => $cliente,
                        "role" => "cliente"
                    ]);
                } else {
                    return response()->json([
                        "success" => false,
                        "message" => "el password es incorrecto",
                    ]);
                }
            }
        }
        return response()->json([
            "success" => false,
            "message" => "usuario no registrado",
        ]);
    }
}
