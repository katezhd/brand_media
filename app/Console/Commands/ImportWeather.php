<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\InsetWeatherCity;
use App\Models\InsetWeather;
use Carbon\Carbon;


class ImportWeather extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:weather';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Импорт погоды с сайта openweathermap.org';
    // const JSON_URL = 'api.openweathermap.org/data/2.5/weather?appid=35b4e8effcc623676e7574df04d98811&lang=ua&units=metric&q=';
    const JSON_URL = 'api.openweathermap.org/data/2.5/forecast?appid=35b4e8effcc623676e7574df04d98811&lang=ua&units=metric&q=';

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
        $cities = InsetWeatherCity::get();

        if(!empty($cities)) {
            $weather_array = [];
            foreach ($cities as $city) {
                $response = Http::get(ImportWeather::JSON_URL . $city->name)->throw(function ($response, $e) { 
                    $this->fail($e); 
                });

                if($response->ok()) {
                    $json = json_decode($response->getBody());
                    $json = json_decode(json_encode($json), true);

                    array_push($weather_array, $this->sort_array($json, 0, $city->id));
                    array_push($weather_array, $this->sort_array($json, 8, $city->id));
                    array_push($weather_array, $this->sort_array($json, 16, $city->id));
                    array_push($weather_array, $this->sort_array($json, 24, $city->id));
                    array_push($weather_array, $this->sort_array($json, 32, $city->id));
                }
            }
            if(InsetWeather::truncate()) {
                InsetWeather::insert($weather_array);
            }
        }
    }

    public function sort_array($json, $id, $city_id) {
        return array(
            'name' => array_key_exists('weather', $json['list'][$id]) 
                    && array_key_exists(0, $json['list'][$id]['weather']) 
                    && array_key_exists('main', $json['list'][$id]['weather'][0]) 
                    ? strtolower($json['list'][$id]['weather'][0]['main']) : NULL,
            'temp' => array_key_exists('main', $json['list'][$id]) 
                    && array_key_exists('temp', $json['list'][$id]['main']) 
                    ? $json['list'][$id]['main']['temp'] : NULL,
            'city_id' => $city_id,
            'day' => date('Y-m-d H:i:s', $json['list'][$id]['dt']),
            'created_at' => Carbon::now()->toDateTimeString(),
        );
    }
}
