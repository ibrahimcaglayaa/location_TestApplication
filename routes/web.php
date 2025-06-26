<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;

Route::get('/', function () {
    return view('main');
});

Route::post('/konum-ekle', [LocationController::class, 'store'])->name('konum.ekle');
