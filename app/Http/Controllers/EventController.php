<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EventParticipant;

class EventController extends Controller
{
    public function showForm()
    {
        return view('events');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'required|string|max:50',
            'comments'  => 'nullable|string',
        ]);

        EventParticipant::create($validated);

        return back()->with('success', 'Votre participation a été enregistrée avec succès.');
    }
    public function index()
{
    $participations = EventParticipant::latest()->get(); // <- Correction ici
    return view('dashboard.events', compact('participations'));
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:en-attente,confirmee,annulee'
    ]);

    $participation = EventParticipant::findOrFail($id); // <- Correction ici
    $participation->status = $request->status;
    $participation->save();

    return back();
}

public function destroy($id)
{
    EventParticipant::findOrFail($id)->delete(); // <- Correction ici
    return back();
}

}
