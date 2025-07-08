<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function index()
{
    $cart = session()->get('cart', []);

    $subtotal = collect($cart)->sum(fn($item) => $item['product']->prix_ttc * $item['quantity']);

    // Free shipping if subtotal >= 499
    $shipping = $subtotal >= 499 ? 0 : 40;

    $total = $subtotal + $shipping;

    return view('panier', [
        'cart' => $cart,
        'subtotal' => $subtotal,
        'shipping' => $shipping,
        'total' => $total
    ]);
}

    public function add(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->input('quantity', 1);
        } else {
            $cart[$product->id] = [
                'product' => $product,
                'quantity' => $request->input('quantity', 1)
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.index')->with('success', 'Produit ajouté au panier.');
    }

    public function update(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] = $request->input('quantity');
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index');
    }

    public function remove(Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Produit supprimé du panier.');
    }
    public function ajaxUpdate(Request $request, $id): JsonResponse
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);

            $subtotal = collect($cart)->sum(fn($item) => $item['product']->prix_ttc * $item['quantity']);
            $shipping = $subtotal >= 499 ? 0 : 40;
            $total = $subtotal + $shipping;

            return response()->json([
                'status' => 'success',
                'message' => 'Quantité mise à jour.',
                'item_total' => number_format($cart[$id]['product']->prix_ttc * $request->quantity, 2, ',', ' '),
                'subtotal' => number_format($subtotal, 2, ',', ' '),
                'shipping' => $shipping == 0 ? 'Gratuite' : number_format($shipping, 2, ',', ' '),
                'total' => number_format($total, 2, ',', ' ')
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Produit non trouvé.'], 404);
    }


}
