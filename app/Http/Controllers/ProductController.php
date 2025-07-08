<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\ProductCharacteristic;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Show all products.
     */
    public function index(Request $request)
    {
        $query = Product::with('category', 'subcategory', 'characteristics');

        // Filtrer par catégorie
        if ($request->filled('category_id')) {
            $query->where(function ($q) use ($request) {
                $q->where('category_id', $request->category_id)
                ->orWhere('subcategory_id', $request->category_id);
            });
        }

        // Filtrer par stock
        if ($request->filled('stock_status')) {
            if ($request->stock_status === 'in-stock') {
                $query->where('stock', '>', 5);
            } elseif ($request->stock_status === 'low-stock') {
                $query->whereBetween('stock', [1, 5]);
            } elseif ($request->stock_status === 'out-of-stock') {
                $query->where('stock', '=', 0);
            }
        }

        $products = $query->latest()->paginate(10);
        $categories = Category::whereNull('parent_id')->with('children')->get();

        return view('dashboard.produit', compact('products', 'categories'));
    }

    /**
     * Show the create form.
     */
    public function create()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('dashboard.produit-create', compact('categories'));
    }

    /**
     * Store a new product.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:products,slug',
            'description' => 'nullable|string',
            'description_longue' => 'nullable|string',
            'prix_ht' => 'required|numeric',
            'prix_ttc' => 'nullable|numeric',
            'stock' => 'required|integer',
            'reference' => 'required|string|unique:products,reference',
            'is_new' => 'boolean',
            'remise' => 'nullable|integer|min:0|max:100',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'characteristics' => 'array',
            'characteristics.*.label' => 'required_with:characteristics.*.value|string|max:255',
            'characteristics.*.value' => 'required_with:characteristics.*.label|string|max:255',
        ]);

        $data = $request->only([
            'nom', 'slug', 'description', 'description_longue', 'prix_ht', 'prix_ttc',
            'stock', 'reference', 'is_new', 'remise', 'category_id', 'subcategory_id'
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['nom']);

        // Save main image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);

        // Save gallery images
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('products/gallery', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        // Save characteristics
        if ($request->has('characteristics')) {
            foreach ($request->characteristics as $char) {
                if (!empty($char['label']) && !empty($char['value'])) {
                    $product->characteristics()->create([
                        'label' => $char['label'],
                        'value' => $char['value'],
                    ]);
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Produit ajouté avec succès.');
    }

    /**
 * Show the edit form.
 */
    public function edit(Product $product)
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return view('dashboard.produit', compact('product', 'categories'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:products,slug,'.$product->id,
            'description' => 'nullable|string',
            'description_longue' => 'nullable|string',
            'prix_ht' => 'required|numeric',
            'prix_ttc' => 'nullable|numeric',
            'stock' => 'required|integer',
            'reference' => 'required|string|unique:products,reference,'.$product->id,
            'is_new' => 'boolean',
            'remise' => 'nullable|integer|min:0|max:100',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'gallery.*' => 'nullable|image|max:2048',
            'characteristics' => 'array',
            'characteristics.*.label' => 'required_with:characteristics.*.value|string|max:255',
            'characteristics.*.value' => 'required_with:characteristics.*.label|string|max:255',
        ]);

        $data = $request->only([
            'nom', 'slug', 'description', 'description_longue', 'prix_ht', 'prix_ttc',
            'stock', 'reference', 'is_new', 'remise', 'category_id', 'subcategory_id'
        ]);

        $data['slug'] = $data['slug'] ?? Str::slug($data['nom']);

        // Update main image
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        // Update gallery images
        if ($request->hasFile('gallery')) {
            // Delete old gallery images if needed
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->image_path);
                $image->delete();
            }
            
            // Add new gallery images
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('products/gallery', 'public');
                $product->images()->create(['image_path' => $path]);
            }
        }

        // Update characteristics
        $product->characteristics()->delete(); // Remove old characteristics
        if ($request->has('characteristics')) {
            foreach ($request->characteristics as $char) {
                if (!empty($char['label']) && !empty($char['value'])) {
                    $product->characteristics()->create([
                        'label' => $char['label'],
                        'value' => $char['value'],
                    ]);
                }
            }
        }

        return redirect()->route('products.index')->with('success', 'Produit mis à jour avec succès.');
    }

    public function destroy(Product $product)
    {
        // Supprimer l'image principale si elle existe
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        // Supprimer les images de la galerie
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
            $image->delete();
        }

        // Supprimer les caractéristiques
        $product->characteristics()->delete();

        // Supprimer le produit
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès.');
    }

    public function shop(Request $request)
    {
        $categories = Category::whereNull('parent_id')->with('subcategories')->get();

        $products = Product::with('category', 'subcategory')
            ->when($request->categories, function ($query) use ($request) {
                $query->whereIn('category_id', $request->categories);
            })
            ->when($request->subcategories, function ($query) use ($request) {
                $query->whereIn('subcategory_id', $request->subcategories);
            })
            ->when($request->stock, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    if (in_array('in', $request->stock)) {
                        $q->orWhere('stock', '>', 0);
                    }
                    if (in_array('out', $request->stock)) {
                        $q->orWhere('stock', '<=', 0);
                    }
                });
            })
            ->when($request->price, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    foreach ($request->price as $priceRange) {
                        if ($priceRange == '1') {
                            $q->orWhere('prix_ttc', '<', 100);
                        } elseif ($priceRange == '2') {
                            $q->orWhereBetween('prix_ttc', [100, 300]);
                        } elseif ($priceRange == '3') {
                            $q->orWhere('prix_ttc', '>', 300);
                        }
                    }
                });
            })
            ->paginate(10);

        return view('boutique', compact('categories', 'products'));
    }
    public function show(Product $product)
    {
        $product->load('images', 'characteristics', 'category', 'subcategory', 'reviews');

        // Related products (same category, exclude current product)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('single-product', compact('product', 'relatedProducts'));
    }



}
