<?php

return [
    'max_height_to_width' => 3, //how many max times height of images can exceed width
    'max_width_to_height' => 3, //how many max times width of images can exceed height
    'max_size' => '16384',
    'images_per_load' => 20,
    'column_max_width' => 300, // in px
    'scroll_threshold' => 500, //in px
    'load_urls' => [
        'default' => '/images/load-more',
        'uploaded' => '/images/load-more-uploaded',
        'liked' => '/images/load-more-liked',
        'comments' => '/comments/load-more',
        'search' => '/images/load-more-search',
    ],
    'no_images_texts' => [
        'default' => 'No images suitable for your search',
        'uploaded' => 'You haven\'t uploaded any images yet',
        'liked' => 'You haven\'t liked any images yet',
    ],
];

