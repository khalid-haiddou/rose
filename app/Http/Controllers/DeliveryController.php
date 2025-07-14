<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        // Fetch commandes with all statuses except 'en-attente'
        $commandes = Commande::with('products')
            ->where('status', '!=', 'en-attente')
            ->orderByDesc('created_at')
            ->get();

        return view('dashboard.livraison', compact('commandes'));
    }
    public function updateDeliveryNumber(Request $request, Commande $commande)
{
    $request->validate([
        'delivery_number' => 'required|string|max:255',
        'status' => 'required|string|in:en-attente,confirmee,en-preparation,en-cours-de-livraison,en-transit,livree,echec-de-la-livraison,retournee,annulee',
    ]);

    $commande->delivery_number = $request->delivery_number;
    $commande->status = $request->status;
    $commande->save();

    return redirect()->back()->with('success', 'Numéro de livraison et statut mis à jour.');
}


}
