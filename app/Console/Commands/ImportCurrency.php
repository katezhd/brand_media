<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\InsetCurrency;
use Carbon\Carbon;

class ImportCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:currency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Импорт курса валют с сайта api.privatbank.ua';
    // https://api.privatbank.ua/p24api/exchange_rates?json&date=14.10.2021
    // const JSON_URL = 'https://api.privatbank.ua/p24api/exchange_rates?json&date=';
    const JSON_URL = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=5';

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
     * @return int
     */
    public function handle()
    {
        // $today = Carbon::now()->format('d.m.Y');
        // $url = ImportCurrency::JSON_URL . $today;
        $currencies = ['EUR', 'USD' ,'RUR', 'BTC'];

        $response = Http::get(ImportCurrency::JSON_URL)->throw(function ($response, $e) { 
            $this->fail($e); 
        });

        $json = json_decode($response->getBody());

        $currency_array = [];
        foreach ($json as $item) {
            $item = json_decode(json_encode($item), true);
            if(array_key_exists('ccy', $item)) {
                foreach ($currencies as $currency) {
                    if($item['ccy'] == $currency) {
                        array_push($currency_array, array(
                            'name' => $item['ccy'],
                            'sale' => array_key_exists('sale', $item) ? $item['sale'] : NULL,
                            'purchase' => array_key_exists('buy', $item) ? $item['buy'] : NULL,
                            'created_at' => Carbon::now()->toDateTimeString(),
                        ));
                    }
                }
            }
        }
        if(InsetCurrency::truncate()) {
            InsetCurrency::insert($currency_array);
        }
    }
}
