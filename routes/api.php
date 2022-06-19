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
    /**
     * Получает список задач текущего пользователя
     */
    Route::get('/tasks', [TaskController::class, 'index']);

    /**
     * Получает информацию о задаче по ее id
     */
    Route::get('/tasks/{id}', [TaskController::class, 'show']);

    /**
     * Создает задачу для текущего пользователя
     */
    Route::post('/tasks', [TaskController::class, 'create']);

    /**
     * Редактирует задачу
     */
    Route::put('/tasks/{id}', [TaskController::class, 'update']);


    /**
     * Удаляет задачу в корзину (устанаваливает delete_at)
     */
    Route::delete('/tasks/{id}', [TaskController::class, 'destroy']);

    /**
     * Восстанавливает задачу  из корзины (deleted_at = null)
     */
    Route::post('/tasks/{id}/restore', [TaskController::class, 'restore']);

// Checklists

    /**
     * Действия методов аналогичны как у задач
     */
    Route::get('/checklists', [ChecklistController::class, 'index']);
    Route::get('/checklists/{id}', [ChecklistController::class, 'show']);
    Route::post('/checklists', [ChecklistController::class, 'create']);
    Route::put('/checklists/{id}', [ChecklistController::class, 'update']);
    Route::delete('/checklists/{id}', [ChecklistController::class, 'destroy']);
    Route::post('/checklists/{id}/restore', [ChecklistController::class, 'restore']);

// Элементы чеклистов (галочки)

    Route::get('/checks', [TickController::class, 'index']);
    Route::get('/checks/{id}', [TickController::class, 'show']);
    Route::post('/checks', [TickController::class, 'create']);
    Route::put('/checks/{id}', [TickController::class, 'update']);
    Route::delete('/checks/{id}', [TickController::class, 'destroy']);
    Route::post('/checks/{id}/restore', [TickController::class, 'restore']);
});

