<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;
use Illuminate\Support\Carbon;


class CommandeController extends Controller
{
    
    

    public function index(Request $request)
    {
        $query = Commande::with(['products' => fn($q) => $q->withPivot('quantity', 'price_ttc')]);

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%$search%")
                ->orWhere('firstname', 'like', "%$search%")
                ->orWhere('lastname', 'like', "%$search%");
            });
        }

        //Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Filter by date
        if ($request->filled('date_filter')) {
            $filter = $request->input('date_filter');
            switch ($filter) {
                case 'today':
                    $query->whereDate('created_at', Carbon::today());
                    break;
                case 'yesterday':
                    $query->whereDate('created_at', Carbon::yesterday());
                    break;
                case 'week':
                    $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('created_at', Carbon::now()->month);
                    break;
                case 'year':
                    $query->whereYear('created_at', Carbon::now()->year);
                    break;
            }
        }

        $commandes = $query->latest()->paginate(12);

        return view('dashboard.commande', compact('commandes'));
    }


    public function update(Request $request, $id)
    {
        $commande = Commande::with(['products', 'user'])->findOrFail($id);

        $validated = $request->validate([
            'status'    => 'nullable|string|in:en-attente,confirmee,en-preparation,en-cours-de-livraison,livree,echec-de-la-livraison,retournee,annulee,en-transit',
            'is_payed'  => 'nullable|boolean',
            'address'   => 'nullable|string|max:255',
            'city'      => 'nullable|string|max:255',
        ]);

        $oldStatus = $commande->status;
        $filtered = array_filter($validated, fn($value) => !is_null($value));
        $commande->update($filtered);
        if (
            isset($validated['status']) &&
            in_array($validated['status'], ['annulee', 'retournee']) &&
            $oldStatus !== $validated['status']
        ) {
            foreach ($commande->products as $product) {
                $product->stock += $product->pivot->quantity;
                $product->save();
            }
        }

        if (
            $commande->status === 'livree' &&
            $commande->getRawOriginal('fidelity_earned') == 0
        ) {
            $productTotal = $commande->products->sum(fn($product) =>
                $product->pivot->quantity * $product->pivot->price_ttc
            );

            $earned = round($productTotal * 0.10, 2);
            $commande->fidelity_earned = $earned;
            $commande->save();

            if ($commande->user) {
                $commande->user->increment('fidelity_credit', $earned);
            }
        }

        return redirect()->route('dashboard.commandes')->with('success', 'Commande mise à jour avec succès.');
    }

    public function destroy($id)
    {
        $commande = Commande::findOrFail($id);
        $commande->delete();

        return redirect()->route('dashboard.commandes')->with('success', 'Commande supprimée avec succès.');
    }

    public function dashboard()
    {
        $today = now()->startOfDay();

        $commandesTodayCount = Commande::whereDate('created_at', $today)->count();
        $productsInStock = \App\Models\Product::where('stock', '>', 0)->count();
        $outOfStock = \App\Models\Product::where('stock', '=', 0)->count();
        $deliveriesInProgress = Commande::whereIn('status', ['en-preparation', 'en-cours-de-livraison', 'en-transit'])->count();
        $deliveriesDone = Commande::where('status', 'livree')->count();
        $recentCommandes = Commande::latest()->take(10)->get();

        return view('dashboard.dashboard', compact(
            'commandesTodayCount',
            'productsInStock',
            'outOfStock',
            'deliveriesInProgress',
            'deliveriesDone',
            'recentCommandes'
        ));
    }
}
