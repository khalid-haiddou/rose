<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'subcategory'])->get();
        return view('dashboard.stock', compact('products'));
    }


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->stock = $request->input('stock');
        $product->save();

        return redirect()->route('stock.index')->with('success', 'Stock mis à jour.');
    }
}
