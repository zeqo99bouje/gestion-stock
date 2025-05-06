@extends('layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Liste des Affectations</h2>
        <a href="{{ route('affectations.create') }}" class="btn btn-primary">➕ Nouvelle Affectation</a>
    </div>

    {{-- Formulaire de recherche --}}
    <form method="GET" action="{{ route('affectations.index') }}" class="mb-3 d-flex" role="search">
        <input type="text" name="search" class="form-control me-2" placeholder="🔍 Rechercher par nom" value="{{ request('search') }}">
        <button type="submit" class="btn btn-secondary">Rechercher</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($affectations as $affectation)
                <tr>
                    <td>{{ $affectation->nom }}</td>
                    <td>
                        <a href="{{ route('affectations.edit', $affectation) }}" class="btn btn-sm btn-warning">✏️ Modifier</a>
                        <form action="{{ route('affectations.destroy', $affectation) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette affectation ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑️ Supprimer</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="2" class="text-center">Aucune affectation trouvée.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection
