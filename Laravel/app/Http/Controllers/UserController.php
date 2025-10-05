<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of users
     */
    public function index(Request $request)
    {
        // Example of accessing request data
        $search = $request->get('search', '');
        $page = $request->get('page', 1);
        
        // Mock user data
        $users = [
            ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
            ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
            ['id' => 3, 'name' => 'Bob Johnson', 'email' => 'bob@example.com'],
        ];
        
        // Filter users if search term provided
        if ($search) {
            $users = array_filter($users, function($user) use ($search) {
                return stripos($user['name'], $search) !== false || 
                       stripos($user['email'], $search) !== false;
            });
        }
        
        return view('users.index', compact('users', 'search', 'page'));
    }

    /**
     * Show the form for creating a new user
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8',
        ]);
        
        // In a real app, you'd save to database here
        // User::create($validated);
        
        // Flash message and redirect
        return redirect()->route('users.index')
            ->with('success', 'User created successfully!');
    }

    /**
     * Display the specified user
     */
    public function show(Request $request, string $id)
    {
        // Example of accessing route parameters and request data
        $format = $request->get('format', 'html');
        
        // Mock user data
        $user = [
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'created_at' => '2024-01-01 12:00:00'
        ];
        
        if ($format === 'json') {
            return response()->json($user);
        }
        
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user
     */
    public function edit(string $id)
    {
        // Mock user data
        $user = [
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john@example.com'
        ];
        
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);
        
        // In a real app, you'd update the database here
        // $user = User::findOrFail($id);
        // $user->update($validated);
        
        return redirect()->route('users.show', $id)
            ->with('success', 'User updated successfully!');
    }

    /**
     * Remove the specified user
     */
    public function destroy(string $id): RedirectResponse
    {
        // In a real app, you'd delete from database here
        // User::findOrFail($id)->delete();
        
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully!');
    }
}