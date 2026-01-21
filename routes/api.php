<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function (Request $request) {
    return response()->json([ 'status' => 'up' ]);
});

Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('protected')->group(function() {
    Route::get('/users', [UsersController::class, 'index']);
    Route::post('/users', [UsersController::class, 'store']);
    Route::get('/users/{userId}', [UsersController::class, 'show']);
    Route::match(['put', 'patch'], '/users/{userId}', [UsersController::class, 'update']);
    Route::delete('/users/{userId}', [UsersController::class, 'destroy']);
});
