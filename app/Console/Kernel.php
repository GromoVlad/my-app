<?php

declare(strict_types=1);

namespace App\Console;

use App\Services\Currency\CurrencyService;
use App\Services\Markets\RussianMarketService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->exec('php artisan passport:purge --revoked')->everyMinute();
        $schedule->call(new CurrencyService)->everyMinute();
        $schedule->call(new RussianMarketService)->everyMinute();
    }

    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
