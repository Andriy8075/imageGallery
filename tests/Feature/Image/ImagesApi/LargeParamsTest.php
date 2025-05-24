<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    // This runs before each test
    Storage::fake('public'); // Use fake storage for all tests
});

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

test('large title', function() {
    $user = User::factory()->create();
    $width = 100;
    $height = getHeight($width);

    $image = UploadedFile::fake()->image('image.jpg', $width, $height);

    $titleLength = config('images.max_title_length') + 1;
    $text = Str::random($titleLength);

    $this->actingAs($user)->post('/images/create', [
        "title" => $text,
        "description" => "smell bebra",
        "image" => $image,
    ]);

    $this->assertDatabaseCount('images', 0);

    $acceptableSizeText = substr($text, 0, strlen($text) - 1);

    $this->actingAs($user)->post('/images/create', [
        "title" => $acceptableSizeText,
        "description" => "smell bebra",
        "image" => $image,
    ]);
    $this->assertDatabaseCount('images', 1);
    $this->assertDatabaseHas('images', [
        'user_id' => $user->id,
        'title' => $acceptableSizeText,
        'description' => 'smell bebra',
    ]);
});

test('large description', function() {
    $user = User::factory()->create();
    $width = 100;
    $height = getHeight($width);

    $image = UploadedFile::fake()->image('image.jpg', $width, $height);

    $descriptionLength = config('images.max_description_length') + 1;
    $text = Str::random($descriptionLength);

    $this->actingAs($user)->post('/images/create', [
        "title" => "bebra",
        "description" => $text,
        "image" => $image,
    ]);

    $this->assertDatabaseCount('images', 0);

    $acceptableSizeText = substr($text, 0, strlen($text) - 1);

    $this->actingAs($user)->post('/images/create', [
        "title" => "bebra",
        "description" => $acceptableSizeText,
        "image" => $image,
    ]);
    $this->assertDatabaseCount('images', 1);
    $this->assertDatabaseHas('images', [
        'user_id' => $user->id,
        'title' => 'bebra',
        'description' => $acceptableSizeText,
    ]);
});
