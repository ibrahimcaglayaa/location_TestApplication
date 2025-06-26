<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Models\Location;


Route::get('/', function () {
    return view('main');
});

Route::post('/konum-ekle', [LocationController::class, 'store'])->name('konum.ekle');


Route::get('/konumlar', function () {
    return response()->json(Location::all());
});


Route::post('/konum-guncelle', [LocationController::class, 'update'])->name('konum.guncelle');
