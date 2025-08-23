<?php
namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
{
    $query = Product::with(['category', 'subcategory']);

    
    if ($request->filled('category_id')) {
        $query->where(function ($q) use ($request) {
            $q->where('category_id', $request->category_id)
              ->orWhere('subcategory_id', $request->category_id);
        });
    }

    if ($request->filled('stock_status')) {
        if ($request->stock_status === 'in-stock') {
            $query->where('stock', '>', 5);
        } elseif ($request->stock_status === 'low-stock') {
            $query->whereBetween('stock', [1, 5]);
        } elseif ($request->stock_status === 'out-of-stock') {
            $query->where('stock', '<=', 0);
        }
    }

    $products = $query->paginate(12)->withQueryString(); 

    $categories = \App\Models\Category::with('children')->get();

    return view('dashboard.stock', compact('products', 'categories'));
}


    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->stock = $request->input('stock');
        $product->save();

        return redirect()->route('stock.index')->with('success', 'Stock mis à jour.');
    }
}
