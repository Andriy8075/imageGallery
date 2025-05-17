<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
class ImageController extends Controller
{
    protected $queries = [];

    public function getQuery($query = 'default', $params = [])
    {
        if ($query === 'liked') {
            $userId = auth()->id(); // Get the user ID dynamically
            return Image::whereHas('likedByUsers', function($query) use ($userId) {
                $query->where('user_id', $userId);
            });
        }
        if ($query === 'uploaded') {
            $userId = auth()->id();
            return Image::where('user_id', $userId);
        }
        if ($query === 'search') {
            return Image::where('title', 'like', '%' . $params["userQuery"] . '%')
                ->orWhere('description', 'like', '%' . $params["userQuery"] . '%');
        }

        return Image::query()->withExists(['likedByUsers as liked' => function ($query) {
            $query->where('user_id', auth()->id());
        }]);
    }

    public function index(Request $request)
    {
        $images = $this->getMoreImages(1);
        return view('images.index', compact('images'));
    }

    public function uploaded(Request $request) {
        $images = $this->getMoreImages(1, 'uploaded');
        return view('images.uploaded', compact('images'));
    }

    public function show(Request $request, $id)
    {
        // Fetch the image
        $image = Image::findOrFail($id);

        // Paginate the comments
        $comments = $image->comments()->with('user')->paginate(10);
        $nextPage = $comments->hasMorePages() ? 2 : 0;
        $request->session()->put('comments_page', 2);
        $imageId = $id;

        // Pass both image and paginated comments to the view
        return view('images.show', compact('image', 'comments', 'nextPage', 'imageId'));
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
        return view('images.liked', compact('images'));
    }

    public function loadMoreAny(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|integer|min:1'
        ]);
        $page = $validated['page'];
        $imagesData = $this->getMoreImages($page);

        $imagesData['nextPage'] = $imagesData['hasMorePages'] ? $page+1 : 0;
        return response()->json($imagesData);
    }

    public function loadMoreUploaded(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|integer|min:1'
        ]);
        $page = $validated['page'];
        $imagesData = $this->getMoreImages($page, 'uploaded');
        $imagesData['nextPage'] = $imagesData['hasMorePages'] ? $page+1 : 0;
        return response()->json($imagesData);
    }

    public function loadMoreLiked(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|integer|min:1'
        ]);
        $page = $validated['page'];
        $imagesData = $this->getMoreImages($page, 'liked');

        $imagesData['nextPage'] = $imagesData['hasMorePages'] ? $page+1 : 0;
        return response()->json($imagesData);
    }

    public function loadMoreSearch(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|integer|min:1'
        ]);
        $input = $request->input('search');
        $page = $validated['page'];
        $imagesData = $this->getMoreImages($page, 'search', ["userQuery" => $input]);

        $imagesData['nextPage'] = $imagesData['hasMorePages'] ? $page+1 : 0;
        return response()->json($imagesData);
    }

    private function getMoreImages($page, $query = 'default', $paramsForQuery = [])
    {
        $queryBuilder = $this->getQuery($query, $paramsForQuery);

        $images = $queryBuilder->paginate(config('image_loading.images_per_load'), ['*'], 'page', $page);
        if ($query === 'liked') {
            $images->map(function ($image) {
                $image->liked = true;
                return $image;
            });
        }
        return [
            'images' => $images->map(function ($image) {
                $imagePath = storage_path('app/public/images/' . $image->file_path);
                $imageSize = getimagesize($imagePath);
                return [
                    'url' => url('storage/images/' . $image->file_path),
                    'width' => $imageSize[0],
                    'height' => $imageSize[1],
                    'id' => $image->id,
                    'liked' => $image->liked,
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
    public function search(Request $request)
    {
        $input = $request->input('search');
        $images = $this->getMoreImages(1, 'search', ["userQuery" => $input]);
        return view('images.search', compact('images'));
    }
}
