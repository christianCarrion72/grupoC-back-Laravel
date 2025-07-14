<?php

use App\Http\Controllers\AsignacionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DistribuidorController;
use App\Http\Controllers\ProductoController;
use App\Models\Distribuidor;

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

Route::prefix('user')->group(function () {
    Route::get('/all', [Controller::class, 'index']);
    Route::post('/', [Controller::class, 'login']);
    Route::post('/register', [RegisteredUserController::class, 'store']);
    //actualizar usuario
    Route::put('/{id}', [Controller::class, 'update']);
    Route::get('/', [Controller::class, 'getUser']);
});

Route::get('ubicacion/{id}', [Controller::class, 'getUbicacion']);
Route::post('/ubicacion/ruta', [Controller::class, 'getUbicacionesRuta']);



Route::prefix('distribuidor')->group(function () {
    //muestra solo Usuarios distribuidores(con las ubicaciones y Distribuidor::class)
    Route::get('/', [DistribuidorController::class, 'index']);
    //obtener UN distribuidor, se inserta id_usuario 
    //verificando que el id ingresado sea un distribuidor (tablas:usuario,distribuidor,ubicacion,vehiculo)
    Route::get('/{id}', [DistribuidorController::class, 'show']);
    //Las 2 rutas son necesarias para registrar por completo un nuevo distribuidor
    //Registrar DISTRIBUIDOR(crea el distribuidor por completo)
    Route::post('/', [DistribuidorController::class, 'registrar']);
    //Insertar id_usuario(NO distribuidor->id). Actualiza vehiculo del Distribuidor 
    Route::put('/{id}/vehiculo', [DistribuidorController::class, 'registrarVehiculo']);
});




Route::get('/producto', [ProductoController::class, 'index']);
Route::get('/producto/filtro/{id}', [ProductoController::class, 'indexFiltro']);
// mostrar uno con todos los detalle
Route::get('/producto/{id}', [ProductoController::class, 'show']);
//el actualizar esta dentro del middleware


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    // actualizar datos
    Route::put('/producto/{id}', [ProductoController::class, 'update']);
    
    Route::resource('/cliente', Controller::class);

    Route::post('/ubicacion', [Controller::class, 'updateUbicacion']);


    Route::get('/vehiculo', [DistribuidorController::class, 'getVehiculo']);
    Route::post('/vehiculo', [DistribuidorController::class, 'updateVehiculo']);

    Route::get('/asignacion/{id}/estado/{estado}', [AsignacionController::class, 'cambiarEstado']);



    
    Route::prefix('compra')->group(function () {
        // 1ero crear el registro 'compra' para despues añadir a los registro de detalle_compra sus id_compra
        // ver como colocar el id_pago segun el enunciado del proyecto antes de crearlo
        Route::patch('/', [CompraController::class, 'crear']);
        // insertar Detalle de la compra(id_compra que generas) que es lo que estará registrado en el carrito(frontend)
        Route::post('/detalle', [CompraController::class, 'storeDetalle']);
        // [id_compra] Luego usar este comando para sumar los subtotales en la compra e insertarlo en la compra creada, 
        Route::put('/{id}/total', [CompraController::class, 'calcularTotal']);

        Route::get('/{filtro}', [CompraController::class, 'getCompras']);
    });

    Route::get('/asignacion', [AsignacionController::class, 'mostrar']);

    Route::patch('/distribuidor/estado', [DistribuidorController::class, 'cambiarEstado']);
    Route::get('/distribuidor/estado', [DistribuidorController::class, 'obtenerEstado']);

   
    Route::post('/observacion', [AsignacionController::class, 'insertarObservacion']);
});
