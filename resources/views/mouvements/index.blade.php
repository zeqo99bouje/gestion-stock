@extends('layout.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📑 Historique des mouvements</h2>

    {{-- Formulaire de filtrage --}}
    <form method="GET" class="row g-3 mb-4 shadow-sm p-3 rounded bg-light">
        <div class="col-md-3">
            <label for="produit_id" class="form-label">Produit</label>
            <select name="produit_id" id="produit_id" class="form-select">
                <option value="">Tous</option>
                @foreach($produits as $produit)
                    <option value="{{ $produit->id }}" {{ request('produit_id') == $produit->id ? 'selected' : '' }}>
                        {{ $produit->designation }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2">
            <label for="type" class="form-label">Type</label>
            <select name="type" id="type" class="form-select">
                <option value="">Tous</option>
                <option value="entrée" {{ request('type') == 'entrée' ? 'selected' : '' }}>Entrée</option>
                <option value="sortie" {{ request('type') == 'sortie' ? 'selected' : '' }}>Sortie</option>
            </select>
        </div>

        <div class="col-md-2">
            <label for="date_debut" class="form-label">Du</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control" value="{{ request('date_debut') }}">
        </div>

        <div class="col-md-2">
            <label for="date_fin" class="form-label">Au</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control" value="{{ request('date_fin') }}">
        </div>

        <div class="col-md-3 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">🔍 Filtrer</button>
        </div>
    </form>

    {{-- Tableau des mouvements --}}
    <div class="table-responsive shadow-sm">
        <table class="table table-hover table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Produit</th>
                    <th>Type</th>
                    <th>Quantité</th>
                    <th>Date</th>
                    <th>Motif</th>
                    <th>Destination</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mouvements as $mouvement)
                    <tr>
                        <td>{{ $mouvement->produit ? $mouvement->produit->designation : '-' }}</td>
                        <td class="text-center">
                            <span class="badge rounded-pill {{ $mouvement->type === 'entrée' ? 'bg-success' : 'bg-danger' }}">
                                {{ ucfirst($mouvement->type) }}
                            </span>
                        </td>
                        <td class="text-center">{{ $mouvement->quantite }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($mouvement->date_mouvement)->format('d/m/Y') }}</td>
                        <td>{{ $mouvement->motif ?? '-' }}</td>
                        <td>{{ $mouvement->destination ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Aucun mouvement trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
