<?php

use App\Http\Controllers\AreaGroupController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\RegionalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorCodeCeController;
use App\Http\Controllers\ErrorCodeController;
use App\Http\Controllers\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;


Route::post('/register',[UserController::class,'store']);
Route::post('/login',[UserController::class,'login']);

Route::get('/user', function (Request $request) {
    $user = User::with('area_groups')->where('id',$request->user()->id)->first();
    return $user;
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {

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

    Route::post('/customer',[CustomerController::class,'store']);
    Route::get('/customer',[CustomerController::class,'index']);
    Route::get('/customer-list',[CustomerController::class,'list']);
    Route::get('/customer/{id}',[CustomerController::class,'show'])->where('id','[0-9]+');
    Route::put('/customer/{id}',[CustomerController::class,'update'])->where('id','[0-9]+');
    Route::delete('/customer/{id}',[CustomerController::class,'destroy'])->where('id','[0-9]+');

    Route::post('/machine',[MachineController::class,'store']);
    Route::get('/machine',[MachineController::class,'index']);
    Route::get('/machine-list',[MachineController::class,'list']);
    Route::get('/machine/{id}',[MachineController::class,'show'])->where('id','[0-9]+');
    Route::put('/machine/{id}',[MachineController::class,'update'])->where('id','[0-9]+');
    Route::delete('/machine/{id}',[MachineController::class,'destroy'])->where('id','[0-9]+');

    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::get('/dashboard/byzona',[DashboardController::class,'getByZona']);
    Route::get('/error_code',[ErrorCodeController::class,'index']);

    Route::post('/error_code_ce',[ErrorCodeCeController::class,'store']);
    Route::get('/error_code_ce',[ErrorCodeCeController::class,'index']);
    Route::get('/error_code_ce/{id}',[ErrorCodeCeController::class,'show'])->where('id','[0-9]+');
    Route::put('/error_code_ce/{id}',[ErrorCodeCeController::class,'update'])->where('id','[0-9]+');
    Route::delete('/error_code_ce/{id}',[ErrorCodeCeController::class,'destroy'])->where('id','[0-9]+');

    Route::post('/rating',[RatingController::class,'store']);
    Route::delete('/rating/{id}',[RatingController::class,'destroy'])->where('id','[0-9]+');

});


