<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Societe;
use App\Models\Mouvement;
use App\Models\Affectation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ProduitsExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;


class ProduitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $produits = Produit::with(['societe', 'affectation'])
            ->when($search, function ($query, $search) {
                return $query->where('numero_inventaire', 'like', '%' . $search . '%')
                             ->orWhere('designation', 'like', '%' . $search . '%')
                             ->orWhereHas('societe', function ($q) use ($search) {
                                 $q->where('nom', 'like', '%' . $search . '%');
                             });
            })
            ->paginate(10)
            ->appends(['search' => $search]);

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

    public function exportExcel(Request $request)
    {
        try {
            $search = $request->query('search');
            Log::info('Exporting Excel', ['search' => $search, 'user' => auth()->user()->id ?? 'guest']);
            return Excel::download(new ProduitsExport($search), 'produits_recherche_'.now()->format('Ymd_His').'.xlsx');
        } catch (\Exception $e) {
            Log::error('Excel export failed', ['error' => $e->getMessage(), 'search' => $search]);
            return redirect()->route('produits.index')->with('error', 'Erreur lors de l\'exportation en Excel: ' . $e->getMessage());
        }
    }

    public function exportPdf(Request $request)
    {
        try {
            $search = $request->query('search');
            Log::info('Exporting PDF', ['search' => $search, 'user' => auth()->user()->id ?? 'guest']);
            $produits = Produit::with(['societe', 'affectation'])
                ->when($search, function ($query, $search) {
                    return $query->where('numero_inventaire', 'like', '%' . $search . '%')
                                 ->orWhere('designation', 'like', '%' . $search . '%')
                                 ->orWhereHas('societe', function ($q) use ($search) {
                                     $q->where('nom', 'like', '%' . $search . '%');
                                 });
                })
                ->get();
            $pdf = Pdf::loadView('produits.pdf', compact('produits'));
            return $pdf->download('produits_recherche_'.now()->format('Ymd_His').'.pdf');
        } catch (\Exception $e) {
            Log::error('PDF export failed', ['error' => $e->getMessage(), 'search' => $search]);
            return redirect()->route('produits.index')->with('error', 'Erreur lors de l\'exportation en PDF: ' . $e->getMessage());
        }
    }

}
