<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Log the incoming request (before)
        \Log::info('Incoming request: ' . $request->method() . ' ' . $request->fullUrl());
        
        // Process the request
        $response = $next($request);
        
        // Log the response (after)
        \Log::info('Response status: ' . $response->getStatusCode());
        
        return $response;
    }
}