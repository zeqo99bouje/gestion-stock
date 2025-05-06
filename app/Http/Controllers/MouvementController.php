<?php

namespace App\Http\Controllers;

use App\Models\Mouvement;
use App\Models\Produit;
use Illuminate\Http\Request;

class MouvementController extends Controller
{

public function index(Request $request)
{
    $query = Mouvement::query()->with('produit');

    if ($request->produit_id) {
        $query->where('produit_id', $request->produit_id);
    }
    if ($request->type) {
        $query->where('type', $request->type);
    }

    if ($request->date_debut && $request->date_fin) {
        $query->whereBetween('date_mouvement', [$request->date_debut, $request->date_fin]);
    }

    $mouvements = $query->latest()->get();
    $produits = Produit::all();

    return view('mouvements.index', compact('mouvements', 'produits'));
}
}