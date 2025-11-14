<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\lugaresController;
use App\Http\Controllers\ArbitrosController;
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


//Jorge
// vista equipo 
Route::get('/equipos', [equiposController::class, 'index'])->name('equipos.index');
Route::post('/equipos/store', [equiposController::class, 'store'])->name('equipos.store');
Route::put('/equipos/update/{id}', [equiposController::class, 'update'])->name('equipos.update');
Route::delete('/equipos/delete/{id}', [equiposController::class, 'destroy'])->name('equipos.destroy');
Route::resource('equipos', App\Http\Controllers\EquiposController::class);

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
Route::resource('arbitros', ArbitrosController::class);
//encuentros 
Route::get('/encuentros', [encuentrosController::class, 'index'])->name('encuentros.index');
Route::post('/encuentros/store', [encuentrosController::class, 'store'])->name('encuentros.store');
Route::put('/encuentros/update/{id}', [encuentrosController::class, 'update'])->name('encuentros.update');
Route::delete('/encuentros/delete/{id}', [encuentrosController::class, 'destroy'])->name('encuentros.destroy');


//Jesus
//Torneos
Route::get('/torneos', [torneosController::class,"index"])->name("torneos.index");
Route::post('/torneos/store', [torneosController::class, 'store'])->name('torneos.store');
Route::put('/torneos/update/{id}', [torneosController::class, 'update'])->name('torneos.update');
Route::delete('/torneos/delete/{id}', [torneosController::class, 'destroy'])->name('torneos.destroy');
//Tecnicos
Route::get('/tecnicos', [tecnicosController::class,"index"])->name("tecnicos.index");
Route::post('/tecnicos/store', [tecnicosController::class, 'store'])->name('tecnicos.store');
Route::put('/tecnicos/update/{id}', [tecnicosController::class, 'update'])->name('tecnicos.update');
Route::delete('/tecnicos/delete/{id}', [tecnicosController::class, 'destroy'])->name('tecnicos.destroy');
//Tipo_Falta
Route::get('/tipo_falta', [tipo_faltaController::class,"index"])->name("tipo_falta.index");
Route::post('/tipo_falta/store', [tipo_faltaController::class, 'store'])->name('tipo_falta.store');
Route::put('/tipo_falta/update/{id}', [tipo_faltaController::class, 'update'])->name('tipo_falta.update');
Route::delete('/tipo_falta/delete/{id}', [tipo_faltaController::class, 'destroy'])->name('tipo_falta.destroy');
//Usuarios
Route::get('/usuarios', [UsuariosController::class,"index"])->name("usuarios.index");
Route::post('/usuarios/store', [usuariosController::class, 'store'])->name('usuarios.store');
Route::put('/usuarios/update/{id}', [usuariosController::class, 'update'])->name('usuarios.update');
Route::delete('/usuarios/delete/{id}', [usuariosController::class, 'destroy'])->name('usuarios.destroy');


//Sebastian
//Lugares
Route::get('/lugares', [lugaresController::class, 'index'])->name('lugares.index');
Route::post('/lugares', [lugaresController::class, 'store'])->name('lugares.store');
Route::put('/lugares/{id_lugar}', [lugaresController::class, 'update'])->name('lugares.update');
Route::delete('/lugares/{id_lugar}', [lugaresController::class, 'destroy'])->name('lugares.destroy');
//Fechas
Route::get('/fechas', [fechaController::class,"index"])->name("fechas.index");
Route::get('/faltas', [faltasController::class,"index"])->name("faltas.index");
//Jugadores
Route::get('/jugadores', [jugadoresController::class,"index"])->name("jugadores.index");
Route::post('/jugadores', [jugadoresController::class, 'store'])->name('jugadores.store');
Route::put('/jugadores/{id_jugador}', [jugadoresController::class, 'update'])->name('jugadores.update');
Route::delete('/jugadores/{id_jugador}', [jugadoresController::class, 'destroy'])->name('jugadores.destroy');

//Kevin
//Roles
Route::get('/roles', [rolesController::class, 'index'])->name('roles.index');
Route::post('/roles', [rolesController::class, 'store'])->name('roles.store');
Route::put('/roles/{id_rol}', [rolesController::class, 'update'])->name('roles.update');
Route::delete('/roles/{id_rol}', [rolesController::class, 'destroy'])->name('roles.destroy');
//Resultados
Route::get('/resultados', [resultadosController::class,"index"])->name("resultados.index");
Route::post('/resultados', [resultadosController::class, 'store'])->name('resultados.store');
Route::put('/resultados/{id_rol}', [resultadosController::class, 'update'])->name('resultados.update');
Route::delete('/resulatdos/{id_rol}', [resultadosController::class, 'destroy'])->name('resultados.destroy');
//Premiacion
Route::get('/premiacion', [premiacionController::class,"index"])->name("premiacion.index");
Route::post('/premiacion', [premiacionController::class, 'store'])->name('premiacion.store');
Route::put('/premiacion/{id_rol}', [premiacionController::class, 'update'])->name('premiacion.update');
Route::delete('/premiacion/{id_rol}', [premiacionController::class, 'destroy'])->name('premiacion.destroy');
//Posiciones
Route::get('/posiciones', [posicionesController::class,"index"])->name("posiciones.index");
Route::post('/posiciones', [posicionesController::class, 'store'])->name('posiciones.store');
Route::put('/posiciones/{id_rol}', [posicionesController::class, 'update'])->name('posiciones.update');
Route::delete('/posiciones/{id_rol}', [posicionesController::class, 'destroy'])->name('posiciones.destroy');