<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') | Dance Studio Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        body { background: #f6f4f8; }
        .navbar-brand i { color: #f5b7d6; }
        .card { border: 0; box-shadow: 0 2px 8px rgba(60, 20, 80, .08); }
        .stat-card .display-6 { font-weight: 700; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background:#4a1d6b;">
    <div class="container">
        <a class="navbar-brand" href="{{ route('dashboard') }}"><i class="bi bi-music-note-beamed"></i> Dance Studio</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}" href="{{ route('students.index') }}">Students</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('instructors.*') ? 'active' : '' }}" href="{{ route('instructors.index') }}">Instructors</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('dance-classes.*') ? 'active' : '' }}" href="{{ route('dance-classes.index') }}">Dance Classes</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('schedules.*') ? 'active' : '' }}" href="{{ route('schedules.index') }}">Schedules</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('enrollments.*') ? 'active' : '' }}" href="{{ route('enrollments.index') }}">Enrollments</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="container py-4">
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

<footer class="text-center text-muted small pb-4">Dance Studio Management System &copy; {{ date('Y') }}</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
/* Keep typed form values when the page is refreshed (draft saved in the browser). */
(function () {
    var hasOld = {{ count(session()->getOldInput()) ? 'true' : 'false' }};
    var saved = {{ session('success') ? 'true' : 'false' }};
    var prefix = 'draft:';

    try {
        // A successful save means the drafts are no longer needed.
        if (saved) {
            Object.keys(localStorage).forEach(function (k) {
                if (k.indexOf(prefix) === 0) localStorage.removeItem(k);
            });
        }

        document.querySelectorAll('form[method="POST"]').forEach(function (form, i) {
            var fields = form.querySelectorAll('input[name]:not([type=hidden]):not([type=submit]), select[name], textarea[name]');
            if (!fields.length) return; // skip delete buttons

            var key = prefix + location.pathname + '#' + i;
            var draft = JSON.parse(localStorage.getItem(key) || '{}');

            // Restore only when the server did not already send back old input (validation errors).
            if (!hasOld) {
                fields.forEach(function (f) {
                    if (draft[f.name] !== undefined) f.value = draft[f.name];
                });
            }

            function save() {
                var data = {};
                fields.forEach(function (f) { data[f.name] = f.value; });
                localStorage.setItem(key, JSON.stringify(data));
            }
            form.addEventListener('input', save);
            form.addEventListener('change', save);

            // Cancel link clears the draft.
            form.querySelectorAll('a.btn-secondary').forEach(function (a) {
                a.addEventListener('click', function () { localStorage.removeItem(key); });
            });
        });
    } catch (e) { /* storage unavailable: ignore */ }
})();
</script>
</body>
</html>
