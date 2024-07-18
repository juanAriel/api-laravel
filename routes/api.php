<?php

use App\Http\Controllers\EstablishmentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('login',[LoginController::class,'login']);

Route::middleware('auth:sanctum')->group(function(){
    Route::get('establishments', [EstablishmentController::class, 'index']);

    Route::get('establishments/{establishment}', [EstablishmentController::class, 'show']);

    Route::get('products/{product}', [ProductsController::class, 'show'])->name('products:show');

    Route::get('/user', function(Request $request){
        return Auth::user();
    });
});