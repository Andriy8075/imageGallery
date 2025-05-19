<?php

use App\Models\User;
use App\Models\Image;

test('authenticated can comment', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $image = Image::factory()->create(['user_id' => $user1->id]);

    //can comment own image
    $response1 = $this->actingAs($user1)->post("/comments/{$image->id}", ['text' => 'bebra1']);
    $response1->assertStatus(200);

    //can comment another user's image
    $response2 = $this->actingAs($user2)->post("/comments/{$image->id}", ['text' => 'bebra2']);
    $response2->assertStatus(200);

    $this->assertDatabaseHas('comments', ['text' => 'bebra1']);
    $this->assertDatabaseHas('comments', ['text' => 'bebra2']);
});

test('unauthenticated can not comment', function () {
    $user = User::factory()->create();
    $image = Image::factory()->create(['user_id' => $user->id]);

    //can comment own image
    $this->post("/comments/{$image->id}", ['text' => 'bebra1']);
    $this->assertDatabaseCount('comments', 0);
});
