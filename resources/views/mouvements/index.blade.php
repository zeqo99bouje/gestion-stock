@extends('layouts.template')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4 animate-header">
            <h2 class="mb-0">Historique des Mouvements</h2>
            <a href="{{ route('mouvements.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2 animate-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Rafraîchir la liste">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                    <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                </svg>
                Rafraîchir
            </a>
        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show animate-alert" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Filter Form -->
        <div class="card shadow-sm mb-4 animate-card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Filtres de Recherche</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('mouvements.index') }}" class="row g-3">
                    <div class="col-md-3">
                        <label for="produit_id" class="form-label">Produit</label>
                        <select name="produit_id" id="produit_id" class="form-select @error('produit_id') is-invalid @enderror" aria-describedby="produit_id-error">
                            <option value="" {{ request('produit_id') ? '' : 'selected' }}>Tous</option>
                            @foreach($produits as $produit)
                                <option value="{{ $produit->id }}" {{ request('produit_id') == $produit->id ? 'selected' : '' }}>
                                    {{ $produit->designation }}
                                </option>
                            @endforeach
                        </select>
                        @error('produit_id')
                            <div id="produit_id-error" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label for="type" class="form-label">Type</label>
                        <select name="type" id="type" class="form-select @error('type') is-invalid @enderror" aria-describedby="type-error">
                            <option value="" {{ request('type') ? '' : 'selected' }}>Tous</option>
                            <option value="entrée" {{ request('type') == 'entrée' ? 'selected' : '' }}>Entrée</option>
                            <option value="sortie" {{ request('type') == 'sortie' ? 'selected' : '' }}>Sortie</option>
                        </select>
                        @error('type')
                            <div id="type-error" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label for="date_debut" class="form-label">Du</label>
                        <input type="date" name="date_debut" id="date_debut" class="form-control @error('date_debut') is-invalid @enderror" value="{{ request('date_debut') }}" aria-describedby="date_debut-error">
                        @error('date_debut')
                            <div id="date_debut-error" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-2">
                        <label for="date_fin" class="form-label">Au</label>
                        <input type="date" name="date_fin" id="date_fin" class="form-control @error('date_fin') is-invalid @enderror" value="{{ request('date_fin') }}" aria-describedby="date_fin-error">
                        @error('date_fin')
                            <div id="date_fin-error" class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 w-100 animate-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Appliquer les filtres">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                            </svg>
                            Filtrer
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="table-responsive shadow-sm animate-table">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th scope="col">Produit</th>
                        <th scope="col">Type</th>
                        <th scope="col">Quantité</th>
                        <th scope="col">Date</th>
                        <th scope="col">Motif</th>
                        <th scope="col">Destination</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mouvements as $mouvement)
                        <tr class="animate-row">
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

    <!-- Embedded CSS -->
    <style>
        /* Card styling for filter form */
        .card {
            border-radius: 8px;
            border: none;
        }

        /* Tooltip styling */
        .tooltip-inner {
            background-color: #333;
            color: #fff;
            padding: 0.5rem 0.75rem;
            border-radius: 4px;
            font-size: 0.875rem;
        }

        .tooltip .tooltip-arrow::before {
            border-top-color: #333 !important;
        }

        /* Fade-in animation for header */
        .animate-header {
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Fade-in animation for alerts */
        .animate-alert {
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Slide-up animation for card */
        .animate-card {
            animation: slideUp 0.6s ease-out;
        }

        /* Slide-up animation for table */
        .animate-table {
            animation: slideUp 0.6s ease-out 0.2s;
        }

        /* Fade-in animation for pagination */
        .animate-pagination {
            animation: fadeIn 0.5s ease-in-out 0.4s;
        }

        /* Fade-in animation for table rows */
        .animate-row {
            animation: fadeInRow 0.5s ease-out;
            animation-delay: calc(0.1s * var(--row-index));
        }

        /* Hover scale animation for buttons */
        .animate-btn {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .animate-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        /* Ensure form inputs are visually clear */
        .form-control, .form-select {
            transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
        }

        /* Highlight invalid inputs */
        .form-control.is-invalid, .form-select.is-invalid {
            border-color: #dc3545;
        }

        /* Table styling */
        .table th, .table td {
            vertical-align: middle;
        }

        .table-responsive {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Style alerts for consistency */
        .alert-success {
            border-left: 4px solid #28a745;
        }

        /* Keyframes for animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fadeInRow {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive form layout */
        @media (max-width: 576px) {
            .row.g-3 {
                flex-direction: column;
            }
            .col-md-3, .col-md-2 {
                width: 100%;
            }
            .btn.w-100 {
                width: 100% !important;
            }
        }
    </style>

    <!-- Embedded JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize tooltips
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.forEach(tooltipTriggerEl => {
                new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Row animation delay
            const rows = document.querySelectorAll('.animate-row');
            rows.forEach((row, index) => {
                row.style.setProperty('--row-index', index);
            });
        });
    </script>
@endsection