<?php

/**
 * Заполняем таблицу первоначальными данными по валютам и их курсу
 */

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Ramsey\Uuid\Uuid;

/**
 * Заполняем таблицу первоначальными данными по валютам и их курсу
 */
class CurrencySeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        Currency::insert([
            [
                'currency_id' => Uuid::uuid4(),
                'currency_name' => 'Рубль',
                'currency_code' => 'RUB',
                'currency_symbol' => '₽',
                'currency_value' => 1,
                'currency_created_at' => date_create(),
            ],
            [
                'currency_id' => Uuid::uuid4(),
                'currency_name' => 'Доллар',
                'currency_code' => 'USD',
                'currency_symbol' => '$',
                'currency_value' => 75,
                'currency_created_at' => date_create(),
            ],
            [
                'currency_id' => Uuid::uuid4(),
                'currency_name' => 'Евро',
                'currency_code' => 'EUR',
                'currency_symbol' => '€',
                'currency_value' => 85,
                'currency_created_at' => date_create(),
            ]
        ]);
    }
}
