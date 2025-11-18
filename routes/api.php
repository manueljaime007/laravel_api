<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PostController as _V1_PostController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello', function(){
    return [
        "data" => [
            "message" => "Hello, Laravel API!"
        ]
    ];
});


Route::prefix('v1')->group(function(){
    Route::apiResource('posts', _V1_PostController::class);
});

// Route::prefix('v2')->group(function(){
//     Route::apiResource('posts',  _V2_PostController::class);
// });
