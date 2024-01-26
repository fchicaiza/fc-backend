<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('api')->prefix('v1')->group(function () {

    // Auth Section
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('profile', 'App\Http\Controllers\AuthController@profile');
    Route::post('register', 'App\Http\Controllers\AuthController@register');

    // Establishment Section
    Route::prefix('establecimientos')->group(function () {
        Route::post('agregar-establecimiento', 'App\Http\Controllers\EstablishmentController@store');

    });
    // Province Section
    Route::prefix('provincias')->group(function(){
        Route::post('agregar-provincia', 'App\Http\Controllers\ProvinceController@store');
        Route::get('mostrar-detalle-provincia/{provincia}', 'App\Http\Controllers\ProvinceController@show');
        Route::get('mostrar-provincia/{provincia}/edit', 'App\Http\Controllers\ProvinceController@edit');
        Route::get('todas-provincias', 'App\Http\Controllers\ProvinceController@index');
        Route::put('editar-provincia/{provincia}', 'App\Http\Controllers\ProvinceController@update');
        Route::delete('eliminar-provincia/{provincia}', 'App\Http\Controllers\ProvinceController@destroy');
    });
    //City Section
    Route::prefix('ciudades')->group(function(){
        Route::post('agregar-ciudad', 'App\Http\Controllers\CityController@store');
        Route::get('mostrar-detalle-ciudad/{ciudad}', 'App\Http\Controllers\CityController@show');
        Route::get('mostrar-ciudad/{ciudad}/edit', 'App\Http\Controllers\CityController@edit');
        Route::get('todas-ciudades', 'App\Http\Controllers\CityController@index');
        Route::put('editar-ciudad/{ciudad}', 'App\Http\Controllers\CityController@update');
        Route::delete('eliminar-ciudad/{ciudad}', 'App\Http\Controllers\CityController@destroy');
    });
    //Zone Section
    Route::prefix('zonas')->group(function(){
        Route::post('agregar-zona', 'App\Http\Controllers\ZoneController@store');
        Route::get('mostrar-detalle-zona/{zona}', 'App\Http\Controllers\ZoneController@show');
        Route::get('todas-zonas', 'App\Http\Controllers\ZoneController@index');
        Route::put('editar-zona/{zona}', 'App\Http\Controllers\ZoneController@update');
        Route::delete('eliminar-zona/{zona}', 'App\Http\Controllers\ZoneController@destroy');
    });
    //Chanel Section
    Route::prefix('canales')->group(function(){
        Route::post('agregar-canal', 'App\Http\Controllers\ChanelController@store');
        Route::get('mostrar-detalle-canal/{canal}', 'App\Http\Controllers\ChanelController@show');
        Route::get('todos-canales', 'App\Http\Controllers\ChanelController@index');
        Route::put('editar-canal/{canal}', 'App\Http\Controllers\ChanelController@update');
        Route::delete('eliminar-canal/{canal}', 'App\Http\Controllers\ChanelController@destroy');
    });

    //Subcanal Section
    Route::prefix('subcanales')->group(function(){
        Route::post('agregar-subcanal', 'App\Http\Controllers\SubchanelController@store');
        Route::get('mostrar-detalle-subcanal/{subcanal}', 'App\Http\Controllers\SubchanelController@show');
        Route::get('todos-subcanales', 'App\Http\Controllers\SubchanelController@index');
        Route::put('editar-subcanal/{subcanal}', 'App\Http\Controllers\SubchanelController@update');
        Route::delete('eliminar-subcanal/{subcanal}', 'App\Http\Controllers\SubchanelController@destroy');
    });

    //Chain Section
    Route::prefix('cadenas')->group(function(){
        Route::post('agregar-cadena', 'App\Http\Controllers\ChainController@store');
        Route::get('mostrar-detalle-cadena/{cadena}', 'App\Http\Controllers\ChainController@show');
        Route::get('todas-cadenas', 'App\Http\Controllers\ChainController@index');
        Route::put('editar-cadena/{cadena}', 'App\Http\Controllers\ChainController@update');
        Route::delete('eliminar-cadena/{cadena}', 'App\Http\Controllers\ChainController@destroy');
    });
});


// Route::group([

//     'middleware' => 'api',
//     'prefix' => 'v1'

// ], function ($router) {

//     // Auth Section
//     Route::post('login', 'App\Http\Controllers\AuthController@login');
//     Route::post('logout', 'App\Http\Controllers\AuthController@logout');
//     Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
//     Route::post('profile', 'App\Http\Controllers\AuthController@profile');
//     Route::post('register', 'App\Http\Controllers\AuthController@register');

//     // Establishment Section
//     Route::post('establecimientos/agregar-establecimiento', 'App\Http\Controllers\EstablishmentController@createEsteblishment');

// });
