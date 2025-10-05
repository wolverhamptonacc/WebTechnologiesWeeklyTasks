<?php
/**
 * Laravel Routing Examples
 * This demonstrates Laravel routing concepts using plain PHP
 */

// Simple routing simulation
$request_uri = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Routing Examples</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 0 auto; padding: 20px; }
        .example { background: #f8f9fa; padding: 1rem; margin: 1rem 0; border-radius: 5px; border-left: 4px solid #007bff; }
        .code { background: #e9ecef; padding: 0.5rem; font-family: monospace; border-radius: 3px; }
        .nav { margin-bottom: 2rem; }
        .nav a { margin-right: 1rem; color: #007bff; text-decoration: none; }
    </style>
</head>
<body>
    <div class="nav">
        <a href="laravel-tutorial.html">← Back to Tutorial</a>
        <a href="controllers.php">Controllers →</a>
    </div>

    <h1>🚦 Laravel Routing Examples</h1>
    
    <div class="example">
        <h3>1. Basic Routes</h3>
        <p>In Laravel, routes are defined in <code>routes/web.php</code></p>
        <div class="code">
Route::get('/', function () {<br>
&nbsp;&nbsp;&nbsp;&nbsp;return view('welcome');<br>
});<br><br>
Route::get('/about', function () {<br>
&nbsp;&nbsp;&nbsp;&nbsp;return 'About Page';<br>
});
        </div>
        <p><strong>Test:</strong> 
            <a href="?route=/">Home</a> | 
            <a href="?route=about">About</a>
        </p>
        <?php if (isset($_GET['route'])): ?>
            <div style="background: #d1ecf1; padding: 10px; border-radius: 3px;">
                <?php 
                switch($_GET['route']) {
                    case '/':
                        echo "Welcome to Laravel!";
                        break;
                    case 'about':
                        echo "About Page Content";
                        break;
                    default:
                        echo "Route not found";
                }
                ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="example">
        <h3>2. Route Parameters</h3>
        <div class="code">
Route::get('/user/{id}', function ($id) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;return 'User ID: ' . $id;<br>
});<br><br>
Route::get('/user/{id}/post/{slug}', function ($id, $slug) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;return "User $id, Post: $slug";<br>
});
        </div>
        <p><strong>Test:</strong> 
            <a href="?user=123">User 123</a> | 
            <a href="?user=456&post=my-first-post">User 456, Post</a>
        </p>
        <?php if (isset($_GET['user'])): ?>
            <div style="background: #d1ecf1; padding: 10px; border-radius: 3px;">
                <?php 
                $user_id = $_GET['user'];
                if (isset($_GET['post'])) {
                    echo "User ID: $user_id, Post: " . $_GET['post'];
                } else {
                    echo "User ID: $user_id";
                }
                ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="example">
        <h3>3. Optional Parameters</h3>
        <div class="code">
Route::get('/posts/{id?}', function ($id = null) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;if ($id) {<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return "Post ID: $id";<br>
&nbsp;&nbsp;&nbsp;&nbsp;}<br>
&nbsp;&nbsp;&nbsp;&nbsp;return "All Posts";<br>
});
        </div>
        <p><strong>Test:</strong> 
            <a href="?posts">All Posts</a> | 
            <a href="?posts=42">Post 42</a>
        </p>
        <?php if (isset($_GET['posts'])): ?>
            <div style="background: #d1ecf1; padding: 10px; border-radius: 3px;">
                <?php 
                $post_id = $_GET['posts'];
                if ($post_id) {
                    echo "Post ID: $post_id";
                } else {
                    echo "Showing all posts";
                }
                ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="example">
        <h3>4. Named Routes</h3>
        <div class="code">
Route::get('/profile', function () {<br>
&nbsp;&nbsp;&nbsp;&nbsp;return 'User Profile';<br>
})->name('profile');<br><br>
// Generate URL: route('profile')<br>
// Redirect: redirect()->route('profile')
        </div>
        <p><strong>Benefit:</strong> If you change the URL, you only update it in one place!</p>
    </div>

    <div class="example">
        <h3>5. Route Groups & Prefixes</h3>
        <div class="code">
Route::prefix('admin')->group(function () {<br>
&nbsp;&nbsp;&nbsp;&nbsp;Route::get('/users', function () {<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return 'Admin Users';<br>
&nbsp;&nbsp;&nbsp;&nbsp;});<br>
&nbsp;&nbsp;&nbsp;&nbsp;Route::get('/posts', function () {<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return 'Admin Posts';<br>
&nbsp;&nbsp;&nbsp;&nbsp;});<br>
});
        </div>
        <p><strong>Result:</strong> Creates routes like <code>/admin/users</code> and <code>/admin/posts</code></p>
    </div>

    <div class="example">
        <h3>6. HTTP Verbs</h3>
        <div class="code">
Route::get('/posts', 'PostController@index');<br>
Route::post('/posts', 'PostController@store');<br>
Route::get('/posts/{id}', 'PostController@show');<br>
Route::put('/posts/{id}', 'PostController@update');<br>
Route::delete('/posts/{id}', 'PostController@destroy');
        </div>
        <p><strong>Or use Resource Routes:</strong></p>
        <div class="code">
Route::resource('posts', PostController::class);
        </div>
        <p>This creates all CRUD routes automatically!</p>
    </div>

    <div style="margin-top: 2rem; padding: 1rem; background: #fff3cd; border-radius: 5px;">
        <h4>🎯 Key Takeaways:</h4>
        <ul>
            <li>Routes define how URLs map to application logic</li>
            <li>Parameters make routes dynamic and flexible</li>
            <li>Named routes make URL generation easier</li>
            <li>Route groups help organize related routes</li>
            <li>Resource routes follow RESTful conventions</li>
        </ul>
    </div>

    <div style="text-align: center; margin-top: 2rem;">
        <a href="controllers.php" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">
            Next: Controllers & Resources →
        </a>
    </div>
</body>
</html>