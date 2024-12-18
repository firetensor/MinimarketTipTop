<?php

use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UserController;
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

Route::get('reportes', [ReporteController::class, 'getReportes']);

Route::get('reporteStock', [ReporteController::class,'reporteStockapi']);
Route::get('reporteVentaDetallada', [ReporteController::class,'reporteVentaDetalladaapi']);

Route::post('login', [UserController::class,'verificarlogin']);



