@extends('layouts.template')

@section('content')
    <div class="container-fluid py-4">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Liste des Sociétés</h2>
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
                            <a class="dropdown-item" href="{{route('societes.export.excel')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-excel me-2" viewBox="0 0 16 16">
                                    <path d="M5.884 6.68a.5.5 0 1 0-.768-.64L4 7.22l-1.116-1.18a.5.5 0 0 0-.768.64L3.629 8.2 2.116 9.72a.5.5 0 0 0 .768.64L4 9.18l1.116 1.18a.5.5 0 0 0 .768-.64L4.371 8.2l1.513-1.52z"/>
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z"/>
                                </svg>
                                Exporter en Excel
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('societes.export.pdf')}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-pdf me-2" viewBox="0 0 16 16">
                                    <path d="M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 915V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2A1.5 1.5 0 0 0 11 4.5h2v9.255a2.336 2.336 0 0 1-.331-.15c-.345.375-.678.683-.975.912a7.321 7.321 0 0 1-1.891.76c-.79.233-1.6.291-2.377.145-.805-.151-1.6-.45-2.378-1.07A6.643 6.643 0 0 1 3 12.11a6.212 6.212 0 0 1-.532-2.745 6.1 6.1 0 0 1 .763-2.937 6.42 6.42 0 0 1 2.07-2.07 5.999 5.999 0 0 1 2.938-.763 6.42 6.42 0 0 1 2.745.532c.627.27 1.2.645 1.708 1.108.496.45.945.975 1.332 1.552.151.225.292.457.414.695zm-6.285-1.575c-.342.06-.69.093-1.037.093-1.072 0-1.994-.698-2.307-1.663-.15.075-.307.135-.468.18a4.123 4.123 0 0 1-1.125.12c-.375 0-.75-.045-1.125-.165-.36-.12-.69-.285-1.005-.51a2.704 2.704 0 0 1-.75-.84c-.135-.255-.24-.525-.315-.81-.045-.15-.075-.315-.075-.48 0-.585.21-1.125.585-1.545.36-.405.855-.72 1.455-.915.585-.18 1.245-.27 1.905-.27.66 0 1.29.09 1.875.27.585.18 1.08.495 1.44.915.375.42.585.96.585 1.545 0 .165-.03.33-.075.495-.075.285-.18.555-.315.81-.135.27-.345.495-.615.69-.27.18-.585.315-.945.39zm1.95-3.885c-.27-.405-.645-.765-1.08-1.035a4.668 4.668 0 0 0-1.56-.585c-.54-.09-1.095-.135-1.665-.135-.57 0-1.125.045-1.665.135-.54.09-1.05.27-1.515.585-.465.315-.855.675-1.125 1.095-.135.21-.255.435-.345.675-.045.12-.075.24-.075.375 0 .51.195.975.585 1.32.39.33.885.585 1.455.735.585.135 1.2.195 1.815.195.615 0 1.2-.06 1.755-.195.555-.15 1.035-.405 1.395-.735.39-.345.585-.81.585-1.32 0-.135-.03-.255-.075-.375-.09-.24-.21-.465-.345-.675z"/>
                                </svg>
                                Exporter en PDF
                            </a>
                        </li>
                    </ul>
                </div>
                <a href="{{ route('societes.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                    </svg>
                    Nouvelle Société
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Search Form -->
        <form method="GET" action="{{ route('societes.index') }}" class="mb-4">
            <div class="input-group">
                <span class="input-group-text">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                </span>
                <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Rechercher par nom, adresse, téléphone ou email" aria-label="Recherche de sociétés">
                <button type="submit" class="btn btn-outline-secondary">Rechercher</button>
            </div>
        </form>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Adresse</th>
                        <th scope="col">Téléphone</th>
                        <th scope="col">Email</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($societes as $societe)
                        <tr>
                            <td>{{ $societe->nom }}</td>
                            <td>{{ $societe->adresse }}</td>
                            <td>{{ $societe->telephone }}</td>
                            <td>{{ $societe->email }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('societes.edit', $societe) }}" class="btn btn-sm btn-warning d-flex align-items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                            <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                        </svg>
                                    </a>
                                    <form action="{{ route('societes.destroy', $societe) }}" method="POST" class="d-inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette société ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger d-flex align-items-center gap-1">
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
                            <td colspan="5" class="text-center">Aucune société trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection