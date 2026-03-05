<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ECommerce B2C')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<nav>
    <a href="{{ route('home') }}">🛒 ShopB2C</a>
    <a href="{{ route('products.index') }}">Produits</a>
    @auth
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('admin.products.index') }}">Dashboard Admin</a>
        @endif
        <form method="POST" action="{{ route('logout') }}" style="display:inline">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
    @else
        <a href="{{ route('login') }}">Connexion</a>
        <a href="{{ route('register') }}">Inscription</a>
    @endauth
</nav>

@if(session('success'))
    <div class="alert-success">{{ session('success') }}</div>
@endif

@yield('content')
</body>
</html>