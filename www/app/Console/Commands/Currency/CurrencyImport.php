<?php

namespace App\Console\Commands\Currency;

use Domain\Currency\Services\CurrencyService;
use Illuminate\Console\Command;

class CurrencyImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    private CurrencyService $currencyService;

    public function __construct(CurrencyService $currencyService)
    {
        parent::__construct();

        $this->currencyService = $currencyService;
    }

    public function handle()
    {
        $this->currencyService->importCurrencies();
    }
}
