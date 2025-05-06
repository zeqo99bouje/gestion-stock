@extends('layout.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Liste des produits</h2>

    <a href="{{ route('produits.create') }}" class="btn btn-success mb-3">➕ Ajouter un produit</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
              
                <th>Numéro Inventaire</th>
                <th>Désignation</th>
                <th>Quantité Stock</th>
                <th>Unité</th>
                <th>Société</th>
                <th>Affectation actuelle</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produits as $produit)
                <tr>
                   
                    <td>{{ $produit->numero_inventaire }}</td>
                    <td>{{ $produit->designation }}</td>
                    <td>{{ $produit->quantite_stock }}</td>
                    <td>{{ $produit->unite }}</td>
                    <td>{{ $produit->societe->nom ?? '-' }}</td>
                    <td>{{ $produit->affectation->nom ?? 'Stock principal' }}</td>
                    <td>
                        <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-info btn-sm">👁 Voir</a>
                        <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-warning btn-sm">✏ Modifier</a>
                        <a href="{{ route('produits.affecter.form', $produit->id) }}" class="btn btn-primary btn-sm">📤 Affecter</a>
                        <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce produit ?')">🗑 Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
