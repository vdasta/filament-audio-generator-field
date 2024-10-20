<?php

namespace Michaeld555\AudioGeneratorField\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadAudioFromUrl
{
    public function downloadToDisk(string $url, string $disk, string $extension = 'ogg'): string
    {
        $response = Http::get($url);

        $filename = Str::uuid()->toString() . '.' . $extension;

        Storage::disk($disk)->put($filename, $response->body());

        return $filename;
    }

    public function saveToDisk(string $responseBody, string $disk, string $extension = 'ogg'): string
    {
        $filename = Str::uuid()->toString() . '.' . $extension;

        Storage::disk($disk)->put($filename, $responseBody);

        return $filename;
    }
    
}
