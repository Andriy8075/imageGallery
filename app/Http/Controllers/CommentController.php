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
        $validated = $request->validate([
            'text' => [
                'required',
                'string',
                'max:' . config('comments.max_length'),
                function ($attribute, $value, $fail) {
                    $lineCount = substr_count($value, "\n") + 1; // Counting lines
                    if ($lineCount > 20) {
                        $fail('The text must have fewer than 20 lines.');
                    }
                },
            ],
        ]);
        Image::findOrFail($imageId);
        if(!auth()->check()) return redirect()->route('login');
        Comment::create([
            'user_id' => Auth::id(),
            'image_id' => $imageId,
            'text' => $validated['text'],
        ]);

        return response()->noContent(200);
    }

    public function update(Request $request, $commentId) {
        $validated = $request->validate([
            'text' => [
                'required',
                'string',
                'max:' . config('comments.max_length'),
                function ($attribute, $value, $fail) {
                    $lineCount = substr_count($value, "\n") + 1; // Counting lines
                    if ($lineCount > 20) {
                        $fail('The text must have fewer than 20 lines.');
                    }
                },
            ],
        ]);
        Comment::findOrFail($commentId);
        if(!auth()->check()) return redirect()->route('login');
        if(Auth::id() !== $comment->user_id) abort(403);
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
