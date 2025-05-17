<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Debugbar;
class CommentController extends Controller
{
    public function store(Request $request, $imageId)
    {
        // Validate the incoming request

        $validated = $request->validate([
            'text' => [
                'required',
                'string',
                'max:4096',
                function ($attribute, $value, $fail) {
                    $lineCount = substr_count($value, "\n") + 1; // Counting lines
                    if ($lineCount > 20) {
                        $fail('The text must have fewer than 20 lines.');
                    }
                },
            ],
        ]);
        // Find the image using the image ID passed in the route
        Image::findOrFail($imageId);

        Comment::create([
            'user_id' => Auth::id(),
            'image_id' => $imageId,
            'text' => $validated['text'],
        ]);

        // Redirect back to the image page with a success message
        return response()->noContent(200);
    }

    public function loadMore(Request $request) {
        $validated = $request->validate([
            'page' => 'required|integer|min:1',
            'image' => 'required|integer|min:1|exists:images,id',
        ]);
        $page = $validated['page'];
        $imageId = $validated['image'];
        $perPage = config('comments.per_page', 10);
        $image = Image::findOrFail($imageId);
        $comments = $image->comments()->with('user')->paginate($perPage);
//        $comments = Comment::where('image_id', $image)
//            ->with('user') // Eager load user relationship
//            ->orderBy('created_at', 'desc') // Typically newest first
//            ->paginate($perPage, ['*'], 'page', $page);

        if ($page > $comments->lastPage()) {
            return response()->json([
                'message' => 'Requested page does not exist',
                'max_page' => $comments->lastPage()
            ], 404);
        }

        return response()->json([
            'data' => $comments->items(),
            'nextPage' => $comments->hasMorePages() ? $page + 1 : 0,
        ]);
    }
}
