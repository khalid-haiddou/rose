<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index(Request $request)
    {
        $query = Commande::with('products')
            ->where('status', '!=', 'en-attente');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%$search%")
                ->orWhere('delivery_number', 'like', "%$search%")
                ->orWhere('firstname', 'like', "%$search%")
                ->orWhere('lastname', 'like', "%$search%");
            });
        }

        if ($status = $request->input('status')) {
            $query->where('status', $status);
        }

        $commandes = $query->orderByDesc('created_at')->paginate(12);

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
