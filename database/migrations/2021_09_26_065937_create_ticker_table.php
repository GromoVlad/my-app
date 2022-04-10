<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Создание таблицы tickers (хранит информацию по названиям и тикерам ценных бумаг)
 */
class CreateTickerTable extends Migration
{
    private array $queries = ["COMMENT ON TABLE stock_market.tickers IS 'Таблица с тикерами и названиями организаций'"];

    public function up(): void
    {
        Schema::create('stock_market.tickers', function (Blueprint $table) {
            $table->uuid('ticker_id')->primary()->comment('Идентификатор ценной бумаги');
            $table->string('ticker_symbol', 50)->unique()->index()->comment('Тикер ценной бумаги');
            $table->string('ticker_name')->index()->nullable()->comment('Наименование ценной бумаги');
            $table->integer('ticker_lot_size')->index()->comment('Размер лота ценной бумаги');
            $table->decimal('ticker_actual_price', 8, 4)->comment('Текущая цена ценной бумаги');
            $table->uuid('ticker_currency_id')->index()->comment('Идентификатор валюты ценной бумаги');
            $table->timestamp('ticker_created_at')->nullable()->comment('Дата создания');
            $table->timestamp('ticker_updated_at')->nullable()->comment('Дата обновления');
            $table->timestamp('ticker_deleted_at')->nullable()->comment('Дата удаления');
            $table->foreign('ticker_currency_id')->references('currency_id')->on('stock_market.currencies');
        });

        foreach ($this->queries as $query) {
            DB::unprepared($query);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_market.tickers');
    }
}
