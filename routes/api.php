<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

Route::get('nao-autorizado', function () {
    return ['message' => 'Usuário não autorizado'];
})->name('login');

Route::post('/register', [AuthController::class, 'register']);
Route::post('/auth', [AuthController::class, 'auth']);
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');

Route::post('/todos', [TodoController::class, 'store'])->middleware('auth:sanctum');
Route::get('/todos', [TodoController::class, 'index'])->middleware('auth:sanctum');
Route::get('/todos/{id}', [TodoController::class, 'show'])->middleware('auth:sanctum');
Route::put('/todos/{id}', [TodoController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/todos/{id}', [TodoController::class, 'destroy'])->middleware('auth:sanctum');
