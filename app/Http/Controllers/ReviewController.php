<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'user_name' => 'required|string|max:255',
            'comment' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $product->reviews()->create($request->only('user_name', 'comment', 'rating'));

        return redirect()->route('products.show', $product->slug)
            ->with('success', 'Merci pour votre avis !');
    }
}
