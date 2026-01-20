<?php

use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function (Request $request) {
    return response()->json([ 'status' => 'up' ]);
});

Route::get('/users', [UsersController::class, 'index']);
Route::post('/users/create', [UsersController::class, 'store']);
Route::get('/users/{userId}', [UsersController::class, 'show']);