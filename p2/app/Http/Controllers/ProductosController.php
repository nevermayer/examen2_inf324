<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Producto;
use App\Models\Bebida;
use App\Models\Platillo;
use App\Models\Postre;


class ProductosController extends Controller
{

    public function index()
    {
        $productos = Producto::all();
        return $productos;
    }
    public function store(Request $request)
    {
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->imagen = $request->imagen;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->save();

        if ($request->producto == "platillo") {
            $temp = new Platillo();
            $temp->producto_id = $producto->id;
            $temp->tiempo_elaboracion = $request->tiempo_elaboracion;
        }
        if ($request->producto == "postre") {
            $temp = new Postre();
            $temp->producto_id = $producto->id;
            $temp->tiempo_elaboracion = $request->tiempo_elaboracion;
        }
        if ($request->producto == "bebida") {
            $temp = new Bebida();
            $temp->producto_id = $producto->id;
            $temp->grado_alcoholico = $request->grado_alcoholico;
        }
        $temp->save();
    }
    public function show($id)
    {
        $producto = Producto::find($id);
        isset($producto->platillos);
        isset($producto->postres);
        isset($producto->bebidas);
        return $producto;
    }
    public function update(Request $request, $id)
    {

        $producto = Producto::findOrFail($id);
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->imagen = $request->imagen;
        $producto->precio = $request->precio;
        $producto->cantidad = $request->cantidad;
        $producto->save();
        if ($request->platillo_id > 0) {
            $temp = Platillo::findOrFail($request->platillo_id);
            $temp->tiempo_elaboracion = $request->tiempo_elaboracion;
            $temp->ingredientes()->sync($request->items);
        }
        if ($request->postre_id > 0) {
            $temp = Postre::findOrFail($request->postre_id);
            $temp->tiempo_elaboracion = $request->tiempo_elaboracion;
            $temp->ingredientes()->sync($request->items);
        }
        if ($request->bebida_id > 0) {
            $temp = Bebida::findOrFail($request->bebida_id);
            $temp->grado_alcoholico = $request->grado_alcoholico;
        }
        $temp->save();
        return $producto;
    }
    public function destroy($id)
    {
        $producto = Producto::destroy($id);
        return $producto;
    }

    public function getplatillos()
    {
        //$platillos = Platillo::join('productos', 'productos.id', '=', 'platillos.producto_id')->with('ingredientes')->get();
        // $platillos = Platillo::with(['producto'])->with(['ingredientes'=> function ($query) {$query->select('nombre','imagen');}])->get();
        $platillos = Platillo::join('productos', 'productos.id', '=', 'platillos.producto_id')
            ->where('productos.status', '=', 'activo')
            ->where('productos.cantidad', '>', 0)
            ->get(['productos.*', 'tiempo_elaboracion']);
        return $platillos;
    }

    public function getpostres()
    {
        $postres = Postre::join('productos', 'productos.id', '=', 'postres.producto_id')
            ->where('productos.status', '=', 'activo')
            ->where('productos.cantidad', '>', 0)
            ->get(['productos.*', 'tiempo_elaboracion']);
        //$postres = Postre::join('productos', 'productos.id', '=', 'postres.producto_id')
        //   ->get(['productos.*', 'tiempo_elaboracion']);
        return $postres;
    }

    public function getbebidas()
    {
        $bebidas = Bebida::join('productos', 'productos.id', '=', 'bebidas.producto_id')
            ->where('productos.status', '=', 'activo')
            ->where('productos.cantidad', '>', 0)
            ->get(['productos.*', 'grado_alcoholico']);
        return $bebidas;
    }
    public function getplatillo($id)
    {
        $temp = Platillo::findOrFail($id);
        return $temp->ingredientes;
    }
    public function getpostre($id)
    {
        $temp = Postre::findOrFail($id);
        return $temp->ingredientes;
    }
    public function getbebida($id)
    {
        $temp = Bebida::findOrFail($id);
        return $temp->ingredientes;
    }
    public function productosStatus(Request $request, $id){
        $producto = Producto::findOrFail($id);
        $producto->status = $request->estado;
        $producto->save();
    }
}
