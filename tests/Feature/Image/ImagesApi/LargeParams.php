<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;

test('too large image size', function() {
    $user = User::factory()->create();
    $width = 1000;
    $height = getHeight($width);
    $image = UploadedFile::fake()
        ->image('oversized.jpg', $width, $height) // Reasonable dimensions
        ->size(config('images.max_size') + 1024); // Force exceed limit
    $this->actingAs($user)->post('/images/create', [
        "title" => "bebra",
        "description" => "smell bebra",
        "image" => $image,
    ]);

    $this->assertDatabaseCount('images', 0);
});

//test('large title', function() {
//    $user = User::factory()->create();
//    $width = 1000;
//    $height = getHeight($width);
//
//
//});
