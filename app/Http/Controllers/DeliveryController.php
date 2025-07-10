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


}
