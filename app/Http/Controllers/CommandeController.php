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

        $validated = $request->validate([
            'status'    => 'required|string',
            'is_payed'  => 'required|boolean',
            'address'   => 'required|string|max:255',
            'city'      => 'required|string|max:255',
        ]);

        $commande->update($validated);

        return redirect()->route('dashboard.commandes')->with('success', 'Commande mise à jour avec succès.');
    }
}
