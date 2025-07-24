<?php
//use App\Models\Image;
//use Illuminate\Support\Facades\DB;

use App\Models\Image;
use Illuminate\Support\Facades\Route;

Route::get('/traffic', function(){
    echo '<pre>';
    //$query = DB::table('image_user_likes')->where('user_id', 4);
    $query = Image::whereHas('likedByUsers', function($query) {
        $query->where('user_id', 4);
    });
    echo 'wrtgwrg';
    var_dump($query);
    die();
//    $results = $query->paginate(config('images.images_per_load'), ['*'], 'page', $page);
//    echo '<pre>';
//    var_dump($results);
//    echo "etyhrtryh";
//    die();

//    $responseImages = [];
//    foreach($images as $image) {
//        try {
//            $imagePath = storage_path('app/public/images/' . $image->file_path);
//            $imageSize = getimagesize($imagePath);
//            array_push($responseImages, [
//                'url' => url('storage/images/' . $image->file_path),
//                'width' => $imageSize[0],
//                'height' => $imageSize[1],
//                'id' => $image->id,
//                'liked' => $image->liked,
//            ]);
//        }
//        catch (\Throwable $exception) {}
//    }
//
//    return [
//        'images' => $responseImages,
//        'hasMorePages' => $images->hasMorePages(),
//        'query' => $query,
//    ];
});
