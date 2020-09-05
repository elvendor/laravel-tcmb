<?php

declare(strict_types=1);

namespace Elvendor\Tcmb;

use Elvendor\Tcmb\Models\ExchangeRate;
use DateTime;
use Exception;

class Tcmb
{
    const currencies = [
    	'USD' => ['index' => 0, 'unit'  => 1],
		'AUD' => ['index' => 1, 'unit'  => 1],
		'DKK' => ['index' => 2, 'unit'  => 1],
		'EUR' => ['index' => 3, 'unit'  => 1],
		'GBP' => ['index' => 4, 'unit'  => 1],
		'CHF' => ['index' => 5, 'unit'  => 1],
		'SEK' => ['index' => 6, 'unit'  => 1],
		'CAD' => ['index' => 7, 'unit'  => 1],
		'KWD' => ['index' => 8, 'unit'  => 1],
		'NOK' => ['index' => 9, 'unit'  => 1],
		'SAR' => ['index' => 10, 'unit' => 1],
		'JPY' => ['index' => 11, 'unit' => 100],
		'BGN' => ['index' => 12, 'unit' => 1],
		'RON' => ['index' => 13, 'unit' => 1],
		'RUB' => ['index' => 14, 'unit' => 1],
		'IRR' => ['index' => 15, 'unit' => 100],
		'CNY' => ['index' => 16, 'unit' => 1],
		'PKR' => ['index' => 17, 'unit' => 1],
		'QAR' => ['index' => 18, 'unit' => 1]
	];

	public static function fetchRates(DateTime $date) : array
	{
		$rates = [];
		$response = null;
        $response = @simplexml_load_file('http://www.tcmb.gov.tr/kurlar/' . $date->format('Ym') . '/' . $date->format('dmY') . '.xml');
        if($response){
			$currencies = config('tcmb.currencies');
			foreach($currencies as $currency){
				if(array_key_exists($currency, self::currencies)) {
					$index = self::currencies[$currency]['index'];
					data_set($rates, "{$currency}.buy", (float)$response->Currency[$index]->ForexBuying);
					data_set($rates, "{$currency}.sell", (float)$response->Currency[$index]->ForexSelling);
				}
			}
	        $response = null;
	    }
        return $rates;
	}

	public static function convert(float $amount, $from, $to, $date = false, int $decimals = 4) : float
    {
    	if($from !== $to) {
	        $date = new DateTime($date ?: date('Y-m-d'));
	        $rates = ExchangeRate::actualForDate($date)->orderByDesc('date')->first();
	        $rates = data_get($rates, 'rates');

	       	if(!$rates) {
	       		$rates = self::fetchRates($date);
	       	}

	       	if($rates && array_key_exists($to, $rates) && array_key_exists($from, $rates)) {
		        $base = 'TRY';
	            if($from === $base) {
	                $amount = $amount/(float)$rates[$to]['buy'];
	            }elseif($to === $base) {
	                $amount = $amount*(float)$rates[$from]['sell'];
	            }else {
	                $amount = $amount*(float)$rates[$from]['sell']/(float)$rates[$to]['buy'];
	            }
		    }
		}
		return (float)number_format($amount, $decimals, '.', '');
    }
}
