<?php

namespace App\Exports;

use App\Models\Produit;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Support\Carbon;

class ProduitsExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    protected $search;

    public function __construct($search = null)
    {
        $this->search = $search;
    }

    public function query()
    {
        return Produit::query()
            ->with(['societe', 'affectation'])
            ->when($this->search, function ($query, $search) {
                return $query->where('numero_inventaire', 'like', '%' . $search . '%')
                             ->orWhere('designation', 'like', '%' . $search . '%')
                             ->orWhereHas('societe', function ($q) use ($search) {
                                 $q->where('nom', 'like', '%' . $search . '%');
                             });
            });
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
            $produit->date_reception instanceof \DateTime
                ? $produit->date_reception->format('d/m/Y')
                : ($produit->date_reception ? $produit->date_reception : '-'),
            $produit->remarque ?? '-',
        ];
    }
}