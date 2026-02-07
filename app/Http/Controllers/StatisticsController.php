<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\View\View;

class StatisticsController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        $statistics = [
            'totalImages' => Image::count(),
            'totalUsers' => User::count(),
            'totalLikes' => Like::count(),
            'totalComments' => Comment::count(),
        ];

        return view('statistics', compact('statistics'));
    }
}
