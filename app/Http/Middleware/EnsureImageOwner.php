<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureImageOwner
{
    public function handle(Request $request, Closure $next)
    {
        $image = $request->route('image');

        // Check if the authenticated user is the owner of the image
        if ($image->user_id !== auth()->id()) {
            abort(403, 'You are not authorized to access this resource.');
        }

        return $next($request);
    }
}
