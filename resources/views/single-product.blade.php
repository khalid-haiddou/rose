<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thermomètre à Vin Élégant - Rose & Bouchon</title>
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
            color: var(--dark);
            background-image: linear-gradient(rgba(254, 254, 250, 0.92), rgba(254, 254, 250, 0.94)), 
                              url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=2000');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        
        .product-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
            margin-bottom: 60px;
        }
        
        .product-gallery {
            position: relative;
        }
        
        .main-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .sale-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: var(--burgundy);
            color: white;
            padding: 8px 12px;
            border-radius: 4px;
            font-weight: 600;
            font-size: 0.9rem;
            z-index: 2;
        }
        
        .thumbnail-container {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .thumbnail {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            cursor: pointer;
            border: 1px solid rgba(0, 0, 117, 0.1);
            transition: all 0.3s ease;
        }
        
        .thumbnail:hover {
            border-color: var(--burgundy);
            transform: translateY(-3px);
        }
        
        .product-details {
            padding: 20px;
        }
        
        .product-title {
            color: var(--navy);
            font-size: 2.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            letter-spacing: 0.5px;
        }
        
        .product-subtitle {
            color: var(--burgundy);
            font-style: italic;
            font-size: 1.2rem;
            margin-bottom: 20px;
        }
        
        .price-container {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .product-price {
            font-size: 1.8rem;
            color: var(--burgundy);
            font-weight: 600;
        }
        
        .regular-price {
            font-size: 1.4rem;
            color: var(--dark);
            text-decoration: line-through;
            opacity: 0.7;
        }
        
        .product-description {
            line-height: 1.8;
            margin-bottom: 30px;
            font-size: 1.1rem;
        }
        
        .product-meta {
            margin-bottom: 30px;
        }
        
        .meta-item {
            display: flex;
            margin-bottom: 10px;
            font-size: 1rem;
        }
        
        .meta-label {
            font-weight: 500;
            min-width: 120px;
            color: var(--navy);
        }
        
        .meta-value {
            color: var(--dark);
        }
        
        .divider {
            height: 1px;
            background-color: rgba(150, 0, 24, 0.1);
            margin: 30px 0;
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .quantity-btn {
            width: 40px;
            height: 40px;
            background-color: rgba(150, 0, 24, 0.1);
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .quantity-btn:hover {
            background-color: rgba(150, 0, 24, 0.2);
        }
        
        .quantity-input {
            width: 60px;
            height: 40px;
            text-align: center;
            border: 1px solid rgba(0, 0, 117, 0.1);
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
        }
        
        .btn-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }
        
        .btn {
            padding: 14px 30px;
            background-color: var(--navy);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            letter-spacing: 0.5px;
            font-weight: 500;
            font-family: 'Cormorant Garamond', serif;
            flex: 1;
            min-width: 150px;
        }
        
        .btn:hover {
            background-color: #00005a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 117, 0.2);
        }
        
        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--navy);
            color: var(--navy);
            padding: 12px 20px;
            font-size: 1rem;
        }
        
        .btn-outline:hover {
            background-color: rgba(0, 0, 117, 0.05);
        }
        
        .product-tabs {
            margin-top: 60px;
        }
        
        .tab-header {
            display: flex;
            border-bottom: 1px solid rgba(150, 0, 24, 0.1);
            margin-bottom: 30px;
        }
        
        .tab-btn {
            padding: 12px 25px;
            background: none;
            border: none;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 500;
            color: var(--navy);
            cursor: pointer;
            position: relative;
        }
        
        .tab-btn.active {
            color: var(--burgundy);
        }
        
        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: var(--burgundy);
        }
        
        .tab-content {
            display: none;
            line-height: 1.8;
            font-size: 1.05rem;
        }
        
        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }
        
        .related-products {
            margin-top: 80px;
        }
        
        .section-title {
            color: var(--navy);
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 30px;
            text-align: center;
            letter-spacing: 0.5px;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 2px;
            background-color: var(--burgundy);
        }
        
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 30px;
        }
        
        .product-card {
            background-color: var(--ivory);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            border: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }
        
        .product-card-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .product-card-body {
            padding: 20px;
        }
        
        .product-card-title {
            color: var(--navy);
            font-size: 1.2rem;
            font-weight: 500;
            margin-bottom: 10px;
        }
        
        .product-card-price {
            color: var(--burgundy);
            font-weight: 500;
        }
        
        /* Review Form Styles */
        .review-form {
            background-color: rgba(254, 254, 250, 0.8);
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(150, 0, 24, 0.1);
            margin-top: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--navy);
        }
        
        .form-group input[type="text"],
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid rgba(0, 0, 117, 0.2);
            border-radius: 4px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-group input[type="text"]:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--burgundy);
            outline: none;
            box-shadow: 0 0 0 2px rgba(150, 0, 24, 0.1);
        }
        
        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .btn-primary {
            background-color: var(--burgundy);
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background-color: #7a0014;
        }
        
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        
        .alert-success {
            background-color: rgba(40, 167, 69, 0.2);
            color: #28a745;
            border: 1px solid rgba(40, 167, 69, 0.3);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @media (max-width: 992px) {
            .product-container {
                grid-template-columns: 1fr;
            }
            
            .main-image {
                height: 400px;
            }
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 20px 15px;
            }
            
            .product-title {
                font-size: 1.8rem;
            }
            
            .tab-header {
                flex-wrap: wrap;
            }
            
            .tab-btn {
                padding: 10px 15px;
                font-size: 1rem;
            }
            
            .btn-group {
                flex-direction: row;
            }
            
            .btn {
                width: auto;
                margin-bottom: 0;
            }
            
            .review-form {
                padding: 20px;
            }
        }
        
        @media (max-width: 480px) {
            .btn {
                padding: 12px 20px;
                font-size: 1rem;
            }
            
            .meta-item {
                flex-direction: column;
            }
            
            .meta-label {
                margin-bottom: 5px;
            }
            
            .review-form {
                padding: 15px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Your header would go here -->

    <div class="container">
        <div class="product-container">
            <div class="product-gallery">
                @if($product->remise)
                    <span class="sale-badge">-{{ $product->remise }}%</span>
                @endif

                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x600' }}"
                    alt="{{ $product->nom }}" class="main-image" id="mainImage">

                @if($product->images->count())
                    <div class="thumbnail-container">
                        @foreach($product->images as $img)
                            <img src="{{ asset('storage/' . $img->image_path) }}"
                                class="thumbnail" onclick="changeImage(this)">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="product-details">
                <h1 class="product-title">{{ $product->nom }}</h1>
                <p class="product-subtitle">{{ $product->description }}</p>

                <div class="price-container">
                    <span class="product-price">{{ number_format($product->prix_ttc ?? $product->prix_ht, 2, ',', ' ') }} Dhs</span>
                    @if($product->remise)
                        <span class="regular-price">{{ number_format($product->prix_ht, 2, ',', ' ') }} Dhs</span>
                    @endif
                </div>

                <div class="product-description">
                    <p>{{ $product->description_longue }}</p>
                </div>

                <div class="product-meta">
                    <div class="meta-item">
                        <span class="meta-label">Disponibilité :</span>
                        <span class="meta-value">
                            {{ $product->stock > 0 ? 'En stock ('.$product->stock.' unités)' : 'Rupture de stock' }}
                        </span>
                    </div>
                    @foreach($product->characteristics as $char)
                        <div class="meta-item">
                            <span class="meta-label">{{ $char->label }} :</span>
                            <span class="meta-value">{{ $char->value }}</span>
                        </div>
                    @endforeach

                    <div class="meta-item">
                        <span class="meta-label">Référence :</span>
                        <span class="meta-value">{{ $product->reference }}</span>
                    </div>
                </div>

                <div class="divider"></div>

                <form action="{{ route('cart.add', $product->id) }}" method="POST">
                    @csrf
                    <div class="quantity-selector">
                        <label for="quantity" style="margin-right: 15px; font-weight: 500;">Quantité :</label>
                        <button type="button" class="quantity-btn" onclick="decrementQuantity()">-</button>
                        <input type="number" id="quantity" name="quantity" class="quantity-input" value="1" min="1">
                        <button type="button" class="quantity-btn" onclick="incrementQuantity()">+</button>
                    </div>
                    
                    <div class="btn-group">
                        <button class="btn" type="submit">Ajouter au panier</button>
                        <button type="button" class="btn btn-outline">Ajouter à la liste d'envies</button>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="product-tabs">
            <div class="tab-header">
                <button class="tab-btn active" onclick="openTab(event, 'description')">Description</button>
                <button class="tab-btn" onclick="openTab(event, 'specs')">Caractéristiques</button>
                <button class="tab-btn" onclick="openTab(event, 'reviews')">
                    Avis ({{ $product->reviews->count() ?? 0 }})
                </button>
            </div>
            
            <!-- Description Tab -->
            <div id="description" class="tab-content active">
                <p>{{ $product->description_longue ?? 'Aucune description longue disponible pour ce produit.' }}</p>
            </div>

            <!-- Caractéristiques Tab -->
            <div id="specs" class="tab-content">
                @if($product->characteristics->count())
                    <ul style="line-height: 2;">
                        @foreach($product->characteristics as $char)
                            <li><strong>{{ $char->label }} :</strong> {{ $char->value }}</li>
                        @endforeach
                    </ul>
                @else
                    <p>Aucune caractéristique spécifiée pour ce produit.</p>
                @endif
            </div>

            <!-- Avis Tab -->
            <div id="reviews" class="tab-content">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @forelse($product->reviews as $review)
                    <div style="margin-bottom: 30px; padding-bottom: 20px; border-bottom: 1px solid rgba(150, 0, 24, 0.1);">
                        <div style="display: flex; align-items: center; margin-bottom: 10px;">
                            <div style="color: var(--burgundy); margin-right: 10px;">
                                @for ($i = 0; $i < $review->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                                @for ($i = $review->rating; $i < 5; $i++)
                                    <i class="far fa-star"></i>
                                @endfor
                            </div>
                            <strong>{{ $review->user_name }}</strong> - <span style="font-style: italic; color: var(--dark); opacity: 0.7;">{{ $review->created_at->format('d/m/Y') }}</span>
                        </div>
                        <p>{{ $review->comment }}</p>
                    </div>
                @empty
                    <p>Aucun avis pour ce produit.</p>
                @endforelse

                <h3 style="margin: 30px 0 20px; color: var(--navy);">Ajouter votre avis</h3>
                <form action="{{ route('reviews.store', $product) }}" method="POST" class="review-form">
                    @csrf

                    <div class="form-group">
                        <label for="user_name">Nom</label>
                        <input type="text" name="user_name" id="user_name" required>
                    </div>

                    <div class="form-group">
                        <label for="rating">Note</label>
                        <select name="rating" id="rating" required>
                            <option value="">Choisissez une note</option>
                            @for ($i = 5; $i >= 1; $i--)
                                <option value="{{ $i }}">{{ $i }} étoile{{ $i > 1 ? 's' : '' }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="comment">Commentaire</label>
                        <textarea name="comment" id="comment" rows="4" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Envoyer mon avis</button>
                </form>
            </div>
        </div>
        
            <div class="related-products">
                <h2 class="section-title">Vous pourriez aussi aimer</h2>
                <div class="product-grid">
                    @foreach($relatedProducts as $related)
                        <a href="{{ route('products.show', $related->slug) }}" class="product-card">
                            <img src="{{ $related->image ? asset('storage/' . $related->image) : 'https://via.placeholder.com/300x300' }}" 
                                alt="{{ $related->nom }}" 
                                class="product-card-img">
                            <div class="product-card-body">
                                <h3 class="product-card-title">{{ $related->nom }}</h3>
                                <div class="product-card-price">
                                    {{ number_format($related->prix_ttc ?? $related->prix_ht, 2, ',', ' ') }} Dhs
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

    </div>

    <!-- Your footer would go here -->

    <script>
        // Change main image when thumbnail is clicked
        function changeImage(element) {
            document.getElementById('mainImage').src = element.src;
        }
        
        // Quantity selector functionality
        function incrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            quantityInput.value = parseInt(quantityInput.value) + 1;
        }
        
        function decrementQuantity() {
            const quantityInput = document.getElementById('quantity');
            if (parseInt(quantityInput.value) > 1) {
                quantityInput.value = parseInt(quantityInput.value) - 1;
            }
        }
        
        // Tab functionality
        function openTab(evt, tabName) {
            const tabContents = document.getElementsByClassName('tab-content');
            for (let i = 0; i < tabContents.length; i++) {
                tabContents[i].classList.remove('active');
            }
            
            const tabButtons = document.getElementsByClassName('tab-btn');
            for (let i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove('active');
            }
            
            document.getElementById(tabName).classList.add('active');
            evt.currentTarget.classList.add('active');
        }
    </script>
</body>
</html>