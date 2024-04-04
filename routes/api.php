<?php

use App\Http\Controllers\AreaGroupController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/area-group',[AreaGroupController::class,'store']);
Route::put('/area-group/{id}',[AreaGroupController::class,'update'])->where('id','[0-9]+');

Route::post('/register',[UserController::class,'store']);


Route::post('/regional',[RegionalController::class,'store']);
Route::get('/regional',[RegionalController::class,'index']);
Route::put('/regional/{id}',[RegionalController::class,'update'])->where('id','[0-9]+');
