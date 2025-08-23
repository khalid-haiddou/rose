<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function home()
    {

        $bestSellers = DB::table('commande_product')
            ->select('product_id', DB::raw('SUM(quantity) as total_sold'))
            ->groupBy('product_id')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->pluck('product_id');

        $products = Product::with('category')->whereIn('id', $bestSellers)->get();


        $promotionsAndPacks = $this->getPromotionsPacksProducts();

        return view('home', [
            'bestSellers' => $products,
            'promotionsAndPacks' => $promotionsAndPacks,
        ]);
    }

    private function getPromotionsPacksProducts()
    {
        $products = Product::with('category')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('categories.nom', 'Promotions et Packs')
            ->select('products.*')
            ->orderByDesc('products.created_at')
            ->limit(10)
            ->get();

        // Add sold percentage and reviews count to each product
        foreach ($products as $product) {
            // Calculate total sold
            $totalSold = DB::table('commande_product')
                ->where('product_id', $product->id)
                ->sum('quantity');
            
            // Calculate reviews count and average rating
            $reviewsData = null;
            try {
                $reviewsData = DB::table('reviews')
                    ->where('product_id', $product->id)
                    ->whereNotNull('rating') // Only count reviews with ratings
                    ->selectRaw('COUNT(*) as count, AVG(CAST(rating as DECIMAL(3,2))) as avg_rating')
                    ->first();
            } catch (\Exception $e) {
                // Reviews table might not exist yet
                $reviewsData = (object) ['count' => 0, 'avg_rating' => null];
            }
            
            // Calculate percentage based on stock or set a target
            $target = $product->stock ?? 100;
            $product->sold_percentage = $target > 0 ? min(round(($totalSold / $target) * 100), 100) : 0;
            
            // Add reviews data
            $product->reviews_count = $reviewsData->count ?? 0;
            $product->rating = $reviewsData->avg_rating ? round($reviewsData->avg_rating, 1) : null;
            
            // Add rating statistics for better display
            if ($product->reviews_count > 0) {
                // Get rating distribution
                try {
                    $ratingDistribution = DB::table('reviews')
                        ->where('product_id', $product->id)
                        ->whereNotNull('rating')
                        ->selectRaw('rating, COUNT(*) as count')
                        ->groupBy('rating')
                        ->orderBy('rating', 'desc')
                        ->get();
                    
                    $product->rating_distribution = $ratingDistribution;
                } catch (\Exception $e) {
                    $product->rating_distribution = collect();
                }
            }
        }

        return $products;
    }
}