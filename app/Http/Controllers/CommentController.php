<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CommentController extends Controller
{
    protected function validateComment(Request $request): array
    {
        return $request->validate([
            'text' => [
                'required',
                'string',
                'max:' . config('comments.max_length'),
                function ($attribute, $value, $fail) {
                    $lineCount = substr_count($value, "\n") + 1;
                    if ($lineCount > 20) {
                        $fail('The text must have fewer than 20 lines.');
                    }
                },
            ],
        ]);
    }
    public function store(Request $request, $imageId)
    {
        $validated = $this->validateComment($request);
        Image::findOrFail($imageId);
        Comment::create([
            'user_id' => Auth::id(),
            'image_id' => $imageId,
            'text' => $validated['text'],
        ]);

        return response()->noContent(200);
    }

    public function update(Request $request, Comment $comment) {
        $validated = $this->validateComment($request);
        $comment->update([
            'text' => $validated['text'],
        ]);

        return response()->noContent(200);
    }

    public function destroy(Comment $comment) {
        $comment->destroy($comment->id);
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
