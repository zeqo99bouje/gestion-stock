@extends('layout.app')

@section('content')
<div class="container">
    <h2>✏ Modifier le produit</h2>

    <form action="{{ route('produits.update', $produit->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Numéro d'inventaire</label>
            <input type="text" name="numero_inventaire" value="{{ $produit->numero_inventaire }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Désignation</label>
            <input type="text" name="designation" value="{{ $produit->designation }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Quantité</label>
            <input type="number" name="quantite_stock" value="{{ $produit->quantite_stock }}" class="form-control" required>
        </div>



        <div class="mb-3">
            <label>Unité</label>
            <input type="text" name="unite" value="{{ $produit->unite }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Fournisseur</label>
            <select name="societe_id" class="form-control" required>
                @foreach ($societes as $societe)
                    <option value="{{ $societe->id }}" @if($produit->societe_id == $societe->id) selected @endif>{{ $societe->nom }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Bon de commande</label>
            <input type="text" name="bon_commande" value="{{ $produit->bon_commande }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Date de réception</label>
            <input type="date" name="date_reception" value="{{ $produit->date_reception }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Remarques</label>
            <textarea name="remarque" class="form-control">{{ $produit->remarque }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('produits.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
