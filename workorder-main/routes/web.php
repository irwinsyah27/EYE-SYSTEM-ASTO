<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\WorkOrder1Controller;
use App\Http\Controllers\WorkOrder2Controller;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',[AuthController::class,'index'])->name('login');
Route::post('/auth',[AuthController::class,'auth'])->name('auth');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('auth')->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Karyawan
    Route::resource('/karyawan',EmployeeController::class);

    // Route Departement
    Route::resource('/departemen',DepartmentController::class);

    // Route Company
    Route::resource('/perusahaan',CompanyController::class);

     // Route Company
     Route::resource('/unit',UnitController::class);
     Route::get('unit/{type}/get-by-type',[UnitController::class,'getByType'])->name('unit.getByType');
     Route::get('/unit/{unit}/get-egi', [UnitController::class,'getEgiByUnit'])->name('unit.get-egi');

    // Route WorkOrder1
    Route::controller(WorkOrder1Controller::class)->group(function(){
        Route::get('workorder-1', 'index')->name('workorder1');
        Route::get('workorder-1/{id}/show', 'show')->name('workorder1.show');
        Route::put('workorder-1/{id}/accept', 'accept')->name('workorder1.accept');
        Route::put('workorder-1/{id}/reject', 'reject')->name('workorder1.reject');
        Route::delete('workorder-1/{id}', 'destroy')->name('workorder1.destroy');
    });

    // Route WorkOrder2
    Route::controller(WorkOrder2Controller::class)->group(function(){
        Route::get('workorder-2', 'index')->name('workorder2');
        Route::get('workorder-2/{id}/edit', 'edit')->name('workorder2.edit');
        Route::put('workorder-2/{id}/update', 'update')->name('workorder2.update');
        Route::get('workorder-2/{id}/print', 'print')->name('workorder2.print');
        Route::delete('workorder-2/{id}', 'destroy')->name('workorder2.destroy');

        Route::get('workorder-approved', 'getWoApproved')->name('wo_approved');
    });

    Route::controller(LaporanController::class)->group(function() {
        Route::get('laporan','index')->name('laporan');
        Route::get('laporan/{id}/detail','show')->name('laporan.show');
    });

    Route::controller(ReportController::class)->group(function() {
        Route::get('report','index')->name('report');
        Route::get('report/export','export')->name('report.export');
    });
});
