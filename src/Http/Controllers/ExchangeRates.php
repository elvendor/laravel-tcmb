<?php 

declare(strict_types=1);

namespace Elvendor\Tcmb\Http\Controllers;

use Elvendor\Tcmb\Models\ExchangeRate;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Elvendor\Tcmb\Http\Resources\ExchangeRateResource;

class ExchangeRates extends Controller
{
    public function __invoke(Request $request)
    {
        $rates = ExchangeRate::whereNotNull('rates')
            ->period($request->input('start_date', date('Y-m-d')), $request->input('end_date', date('Y-m-d')))
            ->orderByDesc('date')
            ->get();
        return ExchangeRateResource::collection($rates);
    }
}
