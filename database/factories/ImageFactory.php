<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;

class ImageFactory extends Factory
{
    protected $model = Image::class;
    protected $i = 0;

    public function definition()
    {
        $destinationFolder = storage_path('app/public/images');
        $width = rand(50, 2000);
        $height = rand(50, 2000);

        $imageUrl = "https://picsum.photos/{$width}/{$height}?random=" . rand(1, 1000);
        $fileName = 'image_' . $this->i . '.jpg';
        $newPath = $destinationFolder . '/' . $fileName;


        $response = Http::get($imageUrl);
        File::put($newPath, $response->body());

        DB::table('images')->insert([
            'title' => 'Image ' . $this->i,
            'description' => 'Description for image ' . $this->i,
            'file_path' => 'images/' . $fileName,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->i++;

        return [
            'title' => 'Image ' . $this->i,
            'description' => 'Description for image ' . $this->i,
            'file_path' => 'images/' . $fileName,  // Image path relative to the public folder
        ];
    }

}
