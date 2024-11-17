<?php


namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

/**
 * Class CommentController
 * Gère les actions liées aux commentaires.
 */
class CommentController extends Controller
{
    /**
     * Ajoute un commentaire à un manga.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Valider les données entrantes
        $validated = $request->validate([
            'manga_id' => 'required|exists:mangas,id', // ID du manga doit exister
            'content' => 'required|max:300', // Limite de 300 caractères
        ]);

        // Créer le commentaire dans la base de données
        Comment::create([
            'user_id' => auth()->id(), // Utilisateur connecté (forcé par le middleware)
            'manga_id' => $validated['manga_id'],
            'content' => $validated['content'],
        ]);

        // Rediriger avec un message de succès
        return redirect()->back()->with('success', 'Commentaire ajouté avec succès !');
    }

    /**
     * Supprime un commentaire.
     *
     * @param \App\Models\Comment $comment
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Comment $comment)
    {
        // Vérifier si l'utilisateur est l'auteur du commentaire
        if ($comment->user_id === auth()->id()) {
            $comment->delete(); // Supprimer le commentaire
            return redirect()->back()->with('success', 'Commentaire supprimé avec succès !');
        }

        // Retourner une erreur si l'utilisateur n'est pas autorisé
        return redirect()->back()->with('error', 'Action non autorisée.');
    }
}
