<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        $request->session()->put('image_page', 2);
        $images = $this->getMoreImages(1);
        return view('images.index', compact('images'));
    }

    public function loadMore(Request $request)
    {
        $page = $request->session()->get('image_page', 2);
        $imagesData = $this->getMoreImages($page);

        if ($imagesData['hasMorePages']) {
            $request->session()->put('image_page', $page + 1);
        }

        return response()->json($imagesData);
    }

    private function getMoreImages($page)
    {
        $images = Image::paginate(config('image_loading.images_per_load'), ['*'], 'page', $page);

        return [
            'images' => $images->map(function ($image) {
                $imagePath = storage_path('app/public/' . $image->file_path);
                $imageSize = getimagesize($imagePath);

                return [
                    'url' => asset('storage/' . $image->file_path),
                    'width' => $imageSize[0],
                    'height' => $imageSize[1],
                ];
            }),
            'hasMorePages' => $images->hasMorePages(),
        ];
    }
}
