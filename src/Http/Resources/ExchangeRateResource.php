<?php 

declare(strict_types=1);

namespace Elvendor\Tcmb\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ExchangeRateResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'date' => $this->date,
            'rates' => $this->rates
        ];
    }
}
