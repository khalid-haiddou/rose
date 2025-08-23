<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thermomètre à Vin Élégant - Rose & Bouchon</title>
    <link rel="stylesheet" href="{{ asset('assets/css/single-product.css') }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
   
    @include('layouts.header') 

    <!-- Image Modal -->
    <div id="imageModal" class="image-modal">
        <div class="modal-content">
            <button class="close-modal" onclick="closeImageModal()">&times;</button>
            <img id="modalImage" class="modal-image" src="" alt="">
            <div class="zoom-hint">Cliquez en dehors de l'image pour fermer</div>
        </div>
    </div>

    <div class="container">
        <div class="product-container">
            <div class="product-gallery">
                @if($product->remise)
                    <span class="sale-badge">-{{ $product->remise }}%</span>
                @endif

                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/600x600' }}"
                    alt="{{ $product->nom }}" class="main-image" id="mainImage" onclick="openImageModal(this)">

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
                        <button class="btn whatsapp-btn" type="button" onclick="shareOnWhatsApp('{{ route('products.show', $product->slug) }}')">
                            <i class="fab fa-whatsapp"></i>
                        </button>
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
                <form action="{{ route('reviews.store', $product) }}" method="POST" class="review-form" style="width: 100%;">
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

    <script>
        // Image Modal Functions
        function openImageModal(imageElement) {
            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            
            modalImage.src = imageElement.src;
            modalImage.alt = imageElement.alt;
            modal.classList.add('show');
            
            // Prevent body scroll when modal is open
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('show');
            
            // Restore body scroll
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });

        // Change main image when thumbnail is clicked (updated to also make thumbnails clickable for modal)
        function changeImage(element) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = element.src;
            
            // Also add click functionality to the new main image
            mainImage.onclick = function() {
                openImageModal(this);
            };
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
        
        function shareOnWhatsApp(productUrl) {
            const message = "Salut !";
            const fullMessage = `${message} ${productUrl}`;
            const encodedMessage = encodeURIComponent(fullMessage);
            const whatsappUrl = `https://wa.me/+212656208525?text=${encodedMessage}`;
            window.open(whatsappUrl, '_blank');
        }

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

    @include('layouts.footer') 

</body>
</html>