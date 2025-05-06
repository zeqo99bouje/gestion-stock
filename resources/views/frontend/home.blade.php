@extends('layouts.template')

@section('content')

<h1 class="app-page-title" id="greeting"></h1>
<h1 class="app-page-title">Tableau de bord</h1>

<p>Bonjour, {{ auth()->user()->name }} !</p>

<div class="row gx-5 gy-4 mb-4">
    <!-- Total Fruits -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Produits</h4>
                <div class="stats-figure">0</div>
                <div class="stats-desc">produits enregistrés</div>
            </div>
            <a class="stretched-link" href="#"></a>
        </div>
    </div>

    <!-- Total Légumes -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Stock Total</h4>
                <div class="stats-figure">0</div>
                <div class="stats-desc">unités en stock</div>
            </div>
            <a class="stretched-link" href="#"></a>
        </div>
    </div>

    <!-- Total Produits -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Entrées</h4>
                <div class="stats-figure">0</div>
                <div class="stats-desc">unités reçues</div>
            </div>
        </div>
    </div>

    <!-- Nouvelle carte pour les commandes -->
    <div class="col-12 col-md-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Sorties</h4>
                <div class="stats-figure">0</div>
                <div class="stats-desc">unités distribuées</div>
            </div>
           
        </div>
    </div>
</div>

<!-- Section des Graphes -->
<div class="row gx-5 gy-4">
    <div class="col-md-6">
        <div class="app-card app-card-chart shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="text-center mb-3">Mouvements par Produit</h4>
                <canvas id="pieChart" height="250"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="app-card app-card-chart shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="text-center mb-3">Stock par Affectation</h4>
                <canvas id="barChart" height="250"></canvas>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// Greeting automatique selon l'heure
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
});

// Pie Chart avec données dynamiques
const pieCtx = document.getElementById('pieChart').getContext('2d');
const pieChart = new Chart(pieCtx, {
    type: 'pie',
    data: {
        labels: ['Fruits', 'Légumes'],
        datasets: [{
            label: 'des Produits',
            data: 20 , 30,
            backgroundColor: ['#FF6384', '#36A2EB'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.formattedValue || '';
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = Math.round((context.raw / total) * 100);
                        return `${label}: ${value} Kg (${percentage}%)`;
                    }
                }
            }
        }
    }
});

// Bar Chart avec données dynamiques (exemple)
const barCtx = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(barCtx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jun'],
        datasets: [{
            label: 'Fruits (Kg)',
            data: [15, 20, 12, 18, 22, 25],
            backgroundColor: '#FF6384',
            borderRadius: 4
        }, {
            label: 'produit',
            data: [10, 15, 8, 12, 16, 20],
            backgroundColor: '#36A2EB',
            borderRadius: 4
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                title: {
                    display: true,
                    text: 'Quantité (Kg)'
                }
            },
            x: {
                title: {
                    display: true,
                    text: 'Mois'
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return `${context.dataset.label}: ${context.formattedValue} Kg`;
                    }
                }
            }
        }
    }
});
</script>

<style>
.stats-figure {
    font-size: 2rem;
    font-weight: bold;
    color: #2c3e50;
}
.stats-desc {
    font-size: 0.9rem;
    color: #7f8c8d;
}
.app-card-chart {
    border-radius: 10px;
}
</style>
@endsection