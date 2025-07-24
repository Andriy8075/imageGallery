<?php

return [
    "images" => [
        "url" => function($width, $height) {
            return "https://picsum.photos/{$width}/{$height}?random=" . rand(1, 100000);
        },
    ],
];
