<?php

use App\Models\User;;

test('unauthenticated can not access create page', function () {
    $response = $this->get('/images/create');
    $response->assertStatus(302);
});

test('authenticated can access create page', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/images/create');
    $response->assertStatus(200);
});

//test('unauthenticated can not create images', function () {
//    $response = $this->post('/images/', [
//        "title" => "bebra",
//        "description" => "smell bebra",
//    ]);
//});

//test('authenticated can create images', function () {
//    $user = User::factory()->create();
//    $response = $this->actingAs($user)->post('/images/store', [
//        "title" => "bebra",
//        "description" => "smell bebra",
//
//    ]);
//});
