<?php 

declare(strict_types=1);

namespace Elvendor\Tcmb\Commands;

use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Console\Command;
use Elvendor\Tcmb\Tcmb;
use Elvendor\Tcmb\Models\ExchangeRate;

class SyncRatesCommand extends Command
{
    protected $signature = 'tcmb:syncrates {date?} {endDate?}';
    protected $description = 'Get currency rates from the Central Bank of the Republic of Turkey';
    private array $rates = [];

    public function handle() : void
    {
        $begin = new DateTime($this->argument('date') ?? date('Y-m-d'));
        $end   = new DateTime($this->argument('endDate') ?? date('Y-m-d'));

        if($begin != $end) {
            $period  = new DatePeriod($begin, DateInterval::createFromDateString('1 day'), $end);
            foreach ($period as $dt){
                $this->syncRates($dt);
            }
        }else{
            $this->syncRates($begin);
        }
        ExchangeRate::insertOrIgnore($this->rates);
    }

    private function syncRates(DateTime $dt) : void
    {
        $rates = Tcmb::fetchRates($dt);
        if($rates){
            $this->info($dt->format('d.m.Y') . ' synced');
            array_push($this->rates, ['date' => $dt->format('Y-m-d'), 'rates' => json_encode($rates)]);
        }else{
            $this->error($dt->format('d.m.Y') . ' not synced');
        }
    }
}
