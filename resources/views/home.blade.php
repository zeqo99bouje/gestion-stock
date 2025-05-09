@extends('layouts.template')

@section('content')
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row align-items-center mb-4">
        <div class="col">

        <h2 class="app-page-title">Tableau de Bord</h2>
            <h1 class="app-page-title mb-0" id="greeting"></h1>
            <p class="text-muted">{{ auth()->user()->name }} ! Bienvenue dans votre espace de gestion.</p>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row gx-4 gy-4 mb-5">
        <!-- Total Produits -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100 bg-primary text-white">
                <div class="app-card-body p-4 d-flex align-items-center">
                    <div>
                        <h4 class="stats-type mb-1 text-white">Total Produits</h4>
                        <div class="stats-figure">{{ $totalProduits }}</div>
                        <div class="stats-desc">Produits enregistrés</div>
                    </div>
                    <i class="fas fa-boxes fa-2x ms-auto opacity-75"></i>
                </div>
                <a class="stretched-link" href="{{ route('produits.index') }}"></a>
            </div>
        </div>

        <!-- Stock Total -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100 bg-success text-white">
                <div class="app-card-body p-4 d-flex align-items-center">
                    <div>
                        <h4 class="stats-type mb-1 text-white">Stock Total</h4>
                        <div class="stats-figure">{{ $stockTotal }}</div>
                        <div class="stats-desc">Unités en stock</div>
                    </div>
                    <i class="fas fa-warehouse fa-2x ms-auto opacity-75"></i>
                </div>
            </div>
        </div>

        <!-- Entrées -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100 bg-info text-white">
                <div class="app-card-body p-4 d-flex align-items-center">
                    <div>
                        <h4 class="stats-type mb-1 text-white">Entrées</h4>
                        <div class="stats-figure">{{ $totalEntrees }}</div>
                        <div class="stats-desc">Unités reçues</div>
                    </div>
                    <i class="fas fa-arrow-down fa-2x ms-auto opacity-75"></i>
                </div>
                <a class="stretched-link" href="{{ route('mouvements.index') }}"></a>
            </div>
        </div>

        <!-- Sorties -->
        <div class="col-12 col-md-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100 bg-danger text-white">
                <div class="app-card-body p-4 d-flex align-items-center">
                    <div>
                        <h4 class="stats-type mb-1 text-white">Sorties</h4>
                        <div class="stats-figure">{{ $totalSorties }}</div>
                        <div class="stats-desc">Unités distribuées</div>
                    </div>
                    <i class="fas fa-arrow-up fa-2x ms-auto opacity-75"></i>
                </div>
                <a class="stretched-link" href="{{ route('mouvements.index') }}"></a>
            </div>
        </div>
    </div>

    <!-- Boutons de basculement -->
    <div class="mb-4 d-flex justify-content-end align-items-center">
        <div class="btn-group shadow-sm" role="group" aria-label="Toggle views">
            <button type="button" class="btn btn-outline-primary toggle-btn" onclick="toggleView('chart')">
                <i class="fas fa-chart-bar me-2"></i>Graphiques
            </button>
            <button type="button" class="btn btn-outline-primary toggle-btn" onclick="toggleView('tables')">
                <i class="fas fa-table me-2"></i>Tableaux
            </button>
        </div>
    </div>

    <!-- Vue Graphique -->
    <div id="chartView">
        @if($chartData->isNotEmpty() || $sortiesParAffectation->isNotEmpty())
        <div class="row gx-4 gy-4 mb-5">
            <!-- Mouvements par Produit -->
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart shadow-sm h-100 bg-white">
                    <div class="app-card-header p-4 border-bottom">
                        <h4 class="mb-0 text-dark">Mouvements par Produit</h4>
                    </div>
                    <div class="app-card-body p-4">
                        <canvas id="mouvementChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Quantités Distribuées par Affectation -->
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart shadow-sm h-100 bg-white">
                    <div class="app-card-header p-4 border-bottom">
                        <h4 class="mb-0 text-dark">Quantités Distribuées par Affectation</h4>
                    </div>
                    <div class="app-card-body p-4">
                        <canvas id="barChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Répartition des Mouvements -->
            <div class="col-12 col-lg-6">
                <div class="app-card app-card-chart shadow-sm h-100 bg-white">
                    <div class="app-card-header p-4 border-bottom">
                        <h4 class="mb-0 text-dark">Répartition des Mouvements</h4>
                    </div>
                    <div class="app-card-body p-4">
                        <canvas id="pieChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Vue Tableaux -->
    <div id="tablesView" style="display: none;">
        <!-- Derniers mouvements -->
        <div class="app-card shadow-sm mb-4 bg-white">
            <div class="app-card-header p-4 border-bottom d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-dark">Derniers Mouvements</h4>
                <a href="{{ route('mouvements.index') }}" class="btn btn-sm btn-outline-primary">Voir tous</a>
            </div>
            <div class="app-card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="bg-light">
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
                                <td>
                                    <span class="badge {{ $m->type === 'entrée' ? 'bg-success' : 'bg-danger' }}">
                                        {{ ucfirst($m->type) }}
                                    </span>
                                </td>
                                <td>{{ $m->quantite }}</td>
                                <td>{{ \Carbon\Carbon::parse($m->date_mouvement)->format('d/m/Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">Aucun mouvement récent</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Produits à stock faible -->
        <div class="app-card shadow-sm bg-white">
            <div class="app-card-header p-4 border-bottom d-flex justify-content-between align-items-center">
                <h4 class="mb-0 text-dark">Produits à Stock Faible (< 50)</h4>
                <div>
                    <a href="#" class="btn btn-sm btn-danger me-2">
                        <i class="fas fa-file-pdf me-1"></i>PDF
                    </a>
                    <a href="#" class="btn btn-sm btn-success">
                        <i class="fas fa-file-excel me-1"></i>Excel
                    </a>
                </div>
            </div>
            <div class="app-card-body p-4">
                <div class="table-responsive">
                    <table class="table table-hover table-striped align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th>Désignation</th>
                                <th>Stock</th>
                                <th>Unité</th>
                                <th>Alerte</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($stockFaible as $p)
                            <tr class="{{ $p->quantite_stock == 0 ? 'table-danger' : 'table-warning' }}">
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
                            <tr>
                                <td colspan="4" class="text-center text-muted">Aucun produit en stock faible</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Dependencies -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>

<script>
// Greeting automatique selon l'heure avec animation
document.addEventListener('DOMContentLoaded', function() {
    const now = new Date();
    const hours = now.getHours();
    const greetingElement = document.getElementById('greeting');

    let greeting;
    if (hours >= 5 && hours < 12) {
        greeting = 'Bonjour';
    } else if (hours >= 12 && hours < 18) {
        greeting = 'Bon après-midi';
    } else if (hours >= 18 && hours < 22) {
        greeting = 'Bonsoir';
    } else {
        greeting = 'Bonne nuit';
    }

    greetingElement.textContent = greeting;
    greetingElement.classList.add('fade-in');
});

// Toggle view function with button state
function toggleView(view) {
    const chartView = document.getElementById('chartView');
    const tablesView = document.getElementById('tablesView');
    const chartBtn = document.querySelector('button[onclick="toggleView(\'chart\')]');
    const tablesBtn = document.querySelector('button[onclick="toggleView(\'tables\')]');

    chartView.style.display = view === 'chart' ? 'block' : 'none';
    tablesView.style.display = view === 'tables' ? 'block' : 'none';

    chartBtn.classList.toggle('active', view === 'chart');
    tablesBtn.classList.toggle('active', view === 'tables');

    // Animate transition
    const activeView = view === 'chart' ? chartView : tablesView;
    activeView.classList.add('fade-in');
    setTimeout(() => activeView.classList.remove('fade-in'), 500);
}

// Mouvement Chart
@if($chartData->isNotEmpty())
const mouvementCtx = document.getElementById('mouvementChart').getContext('2d');
const mouvementLabels = {!! json_encode($chartData->pluck('produit.designation')) !!};
const entrees = {!! json_encode($chartData->pluck('entrees')) !!};
const sorties = {!! json_encode($chartData->pluck('sorties')) !!};

new Chart(mouvementCtx, {
    type: 'bar',
    data: {
        labels: mouvementLabels,
        datasets: [
            {
                label: 'Entrées',
                data: entrees,
                backgroundColor: 'rgba(52, 199, 89, 0.8)', // Green
                borderColor: 'rgba(52, 199, 89, 1)',
                borderWidth: 1
            },
            {
                label: 'Sorties',
                data: sorties,
                backgroundColor: 'rgba(255, 69, 96, 0.8)', // Red
                borderColor: 'rgba(255, 69, 96, 1)',
                borderWidth: 1
            }
        ]
    },
    options: {
        responsive: true,
        animation: {
            duration: 1000,
            easing: 'easeOutQuart'
        },
        plugins: {
            title: {
                display: true,
                text: 'Mouvements par Produit',
                font: { size: 18, weight: 'bold' }
            },
            legend: {
                position: 'top',
                labels: { font: { size: 14 } }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleFont: { size: 14 },
                bodyFont: { size: 12 }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Quantité',
                    font: { size: 14 }
                },
                grid: { color: 'rgba(0, 0, 0, 0.05)' }
            },
            x: {
                title: {
                    display: true,
                    text: 'Produit',
                    font: { size: 14 }
                },
                ticks: { maxRotation: 45, minRotation: 45 }
            }
        }
    }
});
@endif

// Quantités Distribuées par Affectation Chart
@if($sortiesParAffectation->isNotEmpty())
const barCtx = document.getElementById('barChart').getContext('2d');
const affectationLabels = {!! json_encode($sortiesParAffectation->pluck('affectation_name')) !!};
const quantites = {!! json_encode($sortiesParAffectation->pluck('total_quantite')) !!};

new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: affectationLabels,
        datasets: [{
            label: 'Quantité Distribuée',
            data: quantites,
            backgroundColor: 'rgba(0, 122, 255, 0.8)', // Blue
            borderColor: 'rgba(0, 122, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        animation: {
            duration: 1000,
            easing: 'easeOutQuart'
        },
        plugins: {
            title: {
                display: true,
                text: 'Quantités Distribuées par Affectation',
                font: { size: 18, weight: 'bold' }
            },
            legend: {
                position: 'top',
                labels: { font: { size: 14 } }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleFont: { size: 14 },
                bodyFont: { size: 12 },
                callbacks: {
                    label: function(context) {
                        return `${context.dataset.label}: ${context.parsed.y}`;
                    },
                    afterLabel: function(context) {
                        const index = context.dataIndex;
                        const designations = {!! json_encode($sortiesParAffectation->pluck('designations')) !!}[index];
                        return 'Produits: ' + designations.slice(0, 3).join(', ') + (designations.length > 3 ? '...' : '');
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Quantité Distribuée',
                    font: { size: 14 }
                },
                grid: { color: 'rgba(0, 0, 0, 0.05)' }
            },
            x: {
                title: {
                    display: true,
                    text: 'Affectation',
                    font: { size: 14 }
                },
                ticks: { maxRotation: 45, minRotation: 45 }
            }
        }
    }
});
@endif

// Pie Chart
const pieCtx = document.getElementById('pieChart').getContext('2d');
new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: ['Entrées', 'Sorties'],
        datasets: [{
            data: [{{ $totalEntrees }}, {{ $totalSorties }}],
            backgroundColor: ['rgba(52, 199, 89, 0.8)', 'rgba(255, 69, 96, 0.8)'],
            borderColor: ['rgba(52, 199, 89, 1)', 'rgba(255, 69, 96, 1)'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        animation: {
            duration: 1000,
            easing: 'easeOutQuart'
        },
        plugins: {
            title: {
                display: true,
                text: 'Répartition des Mouvements',
                font: { size: 18, weight: 'bold' }
            },
            legend: {
                position: 'top',
                labels: { font: { size: 14 } }
            },
            tooltip: {
                backgroundColor: 'rgba(0, 0, 0, 0.8)',
                titleFont: { size: 14 },
                bodyFont: { size: 12 }
            }
        }
    }
});
</script>

<style>
/* General Styles */
body {
    font-family: 'Inter', sans-serif;
    background-color: #f5f7fa;
}

.app-page-title {
    font-weight: 700;
    color: #1a1a1a;
}

.text-muted {
    font-size: 0.95rem;
}

/* Stat Cards */
.app-card-stat {
    border-radius: 12px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    position: relative;
}

.app-card-stat:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15) !important;
}

.app-card-stat .stats-figure {
    font-size: 2.5rem;
    font-weight: 800;
    line-height: 1.2;
}

.app-card-stat .stats-type {
    font-size: 1rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.app-card-stat .stats-desc {
    font-size: 0.85rem;
    opacity: 0.9;
}

/* Charts */
.app-card-chart {
    border-radius: 12px;
    background-color: #fff;
    transition: box-shadow 0.3s ease;
}

.app-card-chart:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

.app-card-header {
    background-color: #fff;
}

/* Tables */
.table {
    border-radius: 8px;
    overflow: hidden;
}

.table thead th {
    font-weight: 600;
    color: #1a1a1a;
    background-color: #f8f9fa;
}

.table tbody tr {
    transition: background-color 0.2s ease;
}

.table tbody tr:hover {
    background-color: #f1f3f5;
}

.badge {
    font-size: 0.85rem;
    padding: 0.5em 1em;
    border-radius: 20px;
}

/* Buttons */
.btn-group .btn {
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn-group .btn.active {
    background-color: #007bff;
    color: #fff;
    box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
}

.btn-group .btn:hover {
    background-color: #0056b3;
    color: #fff;
}

.btn-sm {
    border-radius: 6px;
    padding: 0.5rem 1rem;
}

/* Animations */
.fade-in {
    animation: fadeIn 0.5s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Responsive Adjustments */
@media (max-width: 768px) {
    .app-card-stat .stats-figure {
        font-size: 2rem;
    }

    .btn-group .btn {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
    }

    .app-card-header h4 {
        font-size: 1.1rem;
    }
}
</style>
@endsection