<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuariosController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba', function (){
    return 'Está es otra ruta';
});

Route::get('/clientes', [ClienteController::class,"index"])->name("cliente");
Route::get('/usuarios', [UsuariosController::class,"index"])->name("usuarios");