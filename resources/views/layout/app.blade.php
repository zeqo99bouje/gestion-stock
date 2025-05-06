<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion de Stock - EST Ouarzazate</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
        }
        .sidebar {
            width: 220px;
            background-color: #343a40;
            padding-top: 1rem;
        }
        .sidebar .nav-link {
            color: #fff;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #495057;
        }
        .content {
            flex-grow: 1;
            padding: 2rem;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column p-3">
        <h4 class="text-white text-center mb-4">EST - Stock</h4>
        <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item"><a href="/dashboard" class="nav-link">🏠 Tableau de bord</a></li>
    <li class="nav-item"><a href="{{ route('societes.index') }}" class="nav-link">📦 Sociétés</a></li>
    <li><a href="{{ route('affectations.index') }}" class="nav-link">🏢 Affectations</a></li>
    <li><a href="{{ route('produits.index') }}" class="nav-link">🛠️ Produits</a></li>
    <li><a href="{{ route('mouvements.index') }}" class="nav-link">🛠️ Historique de Mouvement</a></li>

</ul>
        <form action="{{ route('logout') }}" method="POST" class="mt-auto text-center">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm mt-4">Déconnexion</button>
        </form>
    </div>

    <!-- Main content -->
    <div class="content">
        @yield('content')
        @yield('scripts')
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
