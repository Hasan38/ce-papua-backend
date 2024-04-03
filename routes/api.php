<?php

use App\Http\Controllers\AreaGroupController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/area-group',[AreaGroupController::class,'store']);
Route::put('/area-group/{id}',[AreaGroupController::class,'update'])->where('id','[0-9]+');
