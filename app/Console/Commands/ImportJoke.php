<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Http;
use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\InsetContent;
use App\Helpers\SocialMediaHelper;

class ImportJoke extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:joke {count=100}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Импорт анекдота с сайта rzhunemogu.ru';

    const XML_URL = 'http://rzhunemogu.ru/Rand.aspx?CType=1';

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
        $jokes = InsetContent::whereDate('imported_at', Carbon::today())->where('type', 'joke')->get();
        
        if($count > count($jokes)) {
            $response = Http::get(ImportJoke::XML_URL)->throw(function ($response, $e) { 
                $this->fail($e); 
            });

            if ($response->ok()) {
                $xmlObject = simplexml_load_string(iconv("windows-1251", "utf-8", $response->getBody()));
                if(!empty($xmlObject->content->__toString())) {
                    $joke = array(
                        'text' => $xmlObject->content->__toString(),
                        'imported_at' => Carbon::now()->toDateTimeString(),
                        'created_at' => Carbon::now()->toDateTimeString(),
                        'type' => 'joke'
                    );

                    InsetContent::insert($joke);
                }
            }
        }
    }
}
