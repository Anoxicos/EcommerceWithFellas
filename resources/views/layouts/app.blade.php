<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShopB2C')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, sans-serif;
            background: #f8fafc;
            color: #1e293b;
        }

        a {
            text-decoration: none;
        }

        nav {
            background: #1e293b;
            padding: 0 32px;
            display: flex;
            align-items: center;
            height: 60px;
            gap: 24px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        nav .brand {
            color: #fff;
            font-size: 20px;
            font-weight: 800;
        }

        nav .nav-link {
            color: #94a3b8;
            font-size: 14px;
            transition: color .2s;
        }

        nav .nav-link:hover {
            color: #fff;
        }

        nav .nav-right {
            margin-left: auto;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn {
            display: inline-block;
            padding: 7px 18px;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: #6366f1;
            color: #fff;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #475569;
            color: #94a3b8;
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 36px 24px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
    </style>
    @yield('styles')
</head>

<body>

    <nav>
        <a href="{{ route('home') }}" class="brand">🛒 ShopB2C</a>
        <a href="{{ route('products.index') }}" class="nav-link">Produits</a>

        <div class="nav-right">
            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" style="color:#818cf8; font-size:14px; font-weight:600">⚙️
                        Admin</a>
                @endif
                <span style="color:#64748b; font-size:14px">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-outline">Déconnexion</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="nav-link">Connexion</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Inscription</a>
            @endauth
        </div>
    </nav>

    <main>
        @if (session('success'))
            <div class="alert alert-success">✅ {{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-error">❌ {{ session('error') }}</div>
        @endif

        @yield('content')
    </main>

</body>

</html>
