<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    protected $queries = [];

    public function getQuery($query = 'default')
    {
        if ($query === 'liked') {
            $userId = auth()->id(); // Get the user ID dynamically
            return Image::join('image_user_likes', 'images.id', '=', 'image_user_likes.image_id')
                ->where('image_user_likes.user_id', $userId)
                ->select('images.*');
        }
        if ($query === 'uploaded') {
            $userId = auth()->id();
            return Image::where('user_id', $userId);
        }

        return Image::query();
    }

    public function index(Request $request)
    {
        $request->session()->put('images_page', 2);
        $images = $this->getMoreImages(1);
        return view('images.index', compact('images'));
    }

    public function uploaded(Request $request) {
        $images = $this->getMoreImages(1, 'uploaded');
        $request->session()->put('my_images_page', 2);
        return view('images.uploaded', compact('images'));
    }

    public function show($id)
    {
        // Fetch the image along with its comments
        $image = Image::with('comments')->findOrFail($id);

        // Pass both image and comments to the view
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

    public function destroy(Image $image) {
        $filePath = $image->file_path;
        Storage::disk('images')->delete($filePath);
        $image->delete();
        return response()->json(['message' => 'Image deleted successfully']);
    }

    public function liked(Request $request)
    {
        $images = $this->getMoreImages(1, 'liked');
        $request->session()->put('liked_images_page', 2);
        return view('images.liked', compact('images'));
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

    public function loadMoreUploaded(Request $request)
    {
        $page = $request->session()->get('my_images_page');
        $imagesData = $this->getMoreImages($page, 'uploaded');

        if ($imagesData['hasMorePages']) {
            $request->session()->put('my_images_page', $page + 1);
        }

        return response()->json($imagesData);
    }

    public function loadMoreLiked(Request $request)
    {
        $page = $request->session()->get('liked_images_page');
        Log::info('Current page:', ['page' => $page]);
        $imagesData = $this->getMoreImages($page, 'liked');

        if ($imagesData['hasMorePages']) {
            $request->session()->put('liked_images_page', $page + 1);
        }

        return response()->json($imagesData);
    }

    private function getMoreImages($page, $query = 'default')
    {
        $queryBuilder = $this->getQuery($query);

        $images = $queryBuilder->paginate(config('image_loading.images_per_load'), ['*'], 'page', $page);
        //dd(config('images.no_images_texts.mine'));
        return [
            'images' => $images->map(function ($image) {
                $imagePath = storage_path('app/public/images/' . $image->file_path);
                $imageSize = getimagesize($imagePath);

                return [
                    'url' => url('storage/images/' . $image->file_path),
                    'width' => $imageSize[0],
                    'height' => $imageSize[1],
                    'id' => $image->id,
                    'liked' => $this->isLiked($image),
                ];
            }),
            'hasMorePages' => $images->hasMorePages(),
            'query' => $query,
            'no_images_text' => config('images.no_images_texts.' .($query)),
        ];
    }

    protected function isLiked(Image $image, $userId = null) {
        if(!$userId) $userId = auth()->id();
        return $image->likedByUsers()->where('user_id', $userId)->exists();
    }

    public function like(Image $image) {
        $userId = auth()->id();
        if ($this->isLiked($image, $userId)) {
            $image->likedByUsers()->detach($userId);
            return response()->json(['liked' => false]);
        }
        $image->likedByUsers()->attach($userId);

        return response()->json(['liked' => true]);
    }
}
