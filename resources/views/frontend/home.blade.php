<h1 class="text text-center">Bienvenue, {{ auth()->user()->name }} !</h1>

<form method="POST" action="{{ route('logout') }}" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-outline-primary mx-3 mt-2 d-block">
        Se déconnecter
    </button>