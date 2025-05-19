<?php

use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Str;

test('too long', function() {
    $user = User::factory()->create();
    Image::factory()->create(['user_id' => $user->id]);

    $commentLength = config('comments.max_length') + 1;
    $text = Str::random($commentLength);
    $this->actingAs($user)->post("/comments/1", [
        'text' => $text
    ]);
    $this->assertDatabaseCount('comments', 0);

    $acceptableSizeText = substr($text, 0, strlen($text) - 1);
    $this->actingAs($user)->post("/comments/1", [
        'text' => $acceptableSizeText
    ]);
    $this->assertDatabaseCount('comments', 1);
    $this->assertDatabaseHas('comments', [
        'text' => $acceptableSizeText,
        'user_id' => $user->id,
        'image_id' => $user->image_id,
    ]);
});
