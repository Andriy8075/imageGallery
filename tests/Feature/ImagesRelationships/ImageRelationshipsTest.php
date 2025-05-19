<?php

use App\Models\Image;
use App\Models\User;
use App\Models\comment;

test('circular relationships', function () {
    $user1 = User::factory()->create();
    $user2 = User::factory()->create();
    $image = Image::factory()->create(['user_id' => $user1->id]);
    Comment::factory()->create(['image_id' => $image->id, 'user_id' => $user2->id]);
    $user1Images = $user1->uploadedImages;
    $user1FirstImage = $user1Images->first();
    $imageComments = $user1FirstImage->comments;
    $firstComment = $imageComments->first();
    $commentsUser = $firstComment->user();
    expect($commentsUser->is($user2))->toBeTrue();
});

//test('oposite direction', function() {
//    $user1 = User::factory()->create();
//    $user2 = User::factory()->create();
//    $image = ImagesRelationships::factory()->create(['user_id' => $user1->id]);
//    Comment::factory()->create(['image_id' => $image->id, 'user_id' => $user2->id]);
//})
