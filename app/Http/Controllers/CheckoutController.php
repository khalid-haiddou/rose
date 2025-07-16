<?php

namespace App\Http\Controllers;

use App\Models\Commande;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function show()
    {
        $cart = session()->get('cart', []);
        $errors = [];

        foreach ($cart as $item) {
            $product = Product::find($item['product']->id);

            if (!$product || $product->stock < $item['quantity']) {
                $errors[] = "Le produit « {$item['product']->nom} » n'a plus assez de stock. Stock disponible : {$product->stock}";
            }
        }

        if (!empty($errors)) {
            return redirect()->route('cart.index')->withErrors($errors);
        }

        $subtotal = collect($cart)->sum(fn($item) => $item['product']->prix_ttc * $item['quantity']);
        $shipping = $subtotal >= 499 ? 0 : 40;
        $total = $subtotal + $shipping;

        // ✅ Récupérer le crédit fidélité si l'utilisateur est connecté
        $fidelityCredit = auth()->check() ? auth()->user()->fidelity_credit : 0;

        return view('checkout', compact('cart', 'subtotal', 'shipping', 'total', 'fidelityCredit'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'firstname'         => 'required|string|max:255',
            'lastname'          => 'required|string|max:255',
            'email'             => $user ? 'nullable|email' : 'required|email',
            'phone'             => 'required|string|max:20',
            'address'           => 'required|string|max:255',
            'city'              => 'required|string|max:255',
            'postcode'          => 'nullable|string|max:20',
            'shipping_method'   => 'required|string',
            'payment_method'    => 'required|in:COD,CMI',
            'terms'             => 'accepted',
            'cashback'          => 'nullable|numeric|min:0'
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Votre panier est vide.');
        }

        foreach ($cart as $item) {
            $product = Product::find($item['product']->id);
            if (!$product || $product->stock < $item['quantity']) {
                return redirect()->route('cart.index')->with('error', "Le produit « {$item['product']->nom} » n'a plus assez de stock. Stock disponible : {$product->stock}");
            }
        }

        // Fidelity logic only for logged-in users
        $availableCredit = $user?->fidelity_credit ?? 0;
        $requestedCashback = (float) $request->input('cashback', 0);
        $cashbackUsed = min($requestedCashback, $availableCredit);

        $subtotal = collect($cart)->sum(fn($item) => $item['product']->prix_ttc * $item['quantity']);
        $shipping = $subtotal >= 499 ? 0 : 40;
        $total = $subtotal + $shipping - min($cashbackUsed, $subtotal);

        // Generate unique order number
        $year = now()->year;
        do {
            $random = str_pad(random_int(1, 9999), 4, '0', STR_PAD_LEFT);
            $orderNumber = "RB-$year-$random";
        } while (Commande::where('order_number', $orderNumber)->exists());

        $commande = Commande::create([
            'order_number'     => $orderNumber,
            'user_id'          => $user?->id,
            'email'            => $user?->email ?? $validated['email'],
            'firstname'        => $validated['firstname'],
            'lastname'         => $validated['lastname'],
            'phone'            => $validated['phone'],
            'address'          => $validated['address'],
            'city'             => $validated['city'],
            'postcode'         => $validated['postcode'],
            'shipping_method'  => $validated['shipping_method'],
            'payment_method'   => $validated['payment_method'],
            'shipping_price'   => $shipping,
            'total'            => $total,
            'is_payed'         => $validated['payment_method'] === 'CMI',
            'fidelity_used'    => $cashbackUsed,
            'fidelity_earned'  => 0, // Will be updated after delivery
        ]);

        foreach ($cart as $item) {
            $product = Product::find($item['product']->id);
            $quantity = $item['quantity'];

            $commande->products()->attach($product->id, [
                'quantity'  => $quantity,
                'price_ttc' => $product->prix_ttc,
            ]);

            $product->decrement('stock', $quantity);
        }

        if ($user && $cashbackUsed > 0) {
            $user->decrement('fidelity_credit', $cashbackUsed);
        }

        Mail::to($commande->email)->send(new OrderConfirmation($commande));
        session()->forget('cart');

        return redirect()->route('merci')
            ->with('success', 'Commande passée avec succès !')
            ->with('order_number', $orderNumber)
            ->with('order_email', $commande->email);
    }

}