<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PermisoControl;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class,'inicio'])->name('inicio');
Route::get('/logueo', [UserController::class,'showlogin'])->name('login');

Route::post('/salir', [UserController::class,'salir'])->name('logout');

Route::get('/Home', [HomeController::class,'index'])->name('home')->Middleware('auth');

Route::post('/identificacion', [UserController::class,'verificarlogin'])->name('identificacion');

Route::resource('usuario', UserController::class);


Route::resource('role', RoleController::class);

Route::resource('permiso', PermisoController::class);

Route::get('/cancelarusuario',function(){
    return redirect()->route('usuario.index')->with('datos','Acción Cancelada...!');
  })->name('usuario.cancelar');

Route::resource('cliente', ClienteController::class);
Route::resource('categoria', CategoriaController::class);
Route::resource('producto', ProductoController::class);






