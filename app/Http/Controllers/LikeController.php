<?php

namespace App\Http\Controllers;
use App\Models\Image;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __invoke(Request $request, $imageId)
    {
        $user = auth()->user();
        $image = Image::findOrFail($imageId);

        if (!$user->likedImages()->where('image_id', $image->id)->exists()) {
            $user->likedImages()->attach($image);
            return response()->json(['message' => 'Image liked successfully']);
        }
        else {
            $user->likedImages()->detach($image);
            return response()->json(['message' => 'Image unliked successfully']);
        }
    }
}
