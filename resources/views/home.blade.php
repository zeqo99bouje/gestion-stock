@extends('layout.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Tableau de Bord</h2>

    {{-- Statistiques --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary shadow">
                <div class="card-body">Total Produits : {{ $totalProduits }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success shadow">
                <div class="card-body">Stock Total : {{ $stockTotal }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-info shadow">
                <div class="card-body">Entrées : {{ $totalEntrees }}</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger shadow">
                <div class="card-body">Sorties : {{ $totalSorties }}</div>
            </div>
        </div>
    </div>

    {{-- Boutons de basculement --}}
    <div class="mb-3 text-end">
        <button class="btn btn-outline-primary" onclick="toggleView('chart')">Afficher Graphique</button>
        <button class="btn btn-outline-secondary" onclick="toggleView('tables')">Afficher Tableaux</button>
    </div>

    {{-- Vue Graphique --}}
    <div id="chartView">
        @if($chartData->isNotEmpty())
        <div class="card mb-4 shadow">
            <div class="card-header">Graphique des mouvements par produit</div>
            <div class="card-body">
                <canvas id="mouvementChart" height="100"></canvas>
            </div>
        </div>
        @endif
    </div>

    {{-- Vue Tableaux --}}
    <div id="tablesView" style="display: none;">
        {{-- Derniers mouvements --}}
        <div class="card mb-4 shadow">
            <div class="card-header">Derniers mouvements</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Produit</th>
                            <th>Type</th>
                            <th>Quantité</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($mouvements as $m)
                        <tr>
                            <td>{{ $m->produit->designation ?? 'N/A' }}</td>
                            <td>{{ ucfirst($m->type) }}</td>
                            <td>{{ $m->quantite }}</td>
                            <td>{{ $m->date_mouvement }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">Aucun mouvement récent</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Produits à stock faible --}}
        <div class="card shadow">
            <div class="card-header d-flex justify-content-between">
                <span>Produits à stock faible (&lt; 50)</span>
                <div>
                    <a href="#" class="btn btn-sm btn-danger">Exporter PDF</a>
                    <a href="#" class="btn btn-sm btn-success">Exporter Excel</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Désignation</th>
                            <th>Stock</th>
                            <th>Unité</th>
                            <th>Alerte</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stockFaible as $p)
                        <tr class="{{ $p->quantite_stock == 0 ? 'table-danger' : '' }}">
                            <td>{{ $p->designation }}</td>
                            <td>{{ $p->quantite_stock }}</td>
                            <td>{{ $p->unite }}</td>
                            <td>
                                @if($p->quantite_stock == 0)
                                    <span class="badge bg-danger">Rupture</span>
                                @else
                                    <span class="badge bg-warning text-dark">Stock faible</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center">Aucun produit en stock faible</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@if($chartData->isNotEmpty())
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('mouvementChart').getContext('2d');

    const labels = {!! json_encode($chartData->pluck('produit.designation')) !!};
    const entrees = {!! json_encode($chartData->pluck('entrees')) !!};
    const sorties = {!! json_encode($chartData->pluck('sorties')) !!};

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Entrées',
                    data: entrees,
                    backgroundColor: 'rgba(75, 192, 192, 0.7)'
                },
                {
                    label: 'Sorties',
                    data: sorties,
                    backgroundColor: 'rgba(255, 99, 132, 0.7)'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Mouvements par Produit'
                },
                legend: {
                    position: 'top'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endif



<script>
    function toggleView(view) {
        document.getElementById('chartView').style.display = (view === 'chart') ? 'block' : 'none';
        document.getElementById('tablesView').style.display = (view === 'tables') ? 'block' : 'none';
    }
</script>
@endsection
