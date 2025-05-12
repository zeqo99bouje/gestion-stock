<?php

namespace App\Exports;

use App\Models\Produit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ProduitsExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Produit::with(['societe', 'affectation'])->get();
    }

    public function headings(): array
    {
        return [
            'Numéro Inventaire',
            'Désignation',
            'Quantité Stock',
            'Unité',
            'Société',
            'Affectation Actuelle',
            'Bon de Commande',
            'Date de Réception',
            'Remarque',
        ];
    }

    public function map($produit): array
    {
        return [
            $produit->numero_inventaire,
            $produit->designation,
            $produit->quantite_stock,
            $produit->unite,
            $produit->societe->nom ?? '-',
            $produit->affectation->nom ?? 'Stock principal',
            $produit->bon_commande ?? '-',
            $produit->date_reception ?? '-',
            $produit->remarque ?? '-',
        ];
    }
}