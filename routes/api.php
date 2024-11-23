<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NoteController;
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
Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::get('/user', [AuthController::class, 'getUser']);
    Route::put('/user', [AuthController::class, 'updateUser']);

    Route::post('note', [NoteController::class, 'create']);
    Route::put('note/{id}', [NoteController::class, 'edit']);
    Route::get('notes', [NoteController::class, 'list']);
    Route::get('notes/{id}', [NoteController::class, 'detail']);
});

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'createUser']);
