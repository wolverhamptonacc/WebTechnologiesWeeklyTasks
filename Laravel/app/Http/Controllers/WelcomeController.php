<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class WelcomeController extends Controller
{
    /**
     * Display the welcome page
     */
    public function index(): View
    {
        $data = [
            'title' => 'Welcome to Laravel',
            'message' => 'This is a basic Laravel tutorial covering routing, middleware, CSRF, controllers, requests, responses, and views.',
            'features' => [
                'Routing',
                'Middleware',
                'CSRF Protection', 
                'Controllers',
                'Requests',
                'Responses',
                'Views'
            ]
        ];
        
        return view('welcome', $data);
    }
    
    /**
     * Example of returning different response types
     */
    public function jsonResponse(): Response
    {
        return response()->json([
            'message' => 'This is a JSON response',
            'status' => 'success',
            'data' => [
                'framework' => 'Laravel',
                'version' => '11.x'
            ]
        ]);
    }
    
    /**
     * Example of custom response
     */
    public function customResponse(): Response
    {
        return response('Custom response content', 200)
            ->header('Content-Type', 'text/plain')
            ->header('X-Custom-Header', 'Laravel Tutorial');
    }
}