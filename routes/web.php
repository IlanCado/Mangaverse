<?php

use App\Http\Controllers\MangaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Route d'accueil
Route::get('/', [MangaController::class, 'index'])->name('home');

// Dashboard pour les utilisateurs connectés
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes pour la gestion des profils utilisateur
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Routes pour la gestion des mangas accessibles à tous (index et détail)
Route::resource('mangas', MangaController::class)->only(['index', 'show']);

// Routes pour les mangas nécessitant une authentification (CRUD complet sauf index et show)
Route::middleware('auth')->group(function () {
    Route::resource('mangas', MangaController::class)->except(['index', 'show']);
});

// Routes pour les commentaires (ajouter et supprimer)
Route::resource('comments', CommentController::class)->only(['store', 'destroy'])->middleware('auth');

// Route pour les évaluations des mangas
Route::post('ratings', [RatingController::class, 'store'])->name('ratings.store')->middleware('auth');

// Route pour le formulaire de contact
Route::get('/contacts/create', function () {
    return view('contacts.contact');
})->name('contacts.create');
Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');

require __DIR__ . '/auth.php';
