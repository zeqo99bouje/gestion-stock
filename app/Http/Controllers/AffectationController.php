<?php

namespace App\Http\Controllers;

use App\Models\Affectation;
use Illuminate\Http\Request;

class AffectationController extends Controller
{
    public function index(Request $request)
    {
        $query = Affectation::query();
    
        if ($request->filled('search')) {
            $query->where('nom', 'like', '%' . $request->search . '%');
        }
    
        $affectations = $query->latest()->get();
    
        return view('affectations.index', compact('affectations'));
    }
    

    public function create()
    {
        return view('affectations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        Affectation::create($request->all());

        return redirect()->route('affectations.index')->with('success', 'Affectation ajoutée avec succès.');
    }

    public function edit(Affectation $affectation)
    {
        return view('affectations.edit', compact('affectation'));
    }

    public function update(Request $request, Affectation $affectation)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
        ]);

        $affectation->update($request->all());

        return redirect()->route('affectations.index')->with('success', 'Affectation mise à jour avec succès.');
    }

    public function destroy(Affectation $affectation)
    {
        $affectation->delete();

        return redirect()->route('affectations.index')->with('success', 'Affectation supprimée avec succès.');
    }
}

