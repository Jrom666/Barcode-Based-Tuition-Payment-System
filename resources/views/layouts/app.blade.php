<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'My Laravel App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            overflow-x: hidden;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #00025e;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .nav-link.active {
            background-color: #198754 !important;
            color: white !important;
            font-weight: bold;
        }
        #logout {
            margin-top: 100px;
            background-color: #CF0000;
            color: white;
            font-weight: bolder;
        }
    </style>
</head>
<body>

@auth
<!-- Sidebar -->
<div class="sidebar d-flex flex-column p-3 text-white">
    <div class="text-center mb-4">
        <img src="{{ asset('images/aclctacloban.png') }}" class="img-fluid mb-2" width="170" alt="Logo" />
        <h6 class="text-white">{{ auth()->user()->name }}</h6>
    </div>

    <!-- Navigation -->
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-2">
            <a href="{{ route('home') }}" class="nav-link text-white rounded-pill {{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="bi bi-house me-2"></i> Home
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('dashboard') }}" class="nav-link text-white rounded-pill {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('payment') }}" class="nav-link text-white rounded-pill {{ request()->routeIs('payment') ? 'active' : '' }}">
                <i class="bi bi-credit-card me-2"></i> Payment
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('statistics') }}" class="nav-link text-white rounded-pill {{ request()->routeIs('statistics') ? 'active' : '' }}">
                <i class="bi bi-bar-chart-line me-2"></i> Statistics
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('students') }}" class="nav-link text-white rounded-pill {{ request()->routeIs('students') ? 'active' : '' }}">
                <i class="bi bi-people me-2"></i> Students
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('transactions') }}" class="nav-link text-white rounded-pill {{ request()->routeIs('transactions') ? 'active' : '' }}">
                <i class="bi bi-journal-text me-2"></i> Transactions
            </a>
        </li>
        <li class="nav-item mb-4">
            <a href="{{ route('users') }}" class="nav-link text-white rounded-pill {{ request()->routeIs('users') ? 'active' : '' }}">
                <i class="bi bi-person-circle me-2"></i> Users
            </a>
        </li>
    </ul>

    <!-- Logout -->
    <form action="/logout" method="POST">
        @csrf
        <button type="submit" class="btn w-100 rounded-pill" id="logout">
            <i class="bi bi-box-arrow-right me-2"></i> Logout
        </button>
    </form>
</div>

<!-- Main Content -->
<div class="main-content">
    @yield('content')
</div>
@else
<script>
    window.location.href = "{{ url('/') }}";
</script>
@endauth

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
