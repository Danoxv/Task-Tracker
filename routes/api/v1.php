<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ChecklistController;
use App\Http\Controllers\TickController;

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

Route::post('login', [AuthController::class, 'signin']);
Route::post('register', [AuthController::class, 'signup']);

Route::middleware('auth:sanctum')->group(function () {

    Route::prefix('/tasks')->group(function () {
        Route::get('/', [TaskController::class, 'index']);
        Route::get('/{id}', [TaskController::class, 'show']);
        Route::post('/create', [TaskController::class, 'create']);
        Route::put('/{id}', [TaskController::class, 'update']);
        Route::delete('/{id}', [TaskController::class, 'destroy']);
        Route::post('/{id}/restore', [TaskController::class, 'restore']);
    });


// Checklists

    /**
     * Действия методов аналогичны как у задач
     */
    Route::prefix('/checklists')->group(function () {
        Route::get('/', [ChecklistController::class, 'index']);
        Route::get('/{id}', [ChecklistController::class, 'show']);
        Route::post('/create', [ChecklistController::class, 'create']);
        Route::put('/{id}', [ChecklistController::class, 'update']);
        Route::delete('/{id}', [ChecklistController::class, 'destroy']);
        Route::post('/{id}/restore', [ChecklistController::class, 'restore']);
    });


// Элементы чеклистов (галочки)
    Route::prefix('/checks')->group(function () {
        Route::get('/', [TickController::class, 'index']);
        Route::get('/{id}', [TickController::class, 'show']);
        Route::post('/create', [TickController::class, 'create']);
        Route::put('/{id}', [TickController::class, 'update']);
        Route::delete('/{id}', [TickController::class, 'destroy']);
        Route::post('/{id}/restore', [TickController::class, 'restore']);
    });

});

