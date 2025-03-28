<?php

namespace Michaeld555\AudioGeneratorField\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DownloadAudioFromUrl
{
    public function saveToDisk(string $responseBody, string $disk, ?string $directory = null, string $extension = 'mp3'): string
    {
        $filename = Str::uuid()->toString() . '.' . $extension;
        $path = $directory ? ($directory . '/' . $filename) : $filename;

        Storage::disk($disk)->put($path, $responseBody);

        return $path;
    }
}
