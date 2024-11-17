<?php


namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

/**
 * Class ContactController
 * Gère les messages envoyés via le formulaire de contact.
 */
class ContactController extends Controller
{
    /**
     * Stocke un message de contact.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:150',
            'message' => 'required',
            'screenshot' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $screenshotPath = $request->file('screenshot')
            ? $request->file('screenshot')->store('uploads/screenshots', 'public')
            : null;

        Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'message' => $validated['message'],
            'screenshot_path' => $screenshotPath,
        ]);

        return redirect()->back()->with('success', 'Message envoyé avec succès !');
    }
}
