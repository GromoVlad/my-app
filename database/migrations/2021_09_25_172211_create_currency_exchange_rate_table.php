<?php

/**
 * Создание таблицы currency_exchange_rates (хранит информацию по курсам валют)
 */

declare(strict_types=1);

use Database\Seeders\CurrencySeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Создание таблицы currency (хранит информацию по курсам валют)
 */
class CreateCurrencyExchangeRateTable extends Migration
{
    private array $queries = ["COMMENT ON TABLE stock_market.currencies IS 'Информация по курсам валют'"];

    public function up(): void
    {
        Schema::create('stock_market.currencies', function (Blueprint $table) {
            $table->uuid('currency_id')->primary()->comment('Идентификатор валюты');
            $table->string('currency_name', 255)->index()->comment('Наименование валюты');
            $table->enum('currency_code', ['USD', 'RUB', 'SUR','EUR'])->index()->comment('Код валюты');
            $table->enum('currency_symbol', ['$', '₽', '€'])->index()->comment('Символ валюты');
            $table->decimal('currency_value', 16, 8 )->comment('Стоимость валюты в рублях');
            $table->timestamp('currency_created_at')->nullable()->comment('Дата создания');
            $table->timestamp('currency_updated_at')->nullable()->comment('Дата обновления');
            $table->timestamp('currency_deleted_at')->nullable()->comment('Дата удаления');
        });

        foreach ($this->queries as $query) {
            DB::unprepared($query);
        }

        (new CurrencySeeder())->run();
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_market.currencies');
    }
}
