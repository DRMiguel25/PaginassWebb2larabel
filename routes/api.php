<?php
//el mas importante 
use App\Http\Controllers\api\userController;
use App\Http\Controllers\api\ProductosController;
use App\Http\Controllers\api\PokemonesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//  para las  pruebas
Route::post('hola', function(){
    return 'Hello World!';
});

//  para login de usuario
Route::post('user/login', [UserController::class, 'login']);

Route::post('usuario', [userController::class, 'create']);

// Rutas protegidas 
 Route::group(['middleware' => ['auth:sanctum']], function() {
//comentar para crear un usuario nuevo
    //Este es de usuarios
    Route::prefix('usuario')->group(function() {
        Route::get('', [userController::class, 'index']); // jalar todos los usuarios
        Route::post('', [userController::class, 'create']); // Hacer un nuevo usuario
        Route::get('/{id}', [userController::class, 'show'])->where('id', '[0-9]+'); // Mostrar un usuario
        Route::patch('/{id}', [userController::class, 'update'])->where('id', '[0-9]+'); // Actualizar un usuario
        Route::delete('/{id}', [userController::class, 'destroy'])->where('id', '[0-9]+'); // Eliminar un usuario
    });

    //Este es de Pokenome
    Route::prefix('pokemon')->group(function() {
        Route::get('', [pokemonescontroller::class, 'index']); // jalar todos los Pokémon
        Route::post('', [pokemonescontroller::class, 'store']); // Hacer un nuevo Pokémon
        Route::get('/{id}', [pokemonescontroller::class, 'show'])->where('id', '[0-9]+'); // Mostrar un Pokémon
        Route::patch('/{id}', [pokemonescontroller::class, 'update'])->where('id', '[0-9]+'); // Actualizar un Pokémon
        Route::delete('/{id}', [pokemonescontroller::class, 'destroy'])->where('id', '[0-9]+'); // Eliminar un Pokémon por ID
    });
}); 

// jalar usuario autenticado
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
