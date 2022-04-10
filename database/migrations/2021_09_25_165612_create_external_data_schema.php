<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

/**
 * Создание схемы stock_market (для внешних данных с информацией по курсам валют, акций и т.д.)
 */
class CreateExternalDataSchema extends Migration
{
    public function up(): void
    {
        DB::unprepared('CREATE SCHEMA stock_market');
    }

    public function down(): void
    {
        DB::unprepared('DROP SCHEMA stock_market');
    }
}
