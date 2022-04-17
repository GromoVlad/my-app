<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

/**
 * Создание таблицы securities (хранит данные о ценных бумагах)
 */
class CreateUserStocksTable extends Migration
{
    private array $queries = ["COMMENT ON TABLE users.securities IS 'Данные о ценных бумагах пользователей'"];

    public function up(): void
    {
        Schema::create('users.securities', function (Blueprint $table) {
            $table->uuid('security_id')->primary()->comment('Идентификатор данных о ценной бумаге');
            $table->integer('security_user_id')->index()->comment('Идентификатор пользователя');
            $table->uuid('security_ticker_id')->index()->comment('Идентификатор тикера ценной бумаги');
            $table->decimal('security_price_purchase', 16, 8)->comment('Стоимость ценной бумаги на момент покупки');
            $table->integer('security_number_stocks')->comment('Количество ценных бумаг данного тикера');
            $table->date('security_purchase_date')->index()->comment('Дата покупки ценных бумаг');
            $table->timestamp('security_created_at')->nullable()->comment('Дата создания');
            $table->timestamp('security_updated_at')->nullable()->comment('Дата обновления');
            $table->foreign('security_user_id')->references('id')->on('users.users');
            $table->foreign('security_ticker_id')->references('ticker_id')->on('stock_market.tickers');
        });

        foreach ($this->queries as $query) {
            DB::unprepared($query);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('users.securities');
    }
}
