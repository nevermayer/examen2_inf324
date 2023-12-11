<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UsersController;
use App\Http\Controllers\IngredientesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\OrdenController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\SolicitudChefController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\ReportesController;

use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('menu','App\Http\Controllers\MenuController@index');
Route::post('register', [UsersController::class, 'register']);
Route::post('login', [UsersController::class, 'login']);

Route::group(['middleware' => ["auth:sanctum"]], function () {
    Route::get('usuario-profile', [UsersController::class, 'userprofile']);
    Route::get('logout', [UsersController::class, 'logout']);
});
Route::get('users', [UsersController::class, 'index']);
Route::get('user/{id}', [UsersController::class, 'show']);
Route::put('user/{id}', [UsersController::class, 'update']);
Route::delete('user/{id}', [UsersController::class, 'destroy']);
Route::get('getcamarero', [UsersController::class, 'getCamarero']);

// PARTE INGREDIENTES
Route::controller(IngredientesController::class)->group(function () {
    Route::get('/ingredientes', 'index');
    Route::post('/ingrediente', 'store');
    Route::get('/ingrediente/{id}', 'show');
    Route::put('/ingrediente/{id}', 'update');
    Route::delete('/ingrediente/{id}', 'destroy');
});

// PARTE MESA
Route::controller(MesaController::class)->group(function () {
    Route::get('/mesa', 'index');
    Route::post('/mesa', 'store');
    Route::get('/mesa/{id}', 'show');
    Route::put('/mesa/{id}', 'update');
    Route::delete('/mesa/{id}', 'destroy');
    Route::post('/setcamarero', 'setCamarero');
});

// PARTE ORDEN
Route::controller(OrdenController::class)->group(function () {
    Route::get('/orden', 'index');
    Route::post('/orden', 'store');
    Route::post('/ordenes', 'createorder');
    Route::put('/changestatus/{id}', 'changeStatus');
    Route::get('/orden/{id}', 'show');
    Route::get('/ordenfactura/{id}', 'ordenfactura');
    Route::put('/orden/{id}', 'update');
    Route::delete('/orden/{id}', 'destroy');
});


// PRODUCTOS...
Route::controller(ProductosController::class)->group(function () {
    Route::get('/productos', 'index');
    Route::put('/productosstatus/{id}', 'productosStatus');
    Route::get('/platillos', 'getplatillos');
    Route::get('/postres', 'getpostres');
    Route::get('/bebidas', 'getbebidas');
    Route::get('/platillo/{id}', 'getplatillo');
    Route::get('/postre/{id}', 'getpostre');
    Route::get('/bebida/{id}', 'getbebida');
    Route::post('/producto', 'store');
    Route::get('/producto/{id}', 'show');
    Route::put('/producto/{id}', 'update');
    Route::delete('/producto/{id}', 'destroy');
});
// CLIENTE
Route::controller(ClienteController::class)->group(function () {
    Route::get('/clientes', 'index');
    Route::post('/cliente', 'store');
    Route::post('/auth/login', 'login');
    Route::get('/cliente/{id}', 'show');
    Route::put('/cliente/{id}', 'update');
    Route::delete('/cliente/{id}', 'destroy');
});

// FACTURA
Route::controller(FacturaController::class)->group(function () {
    Route::get('/facturas', 'index');
    Route::post('/factura', 'store');
    Route::get('/factura/{id}', 'show');
    Route::put('/factura/{id}', 'update');
    Route::delete('/factura/{id}', 'destroy');
});
Route::controller(SolicitudChefController::class)->group(function () {
    Route::get('solicitud-chef','index');
    Route::post('solicitud-chef','Solicitud');
});

//AUDITORIA
Route::controller(AuditoriaController::class)->group(function () {
    Route::get('auditoria','index');
    Route::post('auditoria','store');
});
//REPORTES
Route::controller(ReportesController::class)->group(function () {
    Route::get('reportes','index');
});
//MAIL....
Route::controller(MailController::class)->group(function () {
    Route::post('send-mail','index'); 
});