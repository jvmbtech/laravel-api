<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/status', function (Request $request) {
    return response()->json([ 'status' => 'up' ]);
});
