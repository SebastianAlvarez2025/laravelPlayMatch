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


//Jorge
Route::get('/arbitros', [arbitrosController::class,"index"])->name("arbitros");
Route::get('/categorias', [categoriasController::class,"index"])->name("categorias");
Route::get('/encuentros', [encuentrosController::class,"index"])->name("encuentros");
Route::get('/equipos', [equiposController::class,"index"])->name("equipos");

//Jesus
//Torneos
Route::get('/torneos', [torneosController::class,"index"])->name("torneos");
Route::post('/torneos/store', [torneosController::class, 'store'])->name('torneos.store');
Route::put('/torneos/update/{id}', [torneosController::class, 'update'])->name('torneos.update');
Route::delete('/torneos/delete/{id}', [torneosController::class, 'destroy'])->name('torneos.destroy');
//Tecnicos
Route::get('/tecnicos', [tecnicosController::class,"index"])->name("tecnicos");
Route::post('/tecnicos/store', [tecnicosController::class, 'store'])->name('tecnicos.store');
Route::put('/tecnicos/update/{id}', [tecnicosController::class, 'update'])->name('tecnicos.update');
Route::delete('/tecnicos/delete/{id}', [tecnicosController::class, 'destroy'])->name('tecnicos.destroy');
//Tipo_Falta
Route::get('/tipo_falta', [tipo_faltaController::class,"index"])->name("tipo_falta");
Route::post('/tipo_falta/store', [tipo_faltaController::class, 'store'])->name('tipo_falta.store');
Route::put('/tipo_falta/update/{id}', [tipo_faltaController::class, 'update'])->name('tipo_falta.update');
Route::delete('/tipo_falta/delete/{id}', [tipo_faltaController::class, 'destroy'])->name('tipo_falta.destroy');
//Usuarios
Route::get('/usuarios', [UsuariosController::class,"index"])->name("usuarios");
Route::post('/usuarios/store', [usuariosController::class, 'store'])->name('usuarios.store');
Route::put('/usuarios/update/{id}', [usuariosController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/delete/{id}', [usuariosController::class, 'destroy'])->name('usuarios.destroy');



//Sebastian
Route::get('/lugares', [lugaresController::class,"index"])->name("lugares");
Route::get('/fechas', [fechaController::class,"index"])->name("fechas");
Route::get('/faltas', [faltasController::class,"index"])->name("faltas");
Route::get('/jugadores', [jugadoresController::class,"index"])->name("jugadores");

//Kevin
Route::get('/roles', [rolesController::class,"index"])->name("roles");
