<?php

use App\Http\Controllers\API\AuthAPIController;
use App\Http\Controllers\API\CompanyAPIController;
use App\Http\Controllers\API\DepartmentAPIController;
use App\Http\Controllers\API\NotificationAPIController;
use App\Http\Controllers\API\WorkOrderAPIController;
use App\Http\Controllers\DepartmentController;
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
Route::post('login',[AuthAPIController::class,'login']);

Route::middleware(['auth:sanctum','abilities:employee'])->group(function(){

    Route::post('logout',[AuthAPIController::class,'logout']);

    Route::controller(DepartmentAPIController::class)->group(function(){
        Route::get('departemen','all');
        Route::get('departemen/{id}','findById');
    });

    Route::controller(CompanyAPIController::class)->group(function(){
        Route::get('perusahaan','all');
        Route::get('perusahaan/{id}','findById');
    });
    Route::controller(WorkOrderAPIController::class)->group(function(){
        Route::get('workorders','all');
        Route::get('workorders/{id}','show');
        Route::get('workorders/nomor/generate','generateNomor');
        Route::post('workorders','store');
    });
    Route::controller(NotificationAPIController::class)->group(function(){
        Route::get('notifications','all');
    });
});

