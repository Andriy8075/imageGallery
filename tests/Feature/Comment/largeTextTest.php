<?php

use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

beforeEach(function () {
    // This runs before each test
    Storage::fake('public'); // Use fake storage for all tests
});

test('too long', function() {
    $user = User::factory()->create();
    $image = Image::factory()->create(['user_id' => $user->id]);

    $commentLength = config('comments.max_length') + 1;
    $text = Str::random($commentLength);
    $this->actingAs($user)->post("/comments/{$image->id}", [
        'text' => $text
    ]);
    $this->assertDatabaseCount('comments', 0);

    $acceptableSizeText = substr($text, 0, strlen($text) - 1);
    $response = $this->actingAs($user)->post("/comments/{$image->id}", [
        'text' => $acceptableSizeText
    ]);

    $response->assertStatus(200); // Add this check
    $this->assertDatabaseCount('comments', 1);
    $this->assertDatabaseHas('comments', [
        'text' => $acceptableSizeText,
        'user_id' => $user->id,
        'image_id' => $image->id, // Use the image reference
    ]);
});
