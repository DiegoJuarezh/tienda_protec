<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ArticulosController;
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
Route::get('showArticulos',     [ArticulosController::class, 'showArticulos']);
Route::get('showArticulo/{id}', [ArticulosController::class, 'showArticulo']);
Route::post('nuevoArticulo',    [ArticulosController::class, 'nuevoArticulo']);
Route::post('bajaArticulo',     [ArticulosController::class, 'bajaArticulo']);

Route::post('edicionArticulo',      [ArticulosController::class, 'edicionArticulo']);
Route::post('actualizacionArticulo',[ArticulosController::class, 'actualizacionArticulo']);