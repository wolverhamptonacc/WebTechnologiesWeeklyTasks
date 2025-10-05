<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAge
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, int $minAge = 18): Response
    {
        // Example middleware that checks if user meets minimum age requirement
        $userAge = $request->get('age');
        
        if ($userAge && $userAge < $minAge) {
            return response()->json([
                'error' => "You must be at least {$minAge} years old to access this resource."
            ], 403);
        }
        
        // Continue to the next middleware or controller
        return $next($request);
    }
}