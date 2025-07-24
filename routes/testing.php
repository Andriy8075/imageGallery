<?php
//use App\Models\Image;
//use Illuminate\Support\Facades\DB;

use App\Models\Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/traffic', function(){
    echo '<pre>';
    //$query1 = DB::table('image_user_likes')->where('image_user_likes.user_id', '=', 4)->
    //    join('images', 'image_user_likes.image_id', '=', 'images.id')->toSql();
    $query2 = Image::whereHas('likedByUsers', function($query) {
        $query->where('user_id', 4);
    })->toSql();
    echo 'wrtgwrg';
    var_dump($query2);
    die();
    $results = $query2->paginate(config('images.images_per_load'), ['*'], 'page', 1);
    echo '<pre>';
    var_dump($results);
    echo "etyhrtryh";
    die();

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

Route::get('/test2', function(){
    echo '<pre>';
    // Original array with a nested array
    $originalArray = ['name' => 'John', 'details' => ['age' => ['var' => ['bebra' => 25]]]];
    // Shallow copy using the spread operator (PHP 7.4+)
    $shallowCopy = $originalArray;
    // Modify the nested array in the copied structure
    $shallowCopy['details']['age']['var']['bebra'] = 30;
    // Changes reflect in the original array as well
    var_dump($originalArray); // ['name' => 'John', 'details' => ['age' => 30]]
    var_dump($shallowCopy);
    //echo $originalArray['details']['age'] === $shallowCopy['details']['age'];
});
