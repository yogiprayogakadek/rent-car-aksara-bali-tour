<?php

use App\Http\Controllers\Backend\CarModelController;
use App\Http\Controllers\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

// BACKEND
Route::prefix('/admin')->name('admin.')->group(function () {
    // DASHBOARD
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
    });

    // CAR MODEL
    Route::controller(CarModelController::class)->prefix('/car-models')->name('car-models.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{id}', 'edit')->name('edit');
        Route::put('/update/{id}', 'update')->name('update');
        Route::delete('/delete/{id}', 'destroy')->name('destroy');
    });
});
