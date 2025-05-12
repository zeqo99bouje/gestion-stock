<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\AffectationController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\MouvementController;

// Page de connexion
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

// Redirection '/' vers login
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes protégées par middleware
Route::middleware('auth.custom')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Ressources principales
    Route::resource('societes', SocieteController::class);
    Route::resource('affectations', AffectationController::class);
    Route::resource('produits', ProduitController::class);

    // ✅ Routes personnalisées pour affectation d’un produit
    Route::get('produits/{produit}/affecter', [ProduitController::class, 'affectationForm'])->name('produits.affecter.form');
    Route::post('produits/{produit}/affecter', [ProduitController::class, 'affecter'])->name('produits.affecter');

    // ✅ Route pour l'historique des mouvements
    Route::get('/mouvements', [MouvementController::class, 'index'])->name('mouvements.index');

    //------ ✅ Routes personnalisées pour l'exportation---------------
    // ✅ Routes personnalisées pour l'exportation des sociétés
    Route::get('/societes/export/excel', [SocieteController::class, 'exportExcel'])->name('societes.export.excel');
    Route::get('/societes/export/pdf', [SocieteController::class, 'exportPdf'])->name('societes.export.pdf');
    // ✅ Routes personnalisées pour l'exportation des produits
    Route::get('/produits/export/excel', [ProduitController::class, 'exportExcel'])->name('produits.export.excel');
    Route::get('/produits/export/pdf', [ProduitController::class, 'exportPdf'])->name('produits.export.pdf');
    
});
