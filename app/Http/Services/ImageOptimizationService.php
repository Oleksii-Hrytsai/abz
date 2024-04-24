<?php

namespace App\Http\Services;

use Tinify\Source;
use Tinify\Tinify;

class ImageOptimizationService
{
    public function optimizeImage($imagePath)
    {
        $apiKey = env('TINIFY_API_KEY');
        Tinify::setKey($apiKey);

        try {
            $source = Source::fromFile($imagePath);
            $resized = $source->resize([
                "method" => "fit",
                "width" => 70,
                "height" => 70
            ]);
            $resized->toFile("optimized.jpg");
        } catch (\Exception $e) {
            throw new \Exception('Помилка оптимізації зображення: ' . $e->getMessage(), 500);
        }
    }
}
