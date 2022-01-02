<?php

namespace App\Helpers;

use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class SocialMediaHelper {
    
    static function generate_image($name, $blade, $data, $id = false) {

        $file_name = $name;
        if($id) {
            $file_name = $name . '-' . $id;
        }

        $html = View::make($blade, ['data' => $data])->render();
        Browsershot::html($html)
            // ->setNodeBinary('/root/.nvm/versions/node/v14.7.0/bin/node')
            // ->setNpmBinary('/root/.nvm/versions/node/v14.7.0/bin/npm')
            ->setScreenshotType('jpeg', 100)
            ->windowSize(1200, 630)
            ->save(Storage::disk('local')->path('public/social/' . $file_name . '.jpg'));
    }
}

