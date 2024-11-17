<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;

/**
 * Class MangaController
 * Gère les actions liées aux mangas.
 */
class MangaController extends Controller
{
    /**
     * Affiche la liste des mangas.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $mangas = Manga::all();
        return view('mangas.index', compact('mangas'));
    }

    /**
     * Affiche le formulaire de création d'un manga.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('mangas.create');
    }

    /**
     * Stocke un manga dans la base de données.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'author' => 'required|max:100',
            'description' => 'required|max:500',
            'genre' => 'required|max:50',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        Manga::create($validated);

        return redirect()->route('mangas.index')->with('success', 'Manga créé avec succès !');
    }

    /**
     * Affiche un manga spécifique.
     *
     * @param Manga $manga
     * @return \Illuminate\View\View
     */
    public function show(Manga $manga)
    {
        $manga->load(['comments.user', 'ratings']); // Charger les relations
        return view('mangas.show', [
            'manga' => $manga,
            'averageRating' => $manga->ratings->avg('rating_value') ?? 'Non noté',
        ]);
    }

    /**
     * Affiche le formulaire pour modifier un manga.
     *
     * @param Manga $manga
     * @return \Illuminate\View\View
     */
    public function edit(Manga $manga)
    {
        return view('mangas.edit', compact('manga'));
    }

    /**
     * Met à jour un manga existant.
     *
     * @param \Illuminate\Http\Request $request
     * @param Manga $manga
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Manga $manga)
    {
        $validated = $request->validate([
            'title' => 'required|max:100',
            'author' => 'required|max:100',
            'description' => 'required|max:500',
            'genre' => 'required|max:50',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $manga->update($validated);

        return redirect()->route('mangas.index')->with('success', 'Manga mis à jour avec succès !');
    }

    /**
     * Supprime un manga.
     *
     * @param Manga $manga
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Manga $manga)
    {
        $manga->delete();
        return redirect()->route('mangas.index')->with('success', 'Manga supprimé avec succès !');
    }
}
