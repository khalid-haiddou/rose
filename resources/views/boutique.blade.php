<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique - Rose & Bouchon</title>
    <style>
        :root {
            --navy: #000075;
            --burgundy: #960018;
            --dark: #121212;
            --ivory: #FEFEFA;
            --gold: #C4A267;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Cormorant Garamond', serif;
            background-color: var(--ivory);
            background-image: linear-gradient(rgba(254, 254, 250, 0.92), rgba(254, 254, 250, 0.94)), 
                              url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=2000');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: var(--dark);
            line-height: 1.6;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .shop-header {
            text-align: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .shop-header h1 {
            color: var(--navy);
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            font-variant: small-caps;
        }
        
        .shop-header p {
            color: var(--burgundy);
            font-style: italic;
            font-size: 1.1rem;
            letter-spacing: 0.3px;
        }
        
        .shop-container {
            display: flex;
            gap: 2rem;
            position: relative;
        }
        
        /* Filters Section */
        .filters {
            width: 280px;
            flex-shrink: 0;
            background-color: var(--ivory);
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.06);
            border-top: 4px solid var(--burgundy);
            position: sticky;
            top: 20px;
            overflow-y: auto;
            max-height: calc(100vh - 40px);
            backdrop-filter: blur(4px);
            border: 1px solid rgba(150, 0, 24, 0.1);
            height: fit-content;
            align-self: flex-start;
        }
        
        .filters::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--navy), var(--burgundy));
            z-index: 2;
        }
        
        .filter-section {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px dashed rgba(0, 0, 117, 0.1);
        }
        
        .filter-section:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .filter-title {
            color: var(--navy);
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }
        
        .filter-options {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .filter-option {
            display: flex;
            align-items: center;
            position: relative;
        }
        
        .filter-option input {
            margin-right: 0.75rem;
            accent-color: var(--burgundy);
        }
        
        .filter-option label {
            color: var(--dark);
            font-size: 0.95rem;
            cursor: pointer;
        }
        
        .filter-option .count {
            margin-left: auto;
            color: var(--burgundy);
            font-size: 0.85rem;
            opacity: 0.8;
        }
        
        /* Subcategories styles */
        .toggle-subcategories {
            background: none;
            border: none;
            color: var(--burgundy);
            cursor: pointer;
            margin-left: auto;
            padding: 0 0.5rem;
            transition: transform 0.3s ease;
        }
        
        .toggle-subcategories.active {
            transform: rotate(180deg);
        }
        
        .subcategories {
            padding-left: 1.5rem;
            margin-top: 0.5rem;
            border-left: 1px solid rgba(150, 0, 24, 0.2);
            display: none; /* Hidden by default */
        }
        
        .subcategories.active {
            display: block; /* Show when active */
        }
        
        .subcategory-option {
            margin-bottom: 0.5rem;
        }
        
        .subcategory-option:last-child {
            margin-bottom: 0;
        }

        /* Products Grid */
        .products {
            flex: 1;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        
        .product-card {
            background-color: var(--ivory);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 1px solid rgba(0, 0, 117, 0.1);
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            border-color: rgba(150, 0, 24, 0.2);
        }
        
        .product-image {
            width: 100%;
            aspect-ratio: 1/1;
            overflow: hidden;
            position: relative;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .product-card:hover .product-image img {
            transform: scale(1.05);
        }
        
        .product-badge {
            position: absolute;
            top: 10px;
            left: 10px;
            background-color: var(--burgundy);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
            z-index: 2;
        }
        
        .discount-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--burgundy);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            font-size: 0.8rem;
            font-weight: 500;
            z-index: 2;
        }
        
        .product-details {
            padding: 1.25rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .product-category {
            color: var(--burgundy);
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .product-title {
            color: var(--navy);
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            flex: 1;
        }
        
        .product-price {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }
        
        .current-price {
            color: var(--burgundy);
            font-weight: 600;
            font-size: 1.2rem;
        }
        
        .original-price {
            color: var(--dark);
            opacity: 0.7;
            text-decoration: line-through;
            font-size: 1rem;
        }
        
        .product-stock {
            display: flex;
            align-items: center;
            margin-bottom: 1.25rem;
            font-size: 0.9rem;
        }
        
        .in-stock {
            color: #2e7d32;
        }
        
        .out-of-stock {
            color: #c62828;
        }
        
        .product-stock svg {
            margin-right: 0.5rem;
        }
        
        .product-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: auto;
        }
        
        .btn {
            flex: 1;
            padding: 0.75rem;
            border: none;
            border-radius: 6px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.95rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .btn-primary {
            background-color: var(--navy);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--navy);
        }
        
        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--burgundy);
            color: var(--burgundy);
        }
        
        .btn-outline:hover {
            background-color: rgba(0, 0, 117, 0.05);
        }
        
        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
            gap: 0.5rem;
        }
        
        .page-item {
            list-style: none;
        }
        
        .page-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 6px;
            background-color: var(--ivory);
            color: var(--navy);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            border: 1px solid rgba(0, 0, 117, 0.1);
        }
        
        .page-link:hover {
            background-color: rgba(0, 0, 117, 0.05);
        }
        
        .page-link.active {
            background-color: var(--burgundy);
            color: white;
            border-color: var(--burgundy);
        }
        
        .page-link.disabled {
            opacity: 0.5;
            pointer-events: none;
        }
        
        /* Mobile Styles */
        @media (max-width: 992px) {
            .shop-container {
                flex-direction: column;
            }
            
            .filters {
                width: 100%;
                margin-bottom: 1.5rem;
                position: static;
                max-height: none;
            }
            
            .products {
                grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            }
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .shop-header h1 {
                font-size: 2rem;
            }
            
            .shop-header p {
                font-size: 1rem;
            }
            
            .products {
                grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
                gap: 1rem;
            }
            
            .product-details {
                padding: 1rem;
            }
            
            .product-actions {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .btn {
                width: 100%;
            }
            
            .pagination {
                flex-wrap: wrap;
            }
        }
        
        @media (max-width: 576px) {
            .products {
                grid-template-columns: 1fr;
            }
            
            .filter-title {
                font-size: 1.1rem;
            }
        }
        
        /* Filter Toggle for Mobile */
        .filter-toggle {
            display: none;
            background-color: var(--burgundy);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            cursor: pointer;
            width: 100%;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
        }
        
        @media (max-width: 992px) {
            .filter-toggle {
                display: flex;
            }
            
            .filters {
                display: none;
            }
            
            .filters.active {
                display: block;
            }
        }
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .product-card {
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }
        
        .product-card:nth-child(1) { animation-delay: 0.1s; }
        .product-card:nth-child(2) { animation-delay: 0.2s; }
        .product-card:nth-child(3) { animation-delay: 0.3s; }
        .product-card:nth-child(4) { animation-delay: 0.4s; }
        .product-card:nth-child(5) { animation-delay: 0.5s; }
        .product-card:nth-child(6) { animation-delay: 0.6s; }

        .product-card-link {
            text-decoration: none;
            color: inherit;
        }

    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
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
                        <h3 class="filter-title">Disponibilité</h3>
                        <div class="filter-options">
                            <div class="filter-option">
                                <input type="checkbox" name="stock[]" value="in" id="stock-in"
                                    {{ in_array('in', request()->stock ?? []) ? 'checked' : '' }}>
                                <label for="stock-in">En stock</label>
                            </div>
                            <div class="filter-option">
                                <input type="checkbox" name="stock[]" value="out" id="stock-out"
                                    {{ in_array('out', request()->stock ?? []) ? 'checked' : '' }}>
                                <label for="stock-out">En rupture</label>
                            </div>
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
                                    <button class="btn btn-outline" type="button">
                                        <i class="far fa-heart"></i>
                                    </button>
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

    <script>
        // Toggle filters on mobile
        document.getElementById('filterToggle').addEventListener('click', function() {
            const filters = document.getElementById('filters');
            filters.classList.toggle('active');
        });

        // Toggle subcategories when clicking on the category label or toggle button
        document.querySelectorAll('.filter-option label[for^="cat-"], .toggle-subcategories').forEach(element => {
            element.addEventListener('click', function(e) {
                // If clicking the toggle button, prevent the checkbox from being toggled
                if (this.classList.contains('toggle-subcategories')) {
                    e.stopPropagation();
                }
                
                const filterOption = this.closest('.filter-option');
                const subcategories = filterOption.querySelector('.subcategories');
                const toggleButton = filterOption.querySelector('.toggle-subcategories');
                
                if (subcategories) {
                    subcategories.classList.toggle('active');
                    
                    if (toggleButton) {
                        toggleButton.classList.toggle('active');
                    }
                }
            });
        });

        // Show subcategories if any are checked on page load
        document.querySelectorAll('.subcategories').forEach(subcat => {
            const hasChecked = subcat.querySelector('input[type="checkbox"]:checked');
            if (hasChecked) {
                subcat.classList.add('active');
                const toggleButton = subcat.closest('.filter-option').querySelector('.toggle-subcategories');
                if (toggleButton) {
                    toggleButton.classList.add('active');
                }
            }
        });

        // If any subcategory is checked, ensure its parent category is checked
        document.querySelectorAll('input[name="subcategories[]"]').forEach(input => {
            if (input.checked) {
                const parentCategory = input.closest('.filter-option').querySelector('input[name="categories[]"]');
                if (parentCategory) {
                    parentCategory.checked = true;
                }
            }
        });
    </script>
</body>
</html>