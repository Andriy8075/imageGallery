<?php

namespace App\Http\Controllers;

use App\Models\comment;
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

        return Image::query()->withExists(['likedByUsers as is_liked' => function ($query) {
            $query->where('user_id', auth()->id());
        }]);
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

    public function show(Request $request, $id)
    {
        // Fetch the image
        $image = Image::findOrFail($id);

        // Paginate the comments
        $comments = $image->comments()->paginate(10);
        $request->session()->put('comments_page', 2);

        // Pass both image and paginated comments to the view
        return view('images.show', compact('image', 'comments'));
    }

    public function loadMoreComments(Request $request) {
        $page = $request->session()->get('comments_page');
        $comments = Comment::paginate($page);

        if ($comments->hasMorePages()) {
            $request->session()->put('comments_page', $page + 1);
        }

        return response()->json($comments);
    }

    public function create() {
        return view('images.create');
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'max:128|string|nullable',
            'description' => [
                'max:4096',
                'string',
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) { // Ensure value is not null
                        $lineCount = substr_count($value, "\n") + 1; // Counting lines
                        if ($lineCount > 20) {
                            $fail('The description must have fewer than 20 lines.');
                        }
                    }
                },
            ],
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
            'description' => [
                'max:4096',
                'string',
                'nullable',
                function ($attribute, $value, $fail) {
                    if (!empty($value)) { // Ensure value is not null
                        $lineCount = substr_count($value, "\n") + 1; // Counting lines
                        if ($lineCount > 20) {
                            $fail('The description must have fewer than 20 lines.');
                        }
                    }
                },
            ],
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

    public function loadMoreAny(Request $request)
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
        return [
            'images' => $images->map(function ($image) {
                $imagePath = storage_path('app/public/images/' . $image->file_path);
                $imageSize = getimagesize($imagePath);

                return [
                    'url' => url('storage/images/' . $image->file_path),
                    'width' => $imageSize[0],
                    'height' => $imageSize[1],
                    'id' => $image->id,
                    'is_liked' => $image->isLiked,
                ];
            }),
            'hasMorePages' => $images->hasMorePages(),
            'query' => $query,
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
