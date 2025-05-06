<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - EST Ouarzazate</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Réinitialisation et base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #007bff, #00c4b4);
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        /* Carte de connexion */
        .login-card {
            background: #ffffff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            max-width: 420px;
            width: 100%;
            text-align: center;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Animation d'apparition */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Logo */
        .login-card img.logo {
            max-width: 200px;
            margin-bottom: 20px;
        }

        /* Titre */
        .login-card h2 {
            color: #1a202c;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .login-card p {
            color: #4a5568;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Champs */
        .login-card input[type="email"],
        .login-card input[type="password"] {
            width: 100%;
            padding: 14px;
            margin: 12px 0;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #f7fafc;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .login-card input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.2);
        }

        /* Bouton */
        .login-card button {
            width: 100%;
            background: #007bff;
            color: #ffffff;
            border: none;
            padding: 14px;
            border-radius: 10px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }

        .login-card button:hover {
            background: #0056b3;
            transform: translateY(-2px);
        }

        .login-card button:active {
            transform: translateY(0);
        }

        /* Erreurs */
        .error-messages {
            background: #fff5f5;
            border: 1px solid #feb2b2;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 10px;
            color: #c53030;
            font-size: 14px;
            text-align: left;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-card {
                padding: 20px;
            }

            .login-card h2 {
                font-size: 20px;
            }

            .login-card img.logo {
                max-width: 150px;
            }
        }
    </style>
</head>
<body>
    <div class="login-card">
        <!-- Logo de l'EST Ouarzazate (remplacez par le chemin de votre logo) -->
        <img src="{{ asset('assets/img/est_logo.jpg') }}" alt="EST Ouarzazate Logo" class="logo">
        <h2>Connexion</h2>
        <p>Gestion de stock - EST Ouarzazate</p>

        @if ($errors->any())
            <div class="error-messages">
                <ul>
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