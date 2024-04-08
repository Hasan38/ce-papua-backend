<?php

use App\Http\Controllers\AreaGroupController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register',[UserController::class,'store']);
Route::post('/login',[UserController::class,'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/area-group',[AreaGroupController::class,'index']);
    Route::get('/area-group-list',[AreaGroupController::class,'list']);
    Route::post('/area-group',[AreaGroupController::class,'store']);
    Route::get('/area-group/{id}',[AreaGroupController::class,'show'])->where('id','[0-9]+');
    Route::put('/area-group/{id}',[AreaGroupController::class,'update'])->where('id','[0-9]+');
    Route::delete('/area-group/{id}',[AreaGroupController::class,'destroy'])->where('id','[0-9]+');

   

    Route::post('/regional',[RegionalController::class,'store']);
    Route::get('/regional',[RegionalController::class,'index']);
    Route::get('/regional-list',[RegionalController::class,'list']);
    Route::get('/regional/{id}',[RegionalController::class,'show'])->where('id','[0-9]+');
    Route::put('/regional/{id}',[RegionalController::class,'update'])->where('id','[0-9]+');
    Route::delete('/regional/{id}',[RegionalController::class,'destroy'])->where('id','[0-9]+');

    Route::get('/users',[UserController::class,'index']);
    Route::get('/users/{id}',[UserController::class,'show']);
    Route::put('/users/{id}',[UserController::class,'update']);
    Route::delete('/users/{id}',[UserController::class,'destroy']);
});