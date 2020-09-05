<?php 

declare(strict_types=1);

namespace Elvendor\Tcmb\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Elvendor\Tcmb\Tcmb;

class Convert extends Controller
{
    public function __invoke(Request $request)
    {
        return Tcmb::convert($amount, $from, $to, $date, $decimals);
    }
}
