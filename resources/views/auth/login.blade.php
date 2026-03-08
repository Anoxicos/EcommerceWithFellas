<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — ShopB2C</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            background: #fff;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }

        .logo {
            text-align: center;
            font-size: 28px;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 8px;
        }

        .subtitle {
            text-align: center;
            color: #64748b;
            font-size: 14px;
            margin-bottom: 32px;
        }

        .field {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border .2s;
        }

        input:focus {
            border-color: #6366f1;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: #64748b;
            margin-bottom: 20px;
        }

        .remember input {
            width: auto;
        }

        .btn {
            width: 100%;
            padding: 11px;
            background: #6366f1;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background .2s;
        }

        .btn:hover {
            background: #4f46e5;
        }

        .footer-link {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #64748b;
        }

        .footer-link a {
            color: #6366f1;
            font-weight: 600;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="logo">🛒 ShopB2C</div>
        <p class="subtitle">Connexion à votre compte</p>

        @if (session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="field">
                <label>Adresse email</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="vous@exemple.com" required
                    autofocus>
            </div>

            <div class="field">
                <label>Mot de passe</label>
                <input type="password" name="password" placeholder="••••••••" required>
            </div>

            <label class="remember">
                <input type="checkbox" name="remember">
                Se souvenir de moi
            </label>

            <button type="submit" class="btn">Se connecter</button>
        </form>

        <p class="footer-link">
            Pas encore de compte ? <a href="{{ route('register') }}">S'inscrire</a>
        </p>
    </div>
</body>

</html>
