<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Societe;
use App\Models\Mouvement;
use App\Models\Affectation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProduitController extends Controller
{
    public function index()
    {
        $produits = Produit::with('societe', 'affectation')->get();
        return view('produits.index', compact('produits'));
    }

    public function create()
    {
        $societes = Societe::all();
        return view('produits.create', compact('societes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'numero_inventaire' => 'required|unique:produits',
            'designation' => 'required',
            'quantite_stock' => 'required|integer|min:1',
            'unite' => 'required',
            'societe_id' => 'required|exists:societes,id',
            'bon_commande' => 'nullable',
            'date_reception' => 'nullable|date',
            'remarque' => 'nullable',
        ]);

        DB::transaction(function () use ($data) {
            $produit = Produit::create($data);

            Mouvement::create([
                'produit_id' => $produit->id,
                'type' => 'entrée',
                'quantite' => $produit->quantite_stock,
                'date_mouvement' => now(),
                'motif' => 'Ajout initial au stock',
            ]);
        });

        return redirect()->route('produits.index')->with('success', 'Produit ajouté avec succès.');
    }

    public function affectationForm(Produit $produit)
    {
        $affectations = Affectation::all();
        return view('produits.affecter', compact('produit', 'affectations'));
    }

    public function affecter(Request $request, Produit $produit)
    {
        $data = $request->validate([
            'affectation_id' => 'required|exists:affectations,id',
            'quantite' => 'required|integer|min:1|max:' . $produit->quantite_stock,
        ]);

        DB::transaction(function () use ($produit, $data) {
            // Mettre à jour le stock
            $produit->decrement('quantite_stock', $data['quantite']);

            // Créer le mouvement
            Mouvement::create([
                'produit_id' => $produit->id,
                'type' => 'sortie',
                'quantite' => $data['quantite'],
                'date_mouvement' => now(),
                'motif' => 'Affectation',
                'destination' => Affectation::find($data['affectation_id'])->nom ?? 'Inconnue',
            ]);
        });

        return redirect()->route('produits.index')->with('success', 'Produit affecté avec succès.');
    }

    public function show(Produit $produit)
    {
        return view('produits.show', compact('produit'));
    }

    public function edit(Produit $produit)
    {
        $societes = Societe::all();
        return view('produits.edit', compact('produit', 'societes'));
    }

    public function update(Request $request, Produit $produit)
    {
        $data = $request->validate([
            'designation' => 'required',
            'unite' => 'required',
            'societe_id' => 'required|exists:societes,id',
            'quantite_stock' => 'required|integer|min:0',
            'bon_commande' => 'nullable',
            'date_reception' => 'nullable|date',
            'remarque' => 'nullable',
        ]);
    
        DB::transaction(function () use ($produit, $data) {
            $ancienneQuantite = $produit->quantite_stock;
            $nouvelleQuantite = $data['quantite_stock'];
    
            // Mettre à jour le produit
            $produit->update($data);
    
            if ($nouvelleQuantite != $ancienneQuantite) {
                // Récupérer le dernier mouvement de type 'entrée'
                $dernierEntree = $produit->mouvements()
                    ->where('type', 'entrée')
                    ->latest('date_mouvement')
                    ->first();
    
                if ($dernierEntree) {
                    $dernierEntree->update([
                        'quantite' => $nouvelleQuantite,
                        'motif' => 'Mise à jour manuelle du stock',
                        'date_mouvement' => now(),
                    ]);
                }
            }
        });
    
        return redirect()->route('produits.index')->with('success', 'Produit mis à jour avec ajustement de la quantité.');
    }
    

    public function destroy(Produit $produit)
    {
        $produit->delete();
        return redirect()->route('produits.index')->with('success', 'Produit supprimé avec succès.');
    }
}
