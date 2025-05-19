<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('unauthenticated can not access create page', function () {
    $response = $this->get('/images/create');
    $response->assertRedirect('/login');
});

test('authenticated can access create page', function () {
    Storage::fake('testing'); // Fake the storage for testing
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/images/create');
    $response->assertStatus(200);
});

test('unauthenticated can not create images', function () {
    $file = UploadedFile::fake()->image('image.jpg',200, 100);
    $this->post('/images/create', [
        "title" => "bebra",
        "description" => "smell bebra",
        "image" => $file,
    ]);

    $this->assertDatabaseCount('images', 0);
});

test('authenticated can create images', function () {
    $user = User::factory()->create();
    $file = UploadedFile::fake()->image('image.jpg',200, 100);
    $this->actingAs($user)->post('/images/create', [
        "title" => "bebra",
        "description" => "smell bebra",
        "image" => $file,
    ]);
    $this->assertDatabaseCount('images', 1);
});
