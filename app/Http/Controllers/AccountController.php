<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Commande;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $recentOrders = Commande::with('products') // eager load products
            ->where('user_id', $user->id)          // filter by user_id
            ->orderByDesc('created_at')
            ->take(3)
            ->get();

        return view('account.account', compact('user', 'recentOrders'));
    }

    public function fidelisation()
    {
        return view('account.fidelisation');
    }

    public function mesCommandes()
{
    $user = Auth::user();
    
    $commandes = Commande::with('products') // 👈 eager load products
        ->where('email', $user->email)
        ->orderByDesc('created_at')
        ->get();

    return view('account.mes-commandes', compact('commandes'));
}

}
