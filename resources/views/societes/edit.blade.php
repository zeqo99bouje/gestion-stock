@extends('layout.app')

@section('content')
    <h2>Modifier Société</h2>

    <form action="{{ route('societes.update', $societe) }}" method="POST">
        @csrf
        @method('PUT')
        @include('societes.form')
        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
@endsection
