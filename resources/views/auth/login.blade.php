<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <style>
        /* Arrière-plan */
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Carte de connexion */
        .login-card {
            background: #ffffff;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        /* Titre */
        .login-card h2 {
            margin-bottom: 20px;
            color: #333333;
        }

        /* Champs */
        .login-card input[type="email"],
        .login-card input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f9fafb;
            font-size: 16px;
        }

        /* Bouton */
        .login-card button {
            margin-top: 20px;
            width: 100%;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 14px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        /* Hover bouton */
        .login-card button:hover {
            background-color: #0056b3;
        }

        /* Erreurs */
        .error-messages {
            background-color: #ffe5e5;
            border: 1px solid #ffcccc;
            padding: 10px;
            margin-bottom: 15px;
            color: #cc0000;
            border-radius: 8px;
            text-align: left;
        }

    </style>
</head>
<body>

    <div class="login-card">
        <h2>Se connecter</h2>

        @if ($errors->any())
            <div class="error-messages">
                <ul style="padding-left: 20px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf
            <input type="email" name="email" placeholder="Adresse e-mail" value="{{ old('email') }}" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
    </div>

</body>
</html>
