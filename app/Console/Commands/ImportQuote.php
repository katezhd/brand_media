<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\InsetContent;
use App\Helpers\SocialMediaHelper;

class ImportQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:quote {count=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Импорт цитаты с сайта forismatic.com';

    const JSON_URL = 'https://api.forismatic.com/api/1.0/?method=getQuote&lang=ru&format=json';

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
        $count = $this->argument('count');
        $quotes = InsetContent::whereDate('imported_at', Carbon::today())->where('type', 'quote')->get();
        
        if($count > count($quotes)) {
            $response = Http::get(ImportQuote::JSON_URL)->throw(function ($response, $e) { 
                $this->fail($e); 
            });
    
            if ($response->ok()) {
                $json = json_decode($response->getBody());
                $json = json_decode(json_encode($json), true);
                $quote = array();
    
                if(array_key_exists('quoteText', $json)) {
                    $quote['text'] = $json['quoteText'];
                    $quote['name'] = array_key_exists('quoteAuthor', $json) ? $json['quoteAuthor'] : NULL;
                }
                
                if(!empty($quote)) {
                    $quote['imported_at'] = Carbon::now()->toDateTimeString();
                    $quote['created_at'] = Carbon::now()->toDateTimeString();
                    $quote['type'] = 'quote';
                    
                    InsetContent::insert($quote);
                }
            }
        }
    }
}
