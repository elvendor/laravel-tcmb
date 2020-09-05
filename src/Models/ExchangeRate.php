<?php 

declare(strict_types=1);

namespace Elvendor\Tcmb\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    protected $guarded = [];
    protected $primaryKey = 'date';
    public $timestamps = false;
    public $incrementing = false;
    public $casts = ['rates' => 'array'];

    public function scopePeriod($query, $start, $end)
    {
        return $query->whereRaw('date BETWEEN ? AND ?', [$start, $end]);
    }

    public function scopeActualForDate($query, $date)
    {
        return $query->whereDate('date', '<=', $date);
    }
}