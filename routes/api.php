<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Rutas para usuarios
Route::resource('users',UserController::class);
//Route::post('/users/create', [UserController::class, 'create']);
//Route::put('/users/{user}/update', [UserController::class, 'update']);
//Route::delete('/users/{user}/delete', [UserController::class, 'destroy']);
//Route::get('/usuarios/mayores-de-25', [UserController::class, 'mayoresDe25']);
Route::get('/usuarios-mayores-25',[UserController::class,'mayoresDe25']);

// Rutas para imágenes
Route::post('/images/create', [ImageController::class, 'create']);
Route::put('/images/{image}/update', [ImageController::class, 'update']);
Route::delete('/images/{image}/delete', [ImageController::class, 'destroy']);

