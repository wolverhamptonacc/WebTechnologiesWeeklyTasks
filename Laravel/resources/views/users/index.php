<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Laravel Tutorial</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Laravel Tutorial</a>
            <div class="navbar-nav">
                <a class="nav-link" href="/">Home</a>
                <a class="nav-link active" href="/users">Users</a>
                <a class="nav-link" href="/about">About</a>
            </div>
        </div>
    </nav>

    <div class="container my-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Users List</h1>
        </div>

        <!-- Search Form -->
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="/users">
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" name="search" class="form-control" 
                                   placeholder="Search users by name or email..." 
                                   value="<?= htmlspecialchars($search) ?>">
                        </div>
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-outline-primary">Search</button>
                            <?php if ($search): ?>
                                <a href="/users" class="btn btn-outline-secondary">Clear</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Users Table -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['id']) ?></td>
                                    <td><?= htmlspecialchars($user['name']) ?></td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td>
                                        <div class="btn-group" role="group">
                                            <a href="/users/<?= $user['id'] ?>" 
                                               class="btn btn-sm btn-outline-primary">View</a>
                                            <a href="/users/<?= $user['id'] ?>?format=json" 
                                               class="btn btn-sm btn-outline-success">JSON</a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Laravel Concepts Demonstrated -->
        <div class="mt-4">
            <div class="alert alert-info">
                <h4>Laravel Concepts Demonstrated Here:</h4>
                <ul class="mb-0">
                    <li><strong>Resource Controller:</strong> This would be handled by <code>UserController@index</code></li>
                    <li><strong>Request Handling:</strong> Search parameter accessed via <code>$request->get('search')</code></li>
                    <li><strong>View Data:</strong> Controller passes <code>$users</code> and <code>$search</code> to the view</li>
                    <li><strong>Blade Templates:</strong> In real Laravel, this would use <code>@foreach</code> and <code>@if</code> directives</li>
                </ul>
            </div>
        </div>

        <div class="mt-3">
            <small class="text-muted">
                Page <?= htmlspecialchars($page) ?> | Total users: <?= count($users) ?>
                <?php if ($search): ?>
                    | Filtered by: "<?= htmlspecialchars($search) ?>"
                <?php endif; ?>
            </small>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>