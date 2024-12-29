<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    public function run()
    {
        for ($i = 1; $i <= 10000; $i++) {
            Image::create([
                'url' => "https://via.placeholder.com/200?text=Image+$i"
            ]);
        }
    }
}

