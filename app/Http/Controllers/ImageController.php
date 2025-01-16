<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        $query = ['user_id', '!=', Auth::id()];
        $request->session()->put('images_page', 2);
        $images = $this->getMoreImages(1, $query, false);
        return view('images.index', compact('images'));
    }

    public function myImages(Request $request) {
        $query = ['user_id', '=', Auth::id()];
        $images = $this->getMoreImages(1, $query, true);
        $request->session()->put('my_images_page', 2);
        return view('my-images', compact('images'));
    }

    public function show($id) {
        $image = Image::findOrFail($id);
        return view('images.show', compact('image'));
    }

    public function create() {
        return view('images.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'max:128|string|nullable',
            'description' => 'max:4096|string|nullable',
            'image' => 'image|max:16384|required',
        ]);

        $file_path = Storage::disk('images')->putFile('/', $request->file('image'));

        Image::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $file_path,
        ]);

        session()->flash('success');

        return redirect()->route('images.create');
    }

    public function edit(Image $image) {
        return view('images.edit', compact('image'));
    }

    public function update(Request $request, Image $image)
    {
        // Validate only the title and description
        $request->validate([
            'title' => 'max:128|string|nullable',
            'description' => 'max:4096|string|nullable',
        ]);

        // Update the image's title and description
        $image->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        // Redirect to a relevant page (e.g., back to the edit page or index)
        return redirect()->route('images.show', $image);
    }

    public function loadMore(Request $request)
    {
        $page = $request->session()->get('images_page');
        $imagesData = $this->getMoreImages($page);

        if ($imagesData['hasMorePages']) {
            $request->session()->put('images_page', $page + 1);
        }

        return response()->json($imagesData);
    }

    public function loadMoreMine(Request $request)
    {
        $page = $request->session()->get('my_images_page');
        $query = ['user_id', '=', Auth::id()];
        $imagesData = $this->getMoreImages($page, $query);

        if ($imagesData['hasMorePages']) {
            $request->session()->put('my_images_page', $page + 1);
        }

        return response()->json($imagesData);
    }

    private function getMoreImages($page, $query = null, $mine = false)
    {
        $queryBuilder = Image::query();

        if ($query) {
            $queryBuilder->where(...$query);
        }

        $images = $queryBuilder->paginate(config('image_loading.images_per_load'), ['*'], 'page', $page);

        return [
            'images' => $images->map(function ($image) {
                $imagePath = storage_path('app/public/images/' . $image->file_path);
                $imageSize = getimagesize($imagePath);

                return [
                    'url' => url('storage/images/' . $image->file_path),
                    'width' => $imageSize[0],
                    'height' => $imageSize[1],
                    'id' => $image->id,
                ];
            }),
            'hasMorePages' => $images->hasMorePages(),
            'mine' => $mine,
        ];
    }

}
