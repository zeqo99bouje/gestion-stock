<!-- resources/views/produits/pdf.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Liste des Produits</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Liste des Produits</h1>
    @if (request('search'))
        <h3>Résultats pour "{{ request('search') }}"</h3>
    @endif
    <table>
        <thead>
            <tr>
                <th>Numéro Inventaire</th>
                <th>Désignation</th>
                <th>Quantité Stock</th>
                <th>Unité</th>
                <th>Société</th>
                <th>Affectation Actuelle</th>
                <th>Bon de Commande</th>
                <th>Date de Réception</th>
                <th>Remarque</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($produits as $produit)
                <tr>
                    <td>{{ $produit->numero_inventaire }}</td>
                    <td>{{ $produit->designation }}</td>
                    <td>{{ $produit->quantite_stock }}</td>
                    <td>{{ $produit->unite }}</td>
                    <td>{{ $produit->societe->nom ?? '-' }}</td>
                    <td>{{ $produit->affectation->nom ?? 'Stock principal' }}</td>
                    <td>{{ $produit->bon_commande ?? '-' }}</td>
                    <td>{{ $produit->date_reception instanceof \DateTime ? $produit->date_reception->format('d/m/Y') : ($produit->date_reception ?: '-') }}</td>
                    <td>{{ $produit->remarque ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" style="text-align: center;">Aucun produit trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>