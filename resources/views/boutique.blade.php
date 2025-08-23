<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique - Rose & Bouchon</title>
    <link rel="stylesheet" href="{{ asset('assets/css/boutique.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

    @include('layouts.header') 
    <div class="container">
        <header class="shop-header">
            <h1>Notre Collection</h1>
            <p>Accessoires élégants pour la conservation et dégustation du vin</p>
        </header>
        
        <button class="filter-toggle" id="filterToggle">
            <i class="fas fa-filter"></i> Filtres
        </button>
        
        <div class="shop-container">
            <form method="GET" action="{{ route('shop') }}">
                <aside class="filters" id="filters">
                    <div class="filter-section">
                        <h3 class="filter-title">Catégories</h3>
                        <div class="filter-options">
                            @foreach($categories as $category)
                                <div class="filter-option">
                                    <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                        id="cat-{{ $category->id }}"
                                        {{ in_array($category->id, request()->categories ?? []) ? 'checked' : '' }}>
                                    <label for="cat-{{ $category->id }}">{{ $category->nom }}</label>
                                    
                                    @if($category->subcategories->count() > 0)
                                        <button type="button" class="toggle-subcategories" data-target="subcat-{{ $category->id }}">
                                            <i class="fas fa-chevron-down"></i>
                                        </button>
                                    @endif

                                    @if($category->subcategories->count() > 0)
                                        <div class="subcategories" id="subcat-{{ $category->id }}">
                                            @foreach($category->subcategories as $subcategory)
                                                <div class="filter-option subcategory-option">
                                                    <input type="checkbox" name="subcategories[]" value="{{ $subcategory->id }}"
                                                        id="subcat-{{ $subcategory->id }}"
                                                        {{ in_array($subcategory->id, request()->subcategories ?? []) ? 'checked' : '' }}>
                                                    <label for="subcat-{{ $subcategory->id }}">{{ $subcategory->nom }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-section">
                        <h3 class="filter-title">Prix</h3>
                        <div class="filter-options">
                            <div class="filter-option">
                                <input type="checkbox" name="price[]" value="1" id="price-1"
                                    {{ in_array('1', request()->price ?? []) ? 'checked' : '' }}>
                                <label for="price-1">Moins de 100 Dhs</label>
                            </div>
                            <div class="filter-option">
                                <input type="checkbox" name="price[]" value="2" id="price-2"
                                    {{ in_array('2', request()->price ?? []) ? 'checked' : '' }}>
                                <label for="price-2">100 - 300 Dhs</label>
                            </div>
                            <div class="filter-option">
                                <input type="checkbox" name="price[]" value="3" id="price-3"
                                    {{ in_array('3', request()->price ?? []) ? 'checked' : '' }}>
                                <label for="price-3">Plus de 300 Dhs</label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-3">
                        Appliquer les filtres
                    </button>
                </aside>
            </form>

            <main class="products">
                @forelse($products as $product)
                    <a href="{{ route('products.show', $product->slug) }}" class="product-card-link">
                        <div class="product-card">
                            <div class="product-image">
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/300x300' }}"
                                    alt="{{ $product->nom }}">
                                
                                @if($product->is_new)
                                    <span class="product-badge">Nouveau</span>
                                @endif

                                @if($product->remise)
                                    <span class="discount-badge">-{{ $product->remise }}%</span>
                                @endif
                            </div>
                            <div class="product-details">
                                <span class="product-category">
                                    {{ $product->subcategory?->nom ?? $product->category?->nom ?? '—' }}
                                </span>
                                <h3 class="product-title">{{ $product->nom }}</h3>

                                <div class="product-price">
                                    <span class="current-price">
                                        {{ number_format($product->prix_ttc ?? $product->prix_ht, 2, ',', ' ') }} Dhs
                                    </span>

                                    @if($product->remise)
                                        <span class="original-price">
                                            {{ number_format($product->prix_ht, 2, ',', ' ') }} Dhs
                                        </span>
                                    @endif
                                </div>

                                <div class="product-stock {{ $product->stock == 0 ? 'out-of-stock' : ($product->stock <= 5 ? 'low-stock' : 'in-stock') }}">
                                    @if($product->stock == 0)
                                        <i class="fas fa-times-circle"></i> Rupture de stock
                                    @elseif($product->stock <= 5)
                                        <i class="fas fa-exclamation-circle"></i> Stock faible
                                    @else
                                        <i class="fas fa-check-circle"></i> En stock
                                    @endif
                                </div>

                                <div class="product-actions">
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary" type="submit">
                                            <i class="fas fa-shopping-cart"></i> Ajouter
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </a>
                @empty
                    <p>Aucun produit disponible pour le moment.</p>
                @endforelse
            </main>
        </div>
        
        <!-- Pagination -->
        @if ($products->lastPage() > 1)
            <ul class="pagination">
                {{-- Previous Page --}}
                <li class="page-item {{ $products->onFirstPage() ? 'disabled' : '' }}">
                    <a href="{{ $products->previousPageUrl() ?? '#' }}" class="page-link">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                </li>

                {{-- Page Numbers --}}
                @for ($i = 1; $i <= $products->lastPage(); $i++)
                    <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                        <a href="{{ $products->url($i) }}" class="page-link">{{ $i }}</a>
                    </li>
                @endfor

                {{-- Next Page --}}
                <li class="page-item {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                    <a href="{{ $products->nextPageUrl() ?? '#' }}" class="page-link">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </li>
            </ul>
        @endif
    </div>


    <script src="{{ asset('assets/js/boutique.js') }}"></script>

    @include('layouts.footer') 
</body>
</html>