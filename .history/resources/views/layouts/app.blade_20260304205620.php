<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body>
    <nav>
        @auth
            <a href="{{ route('cart.index') }}">Cart</a>

            @if(auth()->user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}">Admin</a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>

    <main>
        @yield('content')
    </main>
</body>
</html>
