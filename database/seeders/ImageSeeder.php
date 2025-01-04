<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class ImageSeeder extends Seeder
{
    public function run()
    {
        $count = 500;
        Artisan::call('images:download-random', [
            'count' => $count,
        ]);

        $this->command->info("Downloaded $count random images via command.");
    }
}

