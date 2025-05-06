<?php

namespace App\Http\Controllers;

use App\Models\Societe;
use Illuminate\Http\Request;

class SocieteController extends Controller
{
  public function index(Request $request)
{
    $query = Societe::query();

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where('nom', 'like', "%$search%")
              ->orWhere('adresse', 'like', "%$search%")
              ->orWhere('telephone', 'like', "%$search%")
              ->orWhere('email', 'like', "%$search%");
    }

    $societes = $query->get();

    return view('societes.index', compact('societes'));
}


    public function create()
    {
        return view('societes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        Societe::create($request->all());

        return redirect()->route('societes.index')->with('success', 'Société ajoutée avec succès.');
    }

    public function edit(Societe $societe)
    {
        return view('societes.edit', compact('societe'));
    }

    public function update(Request $request, Societe $societe)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'adresse' => 'nullable|string',
            'telephone' => 'nullable|string',
            'email' => 'nullable|email',
        ]);

        $societe->update($request->all());

        return redirect()->route('societes.index')->with('success', 'Société modifiée avec succès.');
    }

    public function destroy(Societe $societe)
    {
        $societe->delete();

        return redirect()->route('societes.index')->with('success', 'Société supprimée avec succès.');
    }
}
