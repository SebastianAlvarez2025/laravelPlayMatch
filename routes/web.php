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

Route::get('/usuarios', [UsuariosController::class,"index"])->name("usuarios");

//Jorge
// vista equipo 
Route::get('/equipos', [equiposController::class, 'index'])->name('equipos.index');
Route::post('/equipos/store', [equiposController::class, 'store'])->name('equipos.store');
Route::put('/equipos/update/{id}', [equiposController::class, 'update'])->name('equipos.update');
Route::delete('/equipos/delete/{id}', [equiposController::class, 'destroy'])->name('equipos.destroy');
// vista categorias 
Route::get('/categorias', [categoriasController::class, 'index'])->name('categorias.index');
Route::post('/categorias/store', [categoriasController::class, 'store'])->name('categorias.store');
Route::put('/categorias/update/{id}', [categoriasController::class, 'update'])->name('categorias.update');
Route::delete('/categorias/delete/{id}', [categoriasController::class, 'destroy'])->name('categorias.destroy');
// arbitros 

Route::get('/arbitros', [arbitrosController::class, 'index'])->name('arbitros.index');
Route::post('/arbitros/store', [arbitrosController::class, 'store'])->name('arbitros.store');
Route:: put('/arbitros/update/{id}', [arbitrosController::class, 'update'])->name('arbitros.update');
Route::delete('/arbitros/delete/{id}', [arbitrosController::class, 'destroy'])->name('arbitros.destroy');
//encuentros 
Route::get('/encuentros', [encuentrosController::class, 'index'])->name('encuentros.index');
Route::post('/encuentros/store', [encuentrosController::class, 'store'])->name('encuentros.store');
Route::put('/encuentros/update/{id}', [encuentrosController::class, 'update'])->name('encuentros.update');
Route::delete('/encuentros/delete/{id}', [encuentrosController::class, 'destroy'])->name('encuentros.destroy');


//Jesus
Route::get('/torneos', [torneosController::class,"index"])->name("torneos.index");
Route::get('/tecnicos', [tecnicosController::class,"index"])->name("tecnicos.index");
Route::get('/tipo_falta', [tipo_faltaController::class,"index"])->name("tipo_falta.index");


//Sebastian
//Lugares
Route::get('/lugares', [lugaresController::class, 'index'])->name('lugares.index');
Route::post('/lugares', [lugaresController::class, 'store'])->name('lugares.store');
Route::put('/lugares/{id_lugar}', [lugaresController::class, 'update'])->name('lugares.update');
Route::delete('/lugares/{id_lugar}', [lugaresController::class, 'destroy'])->name('lugares.destroy');
//Fechas
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