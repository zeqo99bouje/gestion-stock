<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Liste des Produits</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        h1 { text-align: center; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h1>Liste des Produits</h1>
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
            @foreach ($produits as $produit)
                <tr>
                    <td>{{ $produit->numero_inventaire }}</td>
                    <td>{{ $produit->designation }}</td>
                    <td>{{ $produit->quantite_stock }}</td>
                    <td>{{ $produit->unite }}</td>
                    <td>{{ $produit->societe->nom ?? '-' }}</td>
                    <td>{{ $produit->affectation->nom ?? 'Stock principal' }}</td>
                    <td>{{ $produit->bon_commande ?? '-' }}</td>
                    <td>{{ $produit->date_reception ?? '-' }}</td>
                    <td>{{ $produit->remarque ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>