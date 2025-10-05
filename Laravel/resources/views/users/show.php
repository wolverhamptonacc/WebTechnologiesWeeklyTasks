<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details - Laravel Tutorial</title>
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
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- User Details Card -->
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2 class="mb-0">User Details</h2>
                        <a href="/users" class="btn btn-outline-secondary btn-sm">Back to List</a>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">ID:</dt>
                            <dd class="col-sm-9"><?= htmlspecialchars($user['id']) ?></dd>
                            
                            <dt class="col-sm-3">Name:</dt>
                            <dd class="col-sm-9"><?= htmlspecialchars($user['name']) ?></dd>
                            
                            <dt class="col-sm-3">Email:</dt>
                            <dd class="col-sm-9">
                                <a href="mailto:<?= htmlspecialchars($user['email']) ?>"><?= htmlspecialchars($user['email']) ?></a>
                            </dd>
                            
                            <dt class="col-sm-3">Created:</dt>
                            <dd class="col-sm-9"><?= htmlspecialchars($user['created_at']) ?></dd>
                        </dl>
                    </div>
                </div>

                <!-- Response Format Examples -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Response Format Examples</h5>
                    </div>
                    <div class="card-body">
                        <p>This user data can be accessed in different formats:</p>
                        <div class="list-group">
                            <a href="/users/<?= $user['id'] ?>" 
                               class="list-group-item list-group-item-action active">
                                <strong>HTML Format</strong> (current view)
                                <br><small class="text-muted">Default view using templates</small>
                            </a>
                            <a href="/users/<?= $user['id'] ?>?format=json" 
                               class="list-group-item list-group-item-action">
                                <strong>JSON Format</strong>
                                <br><small class="text-muted">Returns user data as JSON response</small>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Laravel Concepts -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Laravel Concepts Demonstrated</h5>
                    </div>
                    <div class="card-body">
                        <ul class="mb-0">
                            <li><strong>Route Parameters:</strong> <code>/users/{id}</code> captures the user ID</li>
                            <li><strong>Controller Method:</strong> <code>UserController@show</code> handles this request</li>
                            <li><strong>Response Types:</strong> Same route returns HTML or JSON based on request</li>
                            <li><strong>View Data:</strong> Controller passes <code>$user</code> data to the view</li>
                            <li><strong>Request Query:</strong> <code>?format=json</code> changes response type</li>
                        </ul>
                    </div>
                </div>

                <!-- Request Information -->
                <div class="card mt-4">
                    <div class="card-header">
                        <h5 class="mb-0">Request Information</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li><strong>Route:</strong> <code>users.show</code></li>
                            <li><strong>Method:</strong> <code>GET</code></li>
                            <li><strong>Parameters:</strong> <code>id = <?= htmlspecialchars($user['id']) ?></code></li>
                            <li><strong>URL:</strong> <code><?= htmlspecialchars($_SERVER['REQUEST_URI']) ?></code></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>