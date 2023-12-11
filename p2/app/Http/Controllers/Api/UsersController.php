<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Administrador;
use App\Models\Auditoria;
use App\Models\Cajero;
use App\Models\Camarero;
use App\Models\Chef;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    public function register(Request $request)
    {
        $request->validate([
            'nombre_cuenta' => 'required|unique:users',
            'password' => 'required|confirmed',
            'nombre' => 'required',
            'apellido_pat' => 'required',
            'apellido_mat' => 'required',
            'activo' => 'required',
            'super_usuario' => 'required',
            'turno' => 'required'
        ]);
        $usuario = new User();
        $usuario->nombre_cuenta = $request->nombre_cuenta;
        $usuario->password = Hash::make($request->password);
        $usuario->nombre = $request->nombre;
        $usuario->apellido_pat = $request->apellido_pat;
        $usuario->apellido_mat = $request->apellido_mat;
        $usuario->activo = $request->activo;
        $usuario->super_usuario = $request->super_usuario;
        $usuario->turno = $request->turno;
        $usuario->save();
        if ($request->role == '') {
            return response()->json([
                "success" => true,
                "message" => "Registro de usuario exitoso",
            ]);
        }
        if ($request->role == "admin") {
            $role = new Administrador();
            $role->id_usuario = $usuario->id;
        }
        if ($request->role == "cajero") {
            $role = new Cajero();
            $role->id_usuario = $usuario->id;
        }
        if ($request->role == "chef") {
            $role = new Chef();
            $role->id_usuario = $usuario->id;
        }
        if ($request->role == "camarero") {
            $role = new Camarero();
            $role->id_usuario = $usuario->id;
        }
        $role->save();
        return response()->json([
            "success" => true,
            "message" => "Registro de usuario exitoso",
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'nombre_cuenta' => 'required',
            'password' => 'required'
        ]);
        $usuario = User::where("nombre_cuenta", "=", $request->nombre_cuenta)->first();
        if (isset($usuario->id)) {
            if (Hash::check($request->password, $usuario->password)) {
                //creando token 
                $token = $usuario->createToken("auth_token")->plainTextToken;
                Auditoria::create([
                    'fecha' => date('Y-m-d'),
                    'id_usuario' => $usuario->id
                ]);
                isset($usuario->chefs);
                isset($usuario->camareros);
                isset($usuario->cajeros);
                isset($usuario->administradors);
                return response()->json([
                    "success" => true,
                    "message" => "Usuario logueado exitosamente",
                    "access_token" => $token,
                    "user"=>$usuario,
                ]);
            } else {
                return response()->json([
                    "success" => false,
                    "message" => "el password es incorrecto",
                ]);
            }
        } else {
            return response()->json([
                "success" => false,
                "message" => "usuario no registrado",
            ]);
        }
    }
    public function userprofile()
    {
        return response()->json([
            "success" => true,
            "message" => "perfil del usuario",
            "data" => auth()->user()
        ]);
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            "success" => true,
            "message" => "cierre de session",
        ]);
    }
    public function index()
    {
        $usuario = User::all();
        return response()->json([
            "success" => true,
            "data" => $usuario
        ]);
    }
    public function show($id) 
    {
        $usuario = User::find($id);
        isset($usuario->administradors->id);
        isset($usuario->chefs->id);
        isset($usuario->camareros->id);
        isset($usuario->cajeros->id);
        return response()->json([
            "success" => true,
            "data" => $usuario
        ]);
    }
    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);
        $usuario->nombre_cuenta = $request->nombre_cuenta;
        if (isset($request->password))
            $usuario->password = Hash::make($request->password);
        $usuario->nombre = $request->nombre;
        $usuario->apellido_pat = $request->apellido_pat;
        $usuario->apellido_mat = $request->apellido_mat;
        $usuario->activo = $request->activo;
        $usuario->super_usuario = $request->super_usuario;
        $usuario->turno = $request->turno;
        $usuario->save();
        return $usuario;
    }
    public function destroy($id)
    {
        $usuario = User::destroy($id);
        return $usuario;
    }
    public function getCamarero()
    {
        $camarero   = Camarero::join('users', 'users.id', '=', 'camarero.id_usuario')->get(['users.*', 'camarero.id']);
        return $camarero;
    }
}
