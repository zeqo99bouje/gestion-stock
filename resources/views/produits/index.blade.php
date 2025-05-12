@extends('layouts.template')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header Section -->
         
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Liste des Produits</h2>
            <div class="d-flex gap-2">
            <div class="dropdown">
                    <button class="btn btn-outline-secondary d-flex align-items-center gap-2" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download" viewBox="0 0 16 16">
                            <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                            <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                        </svg>
                        Exporter
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="exportDropdown">
                        <li>
                            <a class="dropdown-item" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel me-2" viewBox="0 0 16 16">
                                    <path d="M5.884 6.68a.5.5 0 1 0-.768-.64L4 7.22l-1.116-1.18a.5.5 0 0 0-.768.64L3.629 8.2 2.116 9.72a.5.5 0 0 0 .768.64L4 9.18l1.116 1.18a.5.5 0 0 0 .768-.64L4.371 8.2l1.513-1.52z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                </svg>
                                Exporter en Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf me-2" viewBox="0 0 16 16">
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 915V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2A1.5 1.5 0 0 0 11 4.5h2v9.255a2.336 2.336 0 0 1-.331-.15c-.345.375-.678.683-.975.912a7.321 7.321 0 0 1-1.891.76c-.79.233-1.6.291-2.377.145-.805-.151-1.6-.45-2.378-1.07A6.643 6.643 0 0 1 3 12.11a6.212 6.212 0 0 1-.532-2.745 6.1 6.1 0 0 1 .763-2.937 6.42 6.42 0 0 1 2.07-2.07 5.999 5.999 0 0 1 2.938-.763 6.42 6.42 0 0 1 2.745.532c.627.27 1.2.645 1.708 1.108.496.45.945.975 1.332 1.552.151.225.292.457.414.695zm-6.285-1.575c-.342.06-.69.093-1.037.093-1.072 0-1.994-.698-2.307-1.663-.15.075-.307.135-.468.18a4.123 4.123 0 0 1-1.125.12c-.375 0-.75-.045-1.125-.165-.36-.12-.69-.285-1.005-.51a2.704 2.704 0 0 1-.75-.84c-.135-.255-.24-.525-.315-.81-.045-.15-.075-.315-.075-.48 0-.585.21-1.125.585-1.545.36-.405.855-.72 1.455-.915.585-.18 1.245-.27 1.905-.27.66 0 1.29.09 1.875.27.585.18 1.08.495 1.44.915.375.42.585.96.585 1.545 0 .165-.03.33-.075.495-.075.285-.18.555-.315.81-.135.27-.345.495-.615.69-.27.18-.585.315-.945.39zm1.95-3.885c-.27-.405-.645-.765-1.08-1.035a4.668 4.668 0 0 0-1.56-.585c-.54-.09-1.095-.135-1.665-.135-.57 0-1.125.045-1.665.135-.54.09-1.05.27-1.515.585-.465.315-.855.675-1.125 1.095-.135.21-.255.435-.345.675-.045.12-.075.24-.075.375 0 .51.195.975.585 1.32.39.33.885.585 1.455.735.585.135 1.2.195 1.815.195.615 0 1.2-.06 1.755-.195.555-.15 1.035-.405 1.395-.735.39-.345.585-.81.585-1.32 0-.135-.03-.255-.075-.375-.09-.24-.21-.465-.345-.675z"/>
                                </svg>
                                Exporter en PDF
                            </a>
                        </li>
                    </ul>
                </div>
            <a href="{{ route('produits.create') }}" class="btn btn-primary d-flex align-items-center gap-2 animate-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Ajouter un produit">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
                Ajouter un produit
            </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show animate-alert" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ route('produits.index') }}" class="mb-4" role="search">
            <div class="input-group animate-input-group">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Rechercher par numéro, désignation ou société" aria-label="Recherche de produits">
                <button type="submit" class="btn btn-outline-secondary animate-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Rechercher">Rechercher</button>
            </div>
        </form>

        <!-- Table -->
        <div class="table-responsive animate-table">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Numéro Inventaire</th>
                        <th scope="col">Désignation</th>
                        <th scope="col">Quantité Stock</th>
                        <th scope="col">Unité</th>
                        <th scope="col">Société</th>
                        <th scope="col">Affectation actuelle</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($produits as $produit)
                        <tr class="animate-row">
                            <td>{{ $produit->numero_inventaire }}</td>
                            <td>{{ $produit->designation }}</td>
                            <td>{{ $produit->quantite_stock }}</td>
                            <td>{{ $produit->unite }}</td>
                            <td>{{ $produit->societe->nom ?? '-' }}</td>
                            <td>{{ $produit->affectation->nom ?? 'Stock principal' }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('produits.show', $produit->id) }}" class="btn btn-sm btn-info d-flex align-items-center gap-1 animate-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Voir les détails">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
                                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('produits.edit', $produit->id) }}" class="btn btn-sm btn-warning d-flex align-items-center gap-1 animate-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Modifier le produit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </a>
                                    <a href="{{ route('produits.affecter.form', $produit->id) }}" class="btn btn-sm btn-primary d-flex align-items-center gap-1 animate-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Affecter le produit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('produits.destroy', $produit->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce produit ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger d-flex align-items-center gap-1 animate-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Supprimer le produit">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 5h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z"/>
                                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center">Aucun produit trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

    <!-- Embedded CSS -->
    <style>
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

        /* Fade-in animation for alerts */
        .animate-alert {
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Slide-in animation for input group */
        .animate-input-group {
            animation: slideIn 0.5s ease-out;
        }

        /* Fade-in and slide-up animation for table */
        .animate-table {
            animation: slideUp 0.6s ease-out;
        }

        /* Hover scale animation for buttons */
        .animate-btn {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .animate-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
        }

        /* Fade-in animation for table rows */
        .animate-row {
            animation: fadeInRow 0.5s ease-out;
            animation-delay: calc(0.1s * var(--row-index));
        }

        /* Keyframes for animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes slideIn {
            from { transform: translateX(-20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }

        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        @keyframes fadeInRow {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Ensure table readability */
        .table th, .table td {
            vertical-align: middle;
        }

        /* Add subtle shadow to table for depth */
        .table-responsive {
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        /* Style alerts for consistency */
        .alert-success {
            border-left: 4px solid #28a745;
        }

        /* Responsive button layout */
        @media (max-width: 576px) {
            .d-flex.gap-2 {
                flex-wrap: wrap;
                gap: 0.5rem;
            }
            .btn-sm {
                flex: 1;
                text-align: center;
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