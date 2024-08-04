<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmpleadoController;

Route::get('/', function () {
    return view('auth.login');
});

//las comento porque con la de abaajo ya no son necesarias
/*Route::get('/empleado', function () {
    return view('empleado.index');
});

Route::get('empleado/create', [EmpleadoController::class,'create']);*/

Route::resource('empleado', EmpleadoController::class)-> middleware('auth'); // con esta instruccion puedo acceder a todas las url de empleado
Auth::routes(['register'=>false, 'reset'=>false]);

Route::get('/home', [EmpleadoController::class, 'index'])->name('home');

Route::group(['middleware' => 'auth'], function (){

    Route::get('/', [EmpleadoController::class, 'index'])->name('home');
});