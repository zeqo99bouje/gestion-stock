@extends('layout.app')

@section('content')
    <h2>➕ Nouvelle Affectation</h2>

    <form action="{{ route('affectations.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nom" class="form-label">Nom de l'affectation</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('affectations.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
@endsection
