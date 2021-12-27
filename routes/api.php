<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::prefix("v1")->group(function(){
    Route::get("/",function(){
        return response()->json(["message"=>"Api Running"]);
    });

    Route::prefix("auth")->group(function(){
        Route::post("login",[\App\Http\Controllers\AuthController::class,'login']);
        Route::get("logout",[\App\Http\Controllers\AuthController::class,'logout']);
        Route::get("refresh_token",[\App\Http\Controllers\AuthController::class,'refresh']);
        Route::get("me",[\App\Http\Controllers\AuthController::class,'me']);
    });

    Route::prefix("user")->group(function(){
        Route::post("/",[\App\Http\Controllers\UserController::class,'createUser'])->middleware(['auth:api','role:SUPER_USER']);
    });
});
