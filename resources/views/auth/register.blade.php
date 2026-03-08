<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — ShopB2C</title>
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
            max-width: 480px;
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

        input[type=text],
        input[type=email],
        input[type=password],
        input[type=tel],
        textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            font-size: 14px;
            outline: none;
            transition: border .2s;
        }

        input:focus,
        textarea:focus {
            border-color: #6366f1;
        }

        .row2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .optional {
            color: #94a3b8;
            font-weight: 400;
            font-size: 12px;
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
            margin-top: 8px;
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

        .error {
            color: #dc2626;
            font-size: 12px;
            margin-top: 4px;
            display: block;
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
        <p class="subtitle">Créer votre compte</p>

        @if (session('error'))
            <div class="alert-error">{{ session('error') }}</div>
        @endif

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <div class="row2">
                <div class="field">
                    <label>Nom complet *</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="field">
                    <label>Email *</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="row2">
                <div class="field">
                    <label>Mot de passe *</label>
                    <input type="password" name="password" placeholder="Min. 8 caractères" required>
                    @error('password')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="field">
                    <label>Confirmer *</label>
                    <input type="password" name="password_confirmation" required>
                </div>
            </div>

            <div class="field">
                <label>Téléphone <span class="optional">(optionnel)</span></label>
                <input type="tel" name="phone" value="{{ old('phone') }}">
            </div>

            <div class="field">
                <label>Adresse <span class="optional">(optionnel)</span></label>
                <input type="text" name="address" value="{{ old('address') }}">
            </div>

            <div class="field">
                <label>Photo de profil <span class="optional">(optionnel)</span></label>
                <input type="file" name="avatar" accept="image/*"
                    style="padding:6px; border:2px dashed #e2e8f0; border-radius:8px;
                          width:100%; cursor:pointer">
                @error('avatar')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn">Créer mon compte</button>
        </form>

        <p class="footer-link">
            Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a>
        </p>
    </div>
</body>

</html>
