<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureCommentOwner
{
    public function handle(Request $request, Closure $next)
    {
        $comment = $request->route('comment');

        // Check if the authenticated user is the owner of the image
        if ($comment->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to edit/delete this comment.');
        }

        return $next($request);
    }
}
