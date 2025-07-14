<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commande;

class CommandeController extends Controller
{
    
    public function index()
    {
        $commandes = Commande::with(['products' => function($query) {
            $query->withPivot('quantity', 'price_ttc'); // Add this to include pivot data
        }])->latest()->get();

        return view('dashboard.commande', compact('commandes'));
    }
    public function update(Request $request, $id)
    {
        $commande = Commande::with('products')->findOrFail($id);

        $validated = $request->validate([
            'status'    => 'nullable|string|in:en-attente,confirmee,en-preparation,en-cours-de-livraison,livree,echec-de-la-livraison,retournee,annulee,en-transit',
            'is_payed'  => 'nullable|boolean',
            'address'   => 'nullable|string|max:255',
            'city'      => 'nullable|string|max:255',
        ]);

        $oldStatus = $commande->status;

        // Filter only the provided fields
        $filtered = array_filter($validated, fn($value) => !is_null($value));

        $commande->update($filtered);

        // 👉 If the status changed to 'annulee' or 'retournee', restore stock
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

        // ✅ Fetch 5 latest commandes
        $recentCommandes = Commande::latest()->take(9)->get();

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
