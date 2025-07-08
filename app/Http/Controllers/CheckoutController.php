<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', []);
        $subtotal = collect($cart)->sum(fn($item) => $item['product']->prix_ttc * $item['quantity']);
        $shipping = $subtotal >= 499 ? 0 : 40;
        $total = $subtotal + $shipping;

        return view('checkout', compact('cart', 'subtotal', 'shipping', 'total'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'firstname' => 'required|string|max:255',
        'lastname'  => 'required|string|max:255',
        'email'     => 'required|email',
        'phone'     => 'required|string|max:20',
        'address'   => 'required|string|max:255',
        'city'      => 'required|string|max:255',
        'postcode'  => 'nullable|string|max:20',
        'shipping_method' => 'required|string',
        'payment_method'  => 'required|in:COD,CMI',
        'terms'     => 'accepted',
    ]);

    $cart = session()->get('cart', []);
    if (empty($cart)) {
        return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
    }

    $subtotal = collect($cart)->sum(fn($item) => $item['product']->prix_ttc * $item['quantity']);
    $shipping = $subtotal >= 499 ? 0 : 40;
    $total = $subtotal + $shipping;

    $year = now()->year;
    do {
        $random = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);
        $orderNumber = "RB-$year-$random";
    } while (Commande::where('order_number', $orderNumber)->exists());

    $commande = Commande::create([
        'order_number'     => $orderNumber,
        ...$validated,
        'shipping_price'   => $shipping,
        'total'            => $total,
        'is_payed'         => $validated['payment_method'] === 'CMI',
    ]);

    // ✅ Attach products to pivot table
    foreach ($cart as $item) {
        $commande->products()->attach($item['product']->id, [
            'quantity'   => $item['quantity'],
            'price_ttc'  => $item['product']->prix_ttc,
        ]);
    }

    session()->forget('cart');

    return redirect()->route('merci')
        ->with('success', 'Commande passée avec succès !')
        ->with('order_number', $orderNumber)
        ->with('order_email', $validated['email']);
}


    public function index()
{
    $commandes = Commande::with(['products' => function($query) {
        $query->withPivot('quantity', 'price_ttc'); // Add this to include pivot data
    }])->latest()->get();

    return view('dashboard.commande', compact('commandes'));
}

    public function update(Request $request, $id)
    {
        $commande = \App\Models\Commande::findOrFail($id);

        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname'  => 'required|string|max:255',
            'email'     => 'required|email',
            'phone'     => 'required|string|max:20',
            'address'   => 'required|string|max:255',
            'city'      => 'required|string|max:255',
            'postcode'  => 'nullable|string|max:20',
            'payment_method' => 'required|in:COD,CMI',
            'status'    => 'required|string'
        ]);

        $commande->update($validated);

        return redirect()->route('dashboard.commandes')->with('success', 'Commande mise à jour avec succès.');
    }
    
}
