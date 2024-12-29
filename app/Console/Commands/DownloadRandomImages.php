<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class DownloadRandomImages extends Command
{
    protected $signature = 'images:download-random {count=10}';
    protected $description = 'Download random images with different sizes and store them in the public folder and database';

    public function handle()
    {
        $count = $this->argument('count');  // Default to 10 if not specified
        $destinationFolder = storage_path('app/public/images');

        // Ensure the destination folder exists
        if (!File::isDirectory($destinationFolder)) {
            File::makeDirectory($destinationFolder, 0755, true);
        }

        $this->info("Downloading $count random images from Lorem Picsum...");

        for ($i = 0; $i < $count; $i++) {
            try {
                // Generate random width and height for the image
                $width = rand(50, 2000);  // Random width between 300px and 800px
                $height = rand(50, 2000); // Random height between 300px and 800px

                // Fetch a random image from Lorem Picsum with the generated width and height
                $imageUrl = "https://picsum.photos/{$width}/{$height}?random=" . rand(1, 1000);  // Random image size
                $fileName = 'image_' . $i . '.jpg';  // Generate a unique name for the image
                $newPath = $destinationFolder . '/' . $fileName;

                // Download the image
                $response = Http::get($imageUrl);

                if ($response->successful()) {
                    // Save the image to the public folder
                    File::put($newPath, $response->body());

                    // Insert the image path into the database
                    DB::table('images')->insert([
                        'file_path' => 'images/' . $fileName,  // Relative path to public folder
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $this->info("Downloaded image: $fileName");
                } else {
                    $this->error("Failed to download image from $imageUrl. Status code: " . $response->status());
                }
            } catch (\Exception $e) {
                $this->error("Error downloading image $i: " . $e->getMessage());
            }
        }

        $this->info("Downloaded $count random images!");
        return 0;
    }
}
