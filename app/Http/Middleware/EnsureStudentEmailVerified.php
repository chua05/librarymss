<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureStudentEmailVerified
{
    public function handle(Request $request, Closure $next): Response
    {
        // Only block student users (role = user). Admins/staff can still use the app regardless.
        if (auth()->check()) {
            $user = $request->user();

            if ($user && $user->role === 'user' && ! $user->hasVerifiedEmail()) {
                return redirect()->route('verification.notice');
            }
        }

        return $next($request);
    }
}

