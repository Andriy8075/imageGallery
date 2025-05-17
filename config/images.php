<?php

return [
    'images_per_load' => 20,
    'image_max_width' => 300, // in px
    'scroll_threshold' => 500, //in px
    'load_urls' => [
        'default' => '/images/load-more',
        'uploaded' => '/images/load-more-uploaded',
        'liked' => '/images/load-more-liked',
        'comments' => '/comments/load-more',
    ],
    'no_images_texts' => [
        'default' => 'No images suitable for your search',
        'uploaded' => 'You haven\'t uploaded any images yet',
        'liked' => 'You haven\'t liked any images yet',
    ],
];

