<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Модель "Ценных бумаг пользователей"
 *
 * @package App\Models
 *
 * @property string $security_id                Идентификатор данных о ценной бумаге
 * @property integer $security_user_id          Идентификатор пользователя
 * @property string $security_ticker_id         Идентификатор тикера ценной бумаги
 * @property float $security_price              Стоимость ценной бумаги
 * @property integer $security_number_stocks    Количество ценных бумаг данного тикера
 * @property Carbon $security_purchase_date     Дата покупки ценных бумаг
 * @property Carbon $security_created_at        Дата создания
 * @property Carbon $security_updated_at        Дата обновления
 */
class Security extends Model
{
    use HasFactory;

    const CREATED_AT = 'security_created_at';
    const UPDATED_AT = 'security_updated_at';

    protected $table = 'users.securities';

    protected $fillable = [
        'security_id',
        'security_user_id',
        'security_ticker_id',
        'security_price',
        'security_number_stocks',
        'security_purchase_date',
        'security_created_at',
        'security_updated_at'
    ];

    public function ticker(): HasOne
    {
        return $this->hasOne(Tickers::class, 'ticker_id', 'security_ticker_id');
    }
}

