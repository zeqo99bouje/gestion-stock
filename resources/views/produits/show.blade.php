@extends('layout.app')

@section('content')
<div class="container">
    <h2>Détails du produit</h2>

    <ul class="list-group">
        <li class="list-group-item"><strong>Numéro d'inventaire:</strong> {{ $produit->numero_inventaire }}</li>
        <li class="list-group-item"><strong>Désignation:</strong> {{ $produit->designation }}</li>
        <li class="list-group-item"><strong>Quantité:</strong> {{ $produit->quantite_stock }} {{ $produit->unite }}</li>
        <li class="list-group-item"><strong>Fournisseur:</strong> {{ $produit->societe->nom ?? '-' }}</li>
        <li class="list-group-item"><strong>Affectation actuelle:</strong> {{ $produit->affectation->nom ?? 'Stock principal' }}</li>
        <li class="list-group-item"><strong>Date réception:</strong> {{ $produit->date_reception }}</li>
        <li class="list-group-item"><strong>Bon de commande:</strong> {{ $produit->bon_commande }}</li>
        <li class="list-group-item"><strong>Remarque:</strong> {{ $produit->remarque }}</li>
    </ul>

    <a href="{{ route('produits.index') }}" class="btn btn-secondary mt-3">Retour</a>
</div>
@endsection
