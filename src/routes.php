<?php

use Illuminate\Support\Facades\Route;

use Elvendor\Tcmb\Http\Controllers\Rate;
use Elvendor\Tcmb\Http\Controllers\Rates;
use Elvendor\Tcmb\Http\Controllers\Convert;

Route::get('tcmb/rate/{date?}', Rate::class);
Route::get('tcmb/rates/{start_date}/{end_date}', Rates::class);
Route::get('tcmb/convert/{from}/{to}/{amount}/{date?}', Convert::class);