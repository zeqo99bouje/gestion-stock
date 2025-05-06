@extends('layout.app')

@section('content')
    <h2>✏️ Modifier l'Affectation</h2>

    <form action="{{ route('affectations.update', $affectation) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l'affectation</label>
            <input type="text" name="nom" class="form-control" value="{{ $affectation->nom }}" required>
        </div>
        <button type="submit" class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('affectations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
