<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

use DB;
use Carbon\Carbon;

class StatistiqueController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('periode', 'month');
        $now = Carbon::now();
        
        switch ($filter) {
            case 'last_month':
                $startDate = $now->copy()->subMonth()->startOfMonth();
                $endDate = $now->copy()->subMonth()->endOfMonth();
                break;
            case 'year':
                $startDate = $now->copy()->startOfYear();
                $endDate = $now->copy()->endOfYear();
                break;
            case 'month':
            default:
                $startDate = $now->copy()->startOfMonth();
                $endDate = $now->copy()->endOfMonth();
                break;
        }

        $excludedStatuses = ['en-attente', 'echec-de-la-livraison', 'annulee'];

        $commandes = Commande::with('products')
            ->whereNotIn('status', $excludedStatuses)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->get();

        $chiffreAffaires = $commandes->sum('total');
        $commandesCount = $commandes->count();
        $clients = User::whereBetween('created_at', [$startDate, $endDate])->count();
        $livrees = $commandes->where('status', 'livree')->count();
        $panierMoyen = $commandesCount > 0 ? $chiffreAffaires / $commandesCount : 0;

        // Best Seller
        $productCounts = [];
        foreach ($commandes as $commande) {
            foreach ($commande->products as $product) {
                $productCounts[$product->id] = ($productCounts[$product->id] ?? 0) + $product->pivot->quantity;
            }
        }

        $bestSellerId = collect($productCounts)->sortDesc()->keys()->first();
        $bestSeller = $bestSellerId ? Product::find($bestSellerId)?->nom : 'Aucun';

        // Monthly Sales Chart - Fixed query
        $monthlySalesRaw = Commande::select(
                DB::raw("DATE_FORMAT(created_at, '%b %Y') as month"),
                DB::raw("DATE_FORMAT(created_at, '%Y-%m-01') as month_date"),
                DB::raw("SUM(total) as total")
            )
            ->whereNotIn('status', $excludedStatuses)
            ->whereBetween('created_at', [Carbon::now()->subMonths(11)->startOfMonth(), Carbon::now()])
            ->groupBy('month_date', 'month') // Include both in GROUP BY
            ->orderBy('month_date')
            ->get();

        $monthlyLabels = $monthlySalesRaw->pluck('month');
        $monthlyValues = $monthlySalesRaw->pluck('total');

        // Top Categories - Fixed query
        $topCategoriesRaw = DB::table('commande_product')
            ->join('products', 'commande_product.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->join('commandes', 'commande_product.commande_id', '=', 'commandes.id')
            ->whereNotIn('commandes.status', $excludedStatuses)
            ->whereBetween('commandes.created_at', [$startDate, $endDate])
            ->select('categories.id', 'categories.nom', DB::raw('SUM(commande_product.quantity) as total'))
            ->groupBy('categories.id', 'categories.nom') // Include primary key in GROUP BY
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        $topCategoriesLabels = $topCategoriesRaw->pluck('nom');
        $topCategoriesValues = $topCategoriesRaw->pluck('total');

        return view('dashboard.Statistique', [
            'filter' => $filter,
            'chiffreAffaires' => $chiffreAffaires,
            'commandesCount' => $commandesCount,
            'clients' => $clients,
            'livrees' => $livrees,
            'panierMoyen' => $panierMoyen,
            'bestSeller' => $bestSeller,
            'monthlySales' => [
                'labels' => $monthlyLabels,
                'data' => $monthlyValues,
            ],
            'topCategories' => [
                'labels' => $topCategoriesLabels,
                'data' => $topCategoriesValues,
            ],
        ]);
    }
}