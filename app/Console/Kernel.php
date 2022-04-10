<?php

namespace App\Console;

use App\Dto\Currency\CurrencyDto;
use App\Enums\CurrencyCode;
use App\Models\Currency;
use App\Models\Tickers;
use App\Services\Currency\CurrencyService;
use GuzzleHttp\Client;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Uuid;
use SimpleXMLElement;

class Kernel extends ConsoleKernel
{

    const MOEX_CURRENCY_RATES_URI = "https://iss.moex.com/iss/statistics/engines/currency/markets/selt/rates.xml";

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->exec('php artisan passport:purge --revoked')->everyMinute();
        $schedule->call(new CurrencyService)->everyMinute();;
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Dto');

        require base_path('routes/console.php');
    }
}
