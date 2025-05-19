<?php

use App\Models\Image;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('unauthenticated can not access create page', function () {
    $response = $this->get('/images/create');
    $response->assertRedirect('/login');
});

test('authenticated can access create page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/images/create');
    $response->assertStatus(200);
});

function getHeight(int $width)
{
    $width_to_height = config('images.max_width_to_height');
    $height_to_width = config('images.max_height_to_width');

    $height_range = [1/$width_to_height, $height_to_width];
    $middle_of_height_range = ($height_range[0] + $height_range[1]) / 2;
    $height = (int)($middle_of_height_range * $width);

    return $height;
}

test('unauthenticated can not create images', function () {
    $width = 100;
    $height = getHeight($width);

    $image = UploadedFile::fake()->image('image.jpg',$width, $height);
    $response = $this->post('/images/create', [
        "title" => "bebra",
        "description" => "smell bebra",
        "image" => $image,
    ]);

    $response->assertRedirect('/login');
    $this->assertDatabaseCount('images', 0);
});

test('authenticated can create images', function () {
    $user = User::factory()->create();
    $width = 100;
    $height = getHeight($width);

    $image = UploadedFile::fake()->image('image.jpg', $width, $height);
    $this->actingAs($user)->post('/images/create', [
        "title" => "bebra",
        "description" => "smell bebra",
        "image" => $image,
    ]);

    $this->assertDatabaseCount('images', 1);
    $this->assertDatabaseHas('images', [
        'user_id' => $user->id,
        'title' => 'bebra',
        'description' => 'smell bebra',
    ]);

    $createdImage = Image::first();

    Storage::disk('images')->assertExists($createdImage->file_path);

    $manager = new ImageManager(new Driver());
    $storedImage = $manager->read(Storage::disk('images')->path($createdImage->file_path));

    expect($storedImage->width())->toBe($width)
        ->and($storedImage->height())->toBe($height);
});
