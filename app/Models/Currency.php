<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Модель "Информации по курсам валют"
 *
 * @property  string $currency_id          Идентификатор валюты
 * @property  string $currency_name        Наименование валюты
 * @property  string $currency_code        Код валюты
 * @property  string $currency_symbol      Символ валюты
 * @property  float $currency_value        Стоимость валюты в рублях
 * @property  Carbon $currency_created_at  Дата создания
 * @property  Carbon $currency_updated_at  Дата обновления
 * @property  Carbon $currency_deleted_at  Дата удаления
 */
class Currency extends Model
{
    use HasFactory;

    const CREATED_AT = 'currency_created_at';
    const UPDATED_AT = 'currency_updated_at';

    /** @var string */
    protected $table = 'stock_market.currencies';

    /** @var string[] */
    protected $fillable = [
        'currency_value',
        'currency_updated_at',
        'currency_deleted_at'
    ];

    public function tickers(): HasMany
    {
        return $this->hasMany(Tickers::class, 'ticker_currency_id', 'currency_id');
    }
}
