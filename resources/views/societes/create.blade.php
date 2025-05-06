@extends('layout.app')

@section('content')
    <h2>Ajouter une nouvelle Société</h2>

    <form action="{{ route('societes.store') }}" method="POST">
        @csrf
        @include('societes.form')
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
@endsection
