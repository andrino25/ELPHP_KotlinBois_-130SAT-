<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;

class ImgBBHelper
{
    public static function uploadToImgBB(UploadedFile $image, string $apiKey)
    {
        $response = Http::asForm()->post("https://api.imgbb.com/1/upload", [
            'key' => $apiKey,
            'image' => base64_encode(file_get_contents($image->getPathname())),
        ]);

        if ($response->successful()) {
            return $response->json()['data']['url'];
        }

        return null;
    }
}
