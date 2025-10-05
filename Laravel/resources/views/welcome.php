<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Laravel Tutorial' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Laravel Tutorial</a>
            <div class="navbar-nav">
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link" href="/users">Users</a>
                <a class="nav-link" href="/about">About</a>
                <a class="nav-link" href="/json-example">JSON Example</a>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <h1 class="display-4"><?= htmlspecialchars($title) ?></h1>
                    <p class="lead"><?= htmlspecialchars($message) ?></p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Laravel Concepts Demonstrated</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-group list-group-flush">
                                    <?php foreach ($features as $feature): ?>
                                        <li class="list-group-item">✅ <?= htmlspecialchars($feature) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Try These Examples</h3>
                            </div>
                            <div class="card-body">
                                <div class="d-grid gap-2">
                                    <a href="/users" class="btn btn-primary">View Users (Resource Controller)</a>
                                    <a href="/user/123" class="btn btn-outline-primary">Route with Parameter</a>
                                    <a href="/users/1?format=json" class="btn btn-outline-success">JSON Response</a>
                                    <a href="/about" class="btn btn-outline-info">About Page (View with Data)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="alert alert-info">
                        <h4>CSRF Protection Example</h4>
                        <p>Current CSRF Token: <code><?= csrf_token() ?></code></p>
                        <p>This token would be automatically included in Laravel forms using the <code>@csrf</code> directive.</p>
                    </div>
                </div>

                <div class="mt-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Routing Examples in Action</h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Route</th>
                                        <th>Description</th>
                                        <th>Laravel Syntax</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="/">/</a></td>
                                        <td>Basic route</td>
                                        <td><code>Route::get('/', function() { ... });</code></td>
                                    </tr>
                                    <tr>
                                        <td><a href="/user/123">/user/{id}</a></td>
                                        <td>Route with parameter</td>
                                        <td><code>Route::get('/user/{id}', function($id) { ... });</code></td>
                                    </tr>
                                    <tr>
                                        <td><a href="/users">/users</a></td>
                                        <td>Resource controller</td>
                                        <td><code>Route::resource('users', UserController::class);</code></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>