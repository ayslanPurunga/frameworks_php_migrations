<?php

use App\Http\Controllers\AulaController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('aulas', [AulaController::class, 'index']);
Route::get("aulas/nova", [AulaController::class, 'create']);
Route::post("aulas", [AulaController::class, 'store']);
Route::get('aulas/{id}/editar', [AulaController::class, 'edit']);
Route::put('aulas/{id}', [AulaController::class, 'update']);
Route::delete('aulas/{id}', [AulaController::class, 'destroy']);