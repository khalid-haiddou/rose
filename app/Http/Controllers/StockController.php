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
}
