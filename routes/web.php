<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\lugaresController;
use App\Http\Controllers\arbitrosController;
use App\Http\Controllers\categoriasController;
Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba', function (){
    return 'Está es otra ruta';
});

Route::get('/clientes', [ClienteController::class,"index"])->name("cliente");
Route::get('/usuarios', [UsuariosController::class,"index"])->name("usuarios");
Route::get('/lugares', [lugaresController::class,"index"])->name("lugares");
Route::get('/arbitros', [arbitrosController::class,"index"])->name("arbitros");
Route::get('/categorias', [categoriasController::class,"index"])->name("categorias");


