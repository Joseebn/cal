<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\ApiFixerServices;

class CurrencyExchangeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:currency-exchange {type}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get last or historical day currency exchange and save in database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param  \App\Support\DripEmailer  $drip
     * @return mixed
     */
    public function handle(ApiFixerServices $apiFixerServices)
    {
        $currencyExchange = $this->currencyExchange($apiFixerServices);
        foreach ($currencyExchange->rates as $key => $value) {
            var_dump('1 ' . $currencyExchange->base . ' = ' . $value . ' ' . $key);
        }
    }


    private function currencyExchange($apiFixerServices) {
    	$params = [
    		'base' => 'EUR',
    		//'symbols' => 'USD,CAD,GBP,JPY,CNY,INR,AUD,HKD,SGD' // tirar de base de datos
    	];
    	return $apiFixerServices->getCurrency($this->argument('type'), $params);
    }
}