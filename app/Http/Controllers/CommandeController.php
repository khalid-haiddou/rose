<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;

class CommandeController extends Controller
{
    
    public function index()
    {
        $commandes = Commande::with(['products' => function($query) {
            $query->withPivot('quantity', 'price_ttc'); // Add this to include pivot data
        }])->latest()->get();

        return view('dashboard.commande', compact('commandes'));
    }
    public function update(Request $request, $id)
    {
        $commande = Commande::findOrFail($id);

        // Validate only fields that are provided
        $validated = $request->validate([
            'status'    => 'nullable|string|in:en-attente,confirmee,en-preparation,en-cours-de-livraison,livree,echec-de-la-livraison,retournee,annulee',
            'is_payed'  => 'nullable|boolean',
            'address'   => 'nullable|string|max:255',
            'city'      => 'nullable|string|max:255',
        ]);

        // Filter out null values so only submitted fields are updated
        $filtered = array_filter($validated, fn($value) => !is_null($value));

        $commande->update($filtered);

        return redirect()->route('dashboard.commandes')->with('success', 'Commande mise à jour avec succès.');
    }

}
