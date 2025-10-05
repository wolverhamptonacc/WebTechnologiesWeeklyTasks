<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Basic Route Examples
Route::get('/', function () {
    return view('welcome');
});

// Route with Parameter
Route::get('/user/{id}', function ($id) {
    return "User ID: " . $id;
});

// Route with Optional Parameter
Route::get('/user/{id?}', function ($id = null) {
    return $id ? "User ID: " . $id : "No user ID provided";
});

// Named Routes
Route::get('/profile', function () {
    return "User Profile";
})->name('profile');

// Route Groups with Middleware
Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    
    Route::get('/settings', function () {
        return view('settings');
    });
});

// Route with Multiple HTTP Methods
Route::match(['get', 'post'], '/contact', function () {
    return 'Contact form';
});

// Route::any for all HTTP methods
Route::any('/any-method', function () {
    return 'Accepts any HTTP method';
});

// Controller Routes
Route::get('/welcome', [WelcomeController::class, 'index']);
Route::get('/welcome/json-response', [WelcomeController::class, 'jsonResponse']);
Route::get('/welcome/custom-response', [WelcomeController::class, 'customResponse']);
Route::resource('users', UserController::class);

// Route with Middleware Applied
Route::get('/admin', function () {
    return 'Admin Panel';
})->middleware('auth', 'admin');

// Route with CSRF Protection (for forms)
Route::post('/submit-form', function () {
    return 'Form submitted successfully';
})->name('submit.form');

// Redirect Routes
Route::redirect('/old-page', '/new-page', 301);

// View Routes (directly return a view)
Route::view('/about', 'about', ['name' => 'Laravel Tutorial']);