<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListUserController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('/register', [AuthController::class, 'register']);
Route::get('/listuser',[ListUserController::class , 'listuser'])->middleware('auth:api');
Route::get('/listuser/{user}',[ListUserController::class , 'show'])->middleware('auth:api');
Route::get('/user/todos', [UserController::class, 'index'])->middleware('auth:api');

Route::post('/login', [AuthController::class, 'login']);
Route::resource('/todos',TodoController::class)->middleware('auth:api');
Route::put('/status/{todo}',[TodoController::class,'edittodo'])->middleware('auth:api');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
