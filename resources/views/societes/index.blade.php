@extends('layout.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Liste des Sociétés</h2>
        <a href="{{ route('societes.create') }}" class="btn btn-primary">➕ Nouvelle Société</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('societes.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Rechercher par nom, adresse, téléphone ou email">
        <button type="submit" class="btn btn-outline-secondary">🔍 Rechercher</button>
    </div>
</form>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Téléphone</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($societes as $societe)
                <tr>
                    <td>{{ $societe->nom }}</td>
                    <td>{{ $societe->adresse }}</td>
                    <td>{{ $societe->telephone }}</td>
                    <td>{{ $societe->email }}</td>
                    <td>
                        <a href="{{ route('societes.edit', $societe) }}" class="btn btn-sm btn-warning">✏️ Modifier</a>
                        <form action="{{ route('societes.destroy', $societe) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette société ?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">🗑️ Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
