<!DOCTYPE html>
<html lang="fr">
<head>
    <title>@yield('title', 'Gestion de Stock - EST Ouarzazate')</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gestion de stock pour l'École Supérieure de Technologie - Ouarzazate">
    <meta name="author" content="EST Ouarzazate">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/img/est_logo.jpg') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/est_logo.jpg') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/est_logo.jpg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/est_logo.jpg') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/portal.css') }}">

    <!-- Loader CSS -->
    <style>
        .loader-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.5s ease-out;
        }
        .loader-container.hidden {
            opacity: 0;
            pointer-events: none;
        }
        .loader {
            width: 50px;
            aspect-ratio: 1;
            display: grid;
            border: 4px solid transparent;
            border-radius: 50%;
            border-right-color: #007bff;
            animation: l15 1s infinite linear;
        }
        .loader::before,
        .loader::after {    
            content: "";
            grid-area: 1/1;
            margin: 2px;
            border: inherit;
            border-radius: 50%;
            animation: l15 2s infinite;
        }
        .loader::after {
            margin: 8px;
            animation-duration: 3s;
        }
        @keyframes l15 { 
            100% { transform: rotate(1turn); }
        }
       
    </style>
     @yield('styles')
</head>

<body class="app">
    <div class="loader-container" id="loader">
        <div class="loader"></div>
    </div>

    <header class="app-header fixed-top">
        @include('layouts.topbar')
        @include('layouts.sidebar')
    </header>

    <div class="app-wrapper">
        <div class="app-content pt-3 p-md-3 p-lg-4">
            <div class="container-xl">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/plugins/chart.js/chart.min.js') }}"></script>
    <script src="{{ asset('assets/js/index-charts.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

    <!-- Loader JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loader = document.getElementById('loader');
            window.addEventListener('load', () => {
                setTimeout(() => {
                    loader.classList.add('hidden');
                }, 100);
            });
            document.querySelectorAll('form').forEach(form => {
                form.addEventListener('submit', () => {
                    loader.classList.remove('hidden');
                });
            });
        });
    </script>

    @yield('scripts')
</body>
</html>