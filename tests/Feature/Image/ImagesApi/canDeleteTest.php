<?php

use App\Models\Image;
use App\Models\User;

test('owner can delete', function () {
    $owner = User::factory()->create();
    $image = Image::factory()->create(['user_id' => $owner->id]);

    $this->assertDatabaseCount('images', 1);

    $this->actingAs($owner)->delete("/images/{$image->id}/destroy");

    $this->assertDatabaseCount('images', 0);
});

test('should prevent non-owners from deleting', function () {
    $owner = User::factory()->create();
    $nonOwner = User::factory()->create();
    $image = Image::factory()->create([
        'user_id' => $owner->id,
        'title' => 'old bebra',
        'description' => 'smell old bebra',
    ]);

    $this->actingAs($nonOwner)->delete("/images/{$image->id}/destroy");

    $this->assertDatabaseCount('images', 1);
    $this->assertDatabaseHas('images', [
        'user_id' => $owner->id,
        'title' => 'old bebra',
        'description' => 'smell old bebra',
    ]);
});
