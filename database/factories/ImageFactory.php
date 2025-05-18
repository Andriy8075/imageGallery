<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ImageFactory extends Factory
{
    protected $model = Image::class;
    protected $i = 0;

    public function definition()
    {
        $destinationFolder = storage_path('app/public/images');
        $width = rand(50, 2000);
        $height = rand(50, 2000);

        $imageUrl = "https://picsum.photos/{$width}/{$height}?random=" . rand(1, 100000);
        $fileName = Str::random(40) . '.jpg';
        $newPath = $destinationFolder . '/' . $fileName;


        $response = Http::get($imageUrl);
        File::put($newPath, $response->body());

        $this->i++;

        return [
            'title' => 'Image ' . $this->i,
            'description' => 'Description for image ' . $this->i,
            'user_id' => 12,
            //'user_id' => $this->faker->numberBetween(1, 5),
            'file_path' => $fileName,  // Image path relative to the public folder
        ];
    }

}
