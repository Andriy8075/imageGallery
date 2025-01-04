<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;
use Illuminate\Support\Facades\File;

class ImageSeeder extends Seeder
{
    public function run()
    {
        $count = 500;

        $destinationFolder = storage_path('app/public/images');

        if (!File::isDirectory($destinationFolder)) {
            File::makeDirectory($destinationFolder, 0755, true);  // Make directory with proper permissions (0755)
        }

        // Use factory to create images with titles, descriptions, and downloaded images
        Image::factory()->count($count)->create();

        $this->command->info("Downloaded and created $count random images.");
    }
}

