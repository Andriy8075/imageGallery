<?php

use App\Models\Image;
use App\Models\User;

test('owner can edit', function () {
    $owner = User::factory()->create();
    $image = Image::factory()->create(['user_id' => $owner->id]);

    $this->actingAs($owner)->patch("/images/{$image->id}/update", [
        "title" => "new bebra",
        "description" => "smell new bebra",
        "image" => $image,
    ]);

    $this->assertDatabaseCount('images', 1);
    $this->assertDatabaseHas('images', [
        'user_id' => $owner->id,
        'title' => 'new bebra',
        'description' => 'smell new bebra',
    ]);
});

test('should prevent non-owners from editing', function () {
    $owner = User::factory()->create();
    $nonOwner = User::factory()->create();
    $image = Image::factory()->create([
        'user_id' => $owner->id,
        'title' => 'old bebra',
        'description' => 'smell old bebra',
    ]);

    $this->actingAs($nonOwner)->patch("/images/{$image->id}/update", [
        "title" => "new bebra",
        "description" => "smell new bebra",
        "image" => $image,
    ]);

    $this->assertDatabaseCount('images', 1);
    $this->assertDatabaseHas('images', [
        'user_id' => $owner->id,
        'title' => 'old bebra',
        'description' => 'smell old bebra',
    ]);
});
