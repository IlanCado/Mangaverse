<?php 

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

/**
 * Class RatingController
 * Gère les évaluations des mangas.
 */
class RatingController extends Controller
{
    /**
     * Ajoute une évaluation à un manga ou met à jour une évaluation existante.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valider les données entrantes
        $validated = $request->validate([
            'manga_id' => 'required|exists:mangas,id', // ID du manga doit exister
            'rating_value' => 'required|numeric|min:1|max:5', // Note entre 1 et 5
        ]);

        // Mettre à jour ou créer une nouvelle évaluation
        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(), // ID de l'utilisateur connecté
                'manga_id' => $validated['manga_id'],
            ],
            [
                'rating_value' => $validated['rating_value'],
            ]
        );

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Note ajoutée ou mise à jour avec succès !');
    }
}
