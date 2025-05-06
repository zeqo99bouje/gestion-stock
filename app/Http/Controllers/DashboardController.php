<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use App\Models\Mouvement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $societe_id = $request->societe_id;
        $affectation_id = $request->affectation_id;

        $produitsQuery = Produit::query();
        if ($societe_id) $produitsQuery->where('societe_id', $societe_id);
        if ($affectation_id) $produitsQuery->where('affectation_id', $affectation_id);

        $totalProduits = $produitsQuery->count();
        $stockTotal = $produitsQuery->sum('quantite_stock');
        $stockFaible = $produitsQuery->where('quantite_stock', '<', 50)->get();
        $produits = $produitsQuery->get();

        $mouvements = Mouvement::with('produit')->latest()->limit(5)->get();
        $totalEntrees = Mouvement::where('type', 'entrée')->sum('quantite');
        $totalSorties = Mouvement::where('type', 'sortie')->sum('quantite');

        // Graphique: entrées et sorties par produit
        $chartData = Mouvement::select(
                'produit_id',
                DB::raw("SUM(CASE WHEN type = 'entrée' THEN quantite ELSE 0 END) as entrees"),
                DB::raw("SUM(CASE WHEN type = 'sortie' THEN quantite ELSE 0 END) as sorties")
            )
            ->groupBy('produit_id')
            ->with('produit')
            ->get()
            ->filter(fn($m) => $m->produit !== null);

        return view('home', compact(
            'totalProduits', 'stockTotal', 'totalEntrees', 'totalSorties',
            'mouvements', 'chartData', 'stockFaible', 'produits'
        ));
    }
}
