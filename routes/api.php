<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CategoryController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Boards
Route::get('users/{userId}/boards', [BoardController::class, 'index']);
Route::post('users/{userId}/boards', [BoardController::class, 'store']);
Route::get('boards/{boardId}', [BoardController::class, 'show']);
Route::post('boards/{boardId}', [BoardController::class, 'update']);
Route::delete('boards/{boardId}', [BoardController::class, 'destroy']);

// Categories
Route::get('boards/{boardId}/categories', [CategoryController::class, 'index']);
Route::post('boards/{boardId}/categories', [CategoryController::class, 'store']);
Route::get('boards/{boardId}/categories/{categoryId}', [CategoryController::class, 'show']);
Route::post('boards/{boardId}/categories/{categoryId}', [CategoryController::class, 'update']);
Route::delete('boards/{boardId}/categories/{categoryId}', [CategoryController::class, 'destroy']);

// Cards
Route::get('categories/{categoryId}/cards', [CardController::class, 'index']);
Route::post('categories/{categoryId}/cards', [CardController::class, 'store']);
Route::get('categories/{categoryId}/cards/{cardId}', [CardController::class, 'show']);
Route::post('categories/{categoryId}/cards/{cardId}', [CardController::class, 'update']);
Route::delete('categories/{categoryId}/cards/{cardId}', [CardController::class, 'destroy']);
