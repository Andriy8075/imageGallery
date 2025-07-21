<?php

namespace Database\Seeders;

use App\Models\ImageUserLike;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ImageUserLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = 205;

        // Use factory to create images with titles, descriptions, and downloaded images
        ImageUserLike::factory()->count($count)->create();

        $this->command->info("Downloaded and created $count random images.");
    }
}
