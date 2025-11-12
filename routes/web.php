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
use App\Http\Controllers\rolesController;
use App\Http\Controllers\resultadosController;
use App\Http\Controllers\premiacionController;
use App\Http\Controllers\posicionesController;
use App\Http\Controllers\torneosController;
use App\Http\Controllers\tecnicosController;
use App\Http\Controllers\tipo_faltaController;


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

Route::get('/equipos', [equiposController::class, 'index'])->name('equipos.index');
Route::post('/equipos/store', [equiposController::class, 'store'])->name('equipos.store');
Route::put('/equipos/update/{id}', [equiposController::class, 'update'])->name('equipos.update');
Route::delete('/equipos/delete/{id}', [equiposController::class, 'destroy'])->name('equipos.destroy');



//Jesus
Route::get('/torneos', [torneosController::class,"index"])->name("torneos");
Route::get('/tecnicos', [tecnicosController::class,"index"])->name("tecnicos");
Route::get('/tipo_falta', [tipo_faltaController::class,"index"])->name("tipo_falta");


//Sebastian
Route::get('/lugares', [lugaresController::class,"index"])->name("lugares");
Route::get('/fechas', [fechaController::class,"index"])->name("fechas");
Route::get('/faltas', [faltasController::class,"index"])->name("faltas");
Route::get('/jugadores', [jugadoresController::class,"index"])->name("jugadores");

//Kevin
Route::get('/roles', [rolesController::class, 'index'])->name('roles.index');
Route::post('/roles', [rolesController::class, 'store'])->name('roles.store');
Route::put('/roles/{id_rol}', [rolesController::class, 'update'])->name('roles.update');
Route::delete('/roles/{id_rol}', [rolesController::class, 'destroy'])->name('roles.destroy');
Route::get('/resultados', [resultadosController::class,"index"])->name("resultados");
Route::get('/premiacion', [premiacionController::class,"index"])->name("premiacion");
Route::get('/posiciones', [posicionesController::class,"index"])->name("posiciones");