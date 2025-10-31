<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\lugaresController;
use App\Http\Controllers\arbitrosController;
use App\Http\Controllers\categoriasController;
use App\Http\Controllers\encuentrosController;
use App\Http\Controllers\equiposController;
use App\Http\Controllers\fechaController;
use App\Http\Controllers\faltasController;
use App\Http\Controllers\jugadoresController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/prueba', function (){
    return 'Está es otra ruta';
});

Route::get('/clientes', [ClienteController::class,"index"])->name("cliente");
Route::get('/usuarios', [UsuariosController::class,"index"])->name("usuarios");

//Jorge
Route::get('/arbitros', [arbitrosController::class,"index"])->name("arbitros");
Route::get('/categorias', [categoriasController::class,"index"])->name("categorias");
Route::get('/encuentros', [encuentrosController::class,"index"])->name("encuentros");
Route::get('/equipos', [equiposController::class,"index"])->name("equipos");

//Sebastian
Route::get('/lugares', [lugaresController::class,"index"])->name("lugares");
Route::get('/fechas', [fechaController::class,"index"])->name("fechas");
Route::get('/faltas', [faltasController::class,"index"])->name("faltas");
Route::get('/jugadores', [jugadoresController::class,"index"])->name("jugadores");
