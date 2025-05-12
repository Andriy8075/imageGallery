<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
