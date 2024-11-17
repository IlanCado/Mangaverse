<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class ContactController
 * Gère les messages envoyés via le formulaire de contact.
 */
class ContactController extends Controller
{
    /**
     * Stocke un message de contact dans la base de données.
     *
     * @param \Illuminate\Http\Request $request Les données envoyées par l'utilisateur.
     * @return \Illuminate\Http\RedirectResponse Redirection vers la page précédente avec un message de succès.
     */
    public function store(Request $request)
    {
        try {
            // Validation des données du formulaire
            $validated = $request->validate([
                'name' => 'required|max:100',
                'email' => 'required|email|max:150',
                'message' => 'required|max:1000',
                'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:40000',
            ]);

            // Enregistrer le fichier de capture d'écran si présent
            $screenshotPath = $request->file('screenshot')
                ? $request->file('screenshot')->store('uploads/screenshots', 'public')
                : null;

            // Création d'un nouvel enregistrement dans la table contacts
            Contact::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'message' => $validated['message'],
                'screenshot_path' => $screenshotPath,
            ]);

            // Retourner un message de succès
            return redirect()->back()->with('success', 'Message envoyé avec succès !');
        } catch (\Exception $e) {
            // Journaliser l'erreur pour le débogage
            Log::error('Erreur lors de l\'enregistrement du message de contact : ' . $e->getMessage());

            // Retourner un message d'erreur
            return redirect()->back()->with('error', 'Une erreur est survenue. Veuillez réessayer.');
        }
    }
}
