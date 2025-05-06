@extends('layout.app')

@section('content')
<div class="container">
    <h2>➕ Ajouter un produit</h2>

    <form action="{{ route('produits.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Numéro d'inventaire</label>
            <input type="text" name="numero_inventaire" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Désignation</label>
            <input type="text" name="designation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Quantité</label>
            <input type="number" name="quantite_stock" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Unité</label>
            <input type="text" name="unite" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fournisseur (Société)</label>
            <select name="societe_id" class="form-control" required>
                @foreach ($societes as $societe)
                    <option value="{{ $societe->id }}">{{ $societe->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Bon de commande</label>
            <input type="text" name="bon_commande" class="form-control">
        </div>

        <div class="mb-3">
            <label>Date de réception</label>
            <input type="date" name="date_reception" class="form-control">
        </div>

        <div class="mb-3">
            <label>Remarques</label>
            <textarea name="remarque" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('produits.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
