<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Модель "Ценнных бумаг"
 *
 * @package App\Models
 *
 * @property string $ticker_id              Идентификатор ценной бумаги
 * @property string $ticker_symbol          Тикер организации
 * @property string $ticker_name            Наименование ценной бумаги
 * @property integer $ticker_lot_size       Размер лота ценной бумаги
 * @property string $ticker_currency_id     Идентификатор валюты ценной бумаги
 * @property Carbon $ticker_created_at      Дата создания
 * @property Carbon $ticker_updated_at      Дата обновления
 * @property Carbon $ticker_deleted_at      Дата удаления
 */
class Tickers extends Model
{
    use HasFactory;

    const CREATED_AT = 'ticker_created_at';
    const UPDATED_AT = 'ticker_updated_at';

    protected $table = 'stock_market.tickers';

    protected $fillable = [
        'ticker_id',
        'ticker_symbol',
        'ticker_name',
        'ticker_lot_size',
        'ticker_currency_id',
        'ticker_updated_at',
        'ticker_deleted_at'
    ];

    public function currency(): HasOne
    {
        return $this->hasOne(Currency::class, 'currency_id', 'ticker_currency_id');
    }

    public function securities(): HasMany
    {
        return $this->hasMany(Security::class, 'security_ticker_id', 'ticker_id');
    }
}
