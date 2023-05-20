<?php

use App\Http\Controllers\LotController;
use App\Http\Controllers\OfferController;
use Illuminate\Support\Facades\Route;


Route::resource('lots', LotController::class)->only(['index', 'store']);
Route::get('lots/my-lots', [LotController::class, 'myLots']);

Route::resource('offers', OfferController::class)->only(['store']);

