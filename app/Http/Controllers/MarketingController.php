<?php

namespace App\Http\Controllers;

use App\Mail\MarketingEmail;
use App\Models\Category;
use App\Models\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MarketingController extends Controller
{
    public function index(Request $request)
    {
        $categoryId = $request->input('category_id');
        $categories = Category::all();

        $commandes = Commande::with('products.category')
            ->when($categoryId && $categoryId !== 'all', function ($query) use ($categoryId) {
                $query->whereHas('products', function ($q) use ($categoryId) {
                    $q->where('category_id', $categoryId);
                });
            })
            ->get();

        $clients = [];

        foreach ($commandes as $commande) {
            $email = $commande->email;
            if (!isset($clients[$email])) {
                $clients[$email] = [
                    'firstname' => $commande->firstname ?? '',
                    'lastname' => $commande->lastname ?? '',
                    'email' => $commande->email,
                    'categories' => [],
                ];
            }

            foreach ($commande->products as $product) {
                if ($product->category && !in_array($product->category->nom, $clients[$email]['categories'])) {
                    $clients[$email]['categories'][] = $product->category->nom;
                }
            }
        }

        return view('dashboard.marketing', [
            'categories' => $categories,
            'clients' => array_values($clients), // reset index
        ]);
    }

    public function send(Request $request)
    {
        $emails = $request->input('client_emails', []);

        $commandes = Commande::with('products.category')
            ->whereIn('email', $emails)
            ->get();

        $clients = [];

        foreach ($commandes as $commande) {
            $email = $commande->email;
            if (!isset($clients[$email])) {
                $clients[$email] = [
                    'firstname' => $commande->firstname ?? '',
                    'lastname' => $commande->lastname ?? '',
                    'categories' => [],
                ];
            }

            foreach ($commande->products as $product) {
                if ($product->category && !in_array($product->category->nom, $clients[$email]['categories'])) {
                    $clients[$email]['categories'][] = $product->category->nom;
                }
            }
        }

        foreach ($clients as $email => $data) {
            Mail::to($email)->send(new MarketingEmail(
                $data['firstname'],
                $data['lastname'],
                $data['categories']
            ));
        }

        return back()->with('success', 'Emails envoyés avec succès !');
    }
}
