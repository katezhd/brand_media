<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\InsetHoroscopeSign;
use App\Models\InsetHoroscope;
use Carbon\Carbon;
use App\Helpers\SocialMediaHelper;

class ImportHoroscope extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:horoscope';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Импорт гороскопа с сайта ignio.com';

    const XML_URL = 'https://ignio.com/r/export/utf/xml/daily/com.xml';
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
        $response = Http::get(ImportHoroscope::XML_URL)->throw(function ($response, $e) { 
            $this->fail($e); 
        });

        if ($response->ok()) {
            $signs = InsetHoroscopeSign::get();

            $xmlObject = simplexml_load_string($response->getBody());
            $horoscope = array();
            foreach ($xmlObject->children() as $child) { 
                foreach ($signs as $sign) {
                    if($child->getName() == $sign->slug) {
                        array_push($horoscope, array(
                            'sign_id' => $sign->id,
                            'text' => trim($child->today->__toString(), " \t\n\r"),
                            'created_at' => Carbon::now()->toDateTimeString(),
                        ));

                        $data = array(
                            'sign_name' => $sign->name,
                            'slug' => $sign->slug,
                            'text' => trim($child->today->__toString(), " \t\n\r"),
                        );

                        SocialMediaHelper::generate_image($sign->slug, 'horoscope', $data, false);
                    }
                }
            }
            if(InsetHoroscope::truncate()) {
                InsetHoroscope::insert($horoscope);
            }
        }

    }
}
