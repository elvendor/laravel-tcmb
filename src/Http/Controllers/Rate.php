<?php 

declare(strict_types=1);

namespace Elvendor\Tcmb\Http\Controllers;

use Elvendor\Tcmb\Models\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Elvendor\Tcmb\Http\Resources\ExchangeRateResource;

class Rate extends Controller
{
    public function __invoke(Request $request)
    {
        $rates = ExchangeRate::whereNotNull('rates')
            ->actualForDate($request->input('date', date('Y-m-d')))
            ->orderByDesc('date')
            ->first();
        return new ExchangeRateResource($rate);
    }
}
