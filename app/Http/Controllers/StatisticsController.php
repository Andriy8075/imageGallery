<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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
            'totalLikes' => DB::table('image_user_likes')->count(),
            'totalComments' => Comment::count(),
        ];

        return view('statistics', compact('statistics'));
    }
}
