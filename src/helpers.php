<?php

declare(strict_types=1);

use Elvendor\Tcmb\Tcmb;

if (!function_exists('currency_convert')) {
    function currency_convert(float $amount, $from, $to, $date = false, int $decimals = 4) : float
    {
        return Tcmb::convert($amount, $from, $to, $date, $decimals);
    }
}