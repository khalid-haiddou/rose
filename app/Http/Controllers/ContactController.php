<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    /**
     * Affiche la page de contact
     */
    public function showForm()
    {
        return view('contact');
    }

    /**
     * Traite l'envoi du formulaire de contact
     */
    public function submitForm(Request $request)
    {
        // Validation des champs
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Enregistrement dans la base de données
        ContactMessage::create([
            'name'    => $request->name,
            'email'   => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Redirection avec message de succès
        return back()->with('success', 'Votre message a été envoyé avec succès.');
    }

    public function index()
    {
        $messages = ContactMessage::orderBy('created_at', 'desc')->get();
        return view('dashboard.contact', compact('messages'));
    }

    // Supprime un message
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();

        return redirect()->back()->with('success', 'Message supprimé.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:non-lu,lu,repondu',
        ]);

        $message = ContactMessage::findOrFail($id);
        $message->status = $request->status;
        $message->save();

        return back()->with('success', 'Statut mis à jour.');
    }
}
