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

        // ✅ Check if all items have sufficient stock
        foreach ($cart as $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];

            if ($product->stock < $quantity) {
                return redirect()->route('cart.index')->with('error', "Le produit \"{$product->nom}\" n'a plus assez de stock. Stock disponible : {$product->stock}");
            }
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

        foreach ($cart as $item) {
            $product = $item['product'];
            $quantity = $item['quantity'];

            // Attach product with pivot data
            $commande->products()->attach($product->id, [
                'quantity'   => $quantity,
                'price_ttc'  => $product->prix_ttc,
            ]);

            // ✅ Decrease product stock
            $product->decrement('stock', $quantity);
        }

        session()->forget('cart');

        return redirect()->route('merci')
            ->with('success', 'Commande passée avec succès !')
            ->with('order_number', $orderNumber)
            ->with('order_email', $validated['email']);
    }

    
}
