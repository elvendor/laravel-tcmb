<?php

use Illuminate\Support\Facades\Route;
use Elvendor\Tcmb\Http\Controllers\ExchangeRates;
use Elvendor\Tcmb\Http\Controllers\ExchangeRate;

Route::get('tcmb/rates/{date?}', ExchangeRate::class);
Route::get('tcmb/convert/{from}/{to}/{amount}/{date?}', ConvertRates::class);