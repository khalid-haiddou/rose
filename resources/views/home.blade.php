<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Rose & Bouchon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
</head>
<body>

   @include('layouts.header') 

<section class="wine-hero">

    <div class="hero-slider">
        <div class="slide active" style="background-image: url('{{ asset('assets/images/chiringuito.png') }}')">
            <div class="slide-overlay"></div>
        </div>
        <div class="slide" style="background-image: url('{{ asset('assets/images/sandrie.png') }}')">
            <div class="slide-overlay"></div>
        </div>
        <div class="slide" style="background-image: url('{{ asset('assets/images/vin.png') }}')">
            <div class="slide-overlay"></div>
        </div>
    </div>


    <div class="hero-content">
        <div class="french-motif left"></div>

        <div class="main-content">
            <div class="vintage-label">
                <span>Depuis 2010</span>
                <div class="wax-seal"></div>
            </div>

            <h1>
                <span class="script">L'Art du Vin</span>
                <span class="serif">Élégamment Préservé</span>
            </h1>

            <div class="wine-divider">
                <div class="grape"></div>
                <div class="vine"></div>
                <div class="grape"></div>
            </div>

            <p class="subtitle">Découvrez nos accessoires d'exception pour cave et dégustation</p>

            <div class="cta-container">
                <a href="/boutique" class="primary-cta">
                    <span>Voir la collection</span>
                    <i class="fas fa-chevron-right"></i>
                </a>
                <a href="/blog" class="secondary-cta">
                    <i class="fas fa-book"></i>
                    <span>Conseils d'expert</span>
                </a>
            </div>
        </div>

        <div class="french-motif right"></div>
    </div>

    <!-- Contrôles du slider -->
    <div class="slider-controls">
        <button class="slider-prev"><i class="fas fa-chevron-left"></i></button>
        <div class="slider-dots"></div>
        <button class="slider-next"><i class="fas fa-chevron-right"></i></button>
    </div>

    <!-- Effet de reflet de verre à vin -->
    <div class="wine-reflection"></div>
</section>

<section class="categories-section" id="categories">
    <div class="container">
        <div class="section-title animate">
            <h2>Nos Catégories</h2>
        </div>
        
        <div class="row">
            <div class="col-md-3 col-sm-6 animate delay-1">
                <div class="category-card">
                  <a href="/boutique?categories%5B%5D=1" class="category-img-link">
                    <div class="category-img">
                        <img src="{{ asset('assets/images/cave-vin.png') }}" alt="Caves à vin">
                        <div class="category-overlay">
                            <h3>Caves à vin</h3>
                        </div>
                    </div>
                  </a>
                </div>
            </div>
            

            <div class="col-md-3 col-sm-6 animate delay-1">
                <div class="category-card">
                     <a href="/boutique?categories%5B%5D=2" class="category-img-link">
                    <div class="category-img">
                        <img src="{{ asset('assets/images/verreries.png') }}" alt="Caves à vin">
                        <div class="category-overlay">
                            <h3>Verrerie</h3>
                        </div>
                    </div>
                     </a>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 animate delay-1">
                <div class="category-card">                    
                     <a href="/boutique?categories%5B%5D=10" class="category-img-link">
                    <div class="category-img">
                        <img src="{{ asset('assets/images/chiringuito.png') }}" alt="Accessoires">
                        <div class="category-overlay">
                            <h3>Ameublement et Jardin</h3>
                        </div>
                    </div>
                     </a>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 animate delay-1">
                <div class="category-card">
                     <a href="/boutique?categories%5B%5D=11" class="category-img-link">
                    <div class="category-img">
                        <img src="{{ asset('assets/images/Accessoires-vin.png') }}" alt="Caves à vin">
                        <div class="category-overlay">
                            <h3>Accessoires de Vin</h3>
                        </div>
                    </div>
                     </a>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 animate delay-2">
                <div class="category-card">
                    <a href="/boutique?categories%5B%5D=12" class="category-img-link">
                        <div class="category-img">
                            <img src="{{ asset('assets/images/Mini-réfrigérateurs-frigos.png') }}" alt="Thermomètres">
                            <div class="category-overlay">
                                <h3>Mini-Réfrigérateurs et Frigos</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 animate delay-2">
                <div class="category-card">
                     <a href="/boutique?categories%5B%5D=13" class="category-img-link">
                    <div class="category-img">
                        <img src="{{ asset('assets/images/cigares-cendriers.png') }}" alt="Caves à vin">
                        <div class="category-overlay">
                            <h3>Caves à cigares et cendriers</h3>
                        </div>
                    </div>
                     </a>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 animate delay-2">
                <div class="category-card">
                    <a href="/boutique?categories%5B%5D=14" class="category-img-link">
                    <div class="category-img">
                        <img src="{{ asset('assets/images/univers-cocktail.png') }}" alt="Porte-bouteilles">
                        <div class="category-overlay">
                            <h3>Univers du Cocktail</h3>
                        </div>
                    </div>
                    </a>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 animate delay-2">
                <div class="category-card">
                     <a href="/boutique?categories%5B%5D=15" class="category-img-link">
                    <div class="category-img">
                        <img src="{{ asset('assets/images/Promotions-packs.png') }}" alt="Coffrets cadeaux">
                        <div class="category-overlay">
                            <h3>Promotions et Packs</h3>
                        </div>
                    </div>
                     </a>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-img animate">
                    <img src="https://images.unsplash.com/photo-1566633806327-68e152aaf26d?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="À propos de Rose & Bouchon">
                </div>
                <div class="about-text animate delay-1">
                    <h2>Rose & Bouchon - L'excellence du service à vin</h2>
                    <p>Fondée en 2010 par des passionnés d'œnologie, Rose & Bouchon s'est rapidement imposée comme une référence dans le domaine des accessoires haut de gamme pour la conservation et la dégustation du vin.</p>
                    <p>Notre mission est de fournir à nos clients des produits d'exception qui allient esthétique, fonctionnalité et durabilité, tout en partageant notre expertise et notre passion pour le monde du vin.</p>
                    <a href="/a-propos" class="btn-hero">Savoir plus</a>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="luxury-slider-section">
        <div class="luxury-container">
            <!-- En-tête avec navigation intégrée -->
            <div class="luxury-header">
                <div class="title-wrapper">
                <h2 class="section-title">Best <span class="accent">Sellers</span></h2>
                    <div class="slider-progress">
                        <div class="progress-bar"></div>
                    </div>
                </div>
                
                <div class="slider-nav">
                    <button class="nav-btn prev-btn" aria-label="Précédent">
                        <div class="circle-bg"></div>
                        <svg class="arrow-icon" viewBox="0 0 24 24">
                            <path class="arrow-stroke" d="M15 18l-6-6 6-6"/>
                        </svg>
                    </button>
                    <button class="nav-btn next-btn" aria-label="Suivant">
                        <div class="circle-bg"></div>
                        <svg class="arrow-icon" viewBox="0 0 24 24">
                            <path class="arrow-stroke" d="M9 6l6 6-6 6"/>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Slider Container -->

            <div class="slider-wrapper">
                <div class="luxury-slider">
                    @foreach($bestSellers as $product)
                    <a href="{{ route('products.show', $product->slug) }}" >
                    <article class="product-card">
                        <div class="card-inner">
                            <div class="product-media">
                                <img class="product-image"
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->nom }}"
                                    loading="lazy">
                                
                                <div class="product-badge">
                                    <span class="badge-text">Best-seller</span>
                                </div>
                            </div>

                            <div class="product-info">
                                <span class="product-category wine-category">{{ $product->category->nom ?? 'Catégorie' }}</span>
                                <h3 class="product-title">{{ $product->nom }}</h3>
                                
                                <div class="product-meta">
                                    @if($product->rating && $product->reviews_count > 0)
                                        {{-- Product has reviews --}}
                                        <div class="rating-display" data-rating="{{ $product->rating }}">
                                            <div class="stars-wrapper">
                                                <div class="stars-container" style="position: relative; display: inline-block;">
                                                    {{-- Empty stars background --}}
                                                    <div class="stars-empty" style="color: #ddd;">★★★★★</div>
                                                    {{-- Filled stars overlay --}}
                                                    <div class="stars-fill" style="position: absolute; top: 0; left: 0; width: {{ ($product->rating / 5) * 100 }}%; overflow: hidden; color: #ffc107;">★★★★★</div>
                                                </div>
                                            </div>
                                            <span class="rating-count" style="margin-left: 8px; color: #666; font-size: 14px;">
                                                ({{ $product->reviews_count }} {{ $product->reviews_count == 1 ? 'avis' : 'avis' }})
                                            </span>
                                            <span class="rating-value" style="margin-left: 4px; font-weight: 600; color: #333;">
                                                {{ $product->rating }}/5
                                            </span>
                                        </div>
                                    @elseif($product->reviews_count == 0)
                                        {{-- No reviews yet --}}
                                        <div class="no-rating-display">
                                            <div class="stars-wrapper">
                                                <div class="stars-container" style="position: relative; display: inline-block;">
                                                    <div class="stars-empty" style="color: #ddd;">★★★★★</div>
                                                </div>
                                            </div>
                                            <span class="no-rating-text" style="margin-left: 8px; color: #999; font-size: 14px; font-style: italic;">
                                                Aucun avis
                                            </span>
                                            @if($product->is_new)
                                                <span class="new-badge" style="background: #28a745; color: white; padding: 2px 6px; border-radius: 4px; font-size: 11px; margin-left: 8px;">
                                                    NOUVEAU
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    <div class="price-wrapper">
                                        @if($product->remise && $product->remise > 0)
                                            @php
                                                $discountedPrice = $product->prix_ttc * (1 - $product->remise / 100);
                                            @endphp
                                            <span class="original-price" style="text-decoration: line-through; color: #999; margin-right: 8px;">
                                                {{ number_format($product->prix_ttc, 2, ',', ' ') }} Dhs
                                            </span>
                                            <span class="current-price wine-price">{{ number_format($discountedPrice, 2, ',', ' ') }} Dhs</span>
                                            <span class="discount-badge" style="background: #e74c3c; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px; margin-left: 8px;">
                                                -{{ $product->remise }}%
                                            </span>
                                        @else
                                            <span class="current-price wine-price">{{ number_format($product->prix_ttc, 2, ',', ' ') }} Dhs</span>
                                        @endif
                                    </div>
                                    
                                    @if($product->sold_percentage > 0)
                                        <div class="sold-progress" style="margin-top: 8px;">
                                            <div class="progress-bar" style="background: #f0f0f0; border-radius: 10px; height: 4px; overflow: hidden;">
                                                <div class="progress-fill" style="background: #e74c3c; height: 100%; width: {{ $product->sold_percentage }}%; transition: width 0.3s ease;"></div>
                                            </div>
                                            <span class="sold-text" style="font-size: 12px; color: #666; margin-top: 4px; display: block;">
                                                {{ $product->sold_percentage }}% vendu
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                
                                <button class="view-product-btn" onclick="window.location.href='{{ route('products.show', $product->slug) }}'">
                                    Voir le produit
                                </button>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            </div>

        </div>
    </section>


    <section class="limited-offers">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">Offres <span class="accent">Exclusives</span></h2>
            </div>

            <div class="offer-slider">
                @forelse($promotionsAndPacks as $product)
                <a href="{{ route('products.show', $product->slug) }}" >
                    <article class="product-card">
                        <div class="card-inner">
                            <div class="product-media">
                                <img class="product-image"
                                    src="{{ asset('storage/' . $product->image) }}"
                                    alt="{{ $product->nom }}"
                                    loading="lazy">
                                
                                <div class="product-badge">
                                    @if($product->sold_percentage >= 80)
                                        <span class="badge-text">Presque épuisé</span>
                                    @elseif($product->sold_percentage >= 50)
                                        <span class="badge-text">Populaire</span>
                                    @else
                                        <span class="badge-text">Promotion</span>
                                    @endif
                                </div>
                            </div>

                            <div class="product-info">
                                <span class="product-category wine-category">{{ $product->category->nom ?? 'Promotions et Packs' }}</span>
                                <h3 class="product-title">{{ $product->nom }}</h3>
                                
                                <div class="product-meta">
                                    @if($product->rating && $product->reviews_count > 0)
                                        {{-- Product has reviews --}}
                                        <div class="rating-display" data-rating="{{ $product->rating }}">
                                            <div class="stars-wrapper">
                                                <div class="stars-container" style="position: relative; display: inline-block;">
                                                    {{-- Empty stars background --}}
                                                    <div class="stars-empty" style="color: #ddd;">★★★★★</div>
                                                    {{-- Filled stars overlay --}}
                                                    <div class="stars-fill" style="position: absolute; top: 0; left: 0; width: {{ ($product->rating / 5) * 100 }}%; overflow: hidden; color: #ffc107;">★★★★★</div>
                                                </div>
                                            </div>
                                            <span class="rating-count" style="margin-left: 8px; color: #666; font-size: 14px;">
                                                ({{ $product->reviews_count }} {{ $product->reviews_count == 1 ? 'avis' : 'avis' }})
                                            </span>
                                            <span class="rating-value" style="margin-left: 4px; font-weight: 600; color: #333;">
                                                {{ $product->rating }}/5
                                            </span>
                                        </div>
                                    @elseif($product->reviews_count == 0)
                                        {{-- No reviews yet --}}
                                        <div class="no-rating-display">
                                            <div class="stars-wrapper">
                                                <div class="stars-container" style="position: relative; display: inline-block;">
                                                    <div class="stars-empty" style="color: #ddd;">★★★★★</div>
                                                </div>
                                            </div>
                                            <span class="no-rating-text" style="margin-left: 8px; color: #999; font-size: 14px; font-style: italic;">
                                                Aucun avis
                                            </span>
                                            @if($product->is_new)
                                                <span class="new-badge" style="background: #28a745; color: white; padding: 2px 6px; border-radius: 4px; font-size: 11px; margin-left: 8px;">
                                                    NOUVEAU
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                    
                                    <div class="price-wrapper">
                                        @if($product->remise && $product->remise > 0)
                                            @php
                                                $discountedPrice = $product->prix_ttc * (1 - $product->remise / 100);
                                            @endphp
                                            <span class="original-price" style="text-decoration: line-through; color: #999; margin-right: 8px;">
                                                {{ number_format($product->prix_ttc, 2, ',', ' ') }} Dhs
                                            </span>
                                            <span class="current-price wine-price">{{ number_format($discountedPrice, 2, ',', ' ') }} Dhs</span>
                                            <span class="discount-badge" style="background: #e74c3c; color: white; padding: 2px 6px; border-radius: 4px; font-size: 12px; margin-left: 8px;">
                                                -{{ $product->remise }}%
                                            </span>
                                        @else
                                            <span class="current-price wine-price">{{ number_format($product->prix_ttc ?? $product->prix_ht, 2, ',', ' ') }} Dhs</span>
                                        @endif
                                    </div>
                                    
                                    @if($product->sold_percentage > 0)
                                        <div class="sold-progress" style="margin-top: 8px;">
                                            <div class="progress-bar" style="background: #f0f0f0; border-radius: 10px; height: 4px; overflow: hidden;">
                                                <div class="progress-fill" style="background: #e74c3c; height: 100%; width: {{ $product->sold_percentage }}%; transition: width 0.3s ease;"></div>
                                            </div>
                                            <span class="sold-text" style="font-size: 12px; color: #666; margin-top: 4px; display: block;">
                                                {{ $product->sold_percentage }}% vendu
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                
                                <button class="view-product-btn" onclick="window.location.href='{{ route('products.show', $product->slug) }}'">
                                    Voir le produit
                                </button>
                            </div>
                        </div>
                    </article>
                @empty
            <div class="no-products-message" style="text-align: center; padding: 40px; color: #666;">
                <p>Aucune promotion disponible pour le moment.</p>
            </div>
        @endforelse
    </div>
    </div>
</section>


<section class="testimonials-section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">LAISSONS LES CLIENTS PARLER POUR NOUS</h2>

    </div>

    <div class="testimonials-container">
      <div class="testimonials-grid" id="testimonialsSlider">
        <div class="testimonial-card">
          <div class="rating">★★★★★</div>
          <p class="testimonial-text">Très bon service reçu rapidement. Excellent service même par téléphone très disponible. Je le recommande sans hésiter.</p>
          <div class="testimonial-meta">
            <p class="author-name">Sophie Martin</p>
          </div>
        </div>


        <div class="testimonial-card">
          <div class="rating">★★★★★</div>
          <p class="testimonial-text">Tres facile à personnaliser, livraison rapide. Produit de qualité supérieure avec un packaging soigné.</p>
          <div class="testimonial-meta">
            <p class="author-name">Marc Dupont</p>
          </div>
        </div>


        <div class="testimonial-card">
          <div class="rating">★★★★★</div>
          <p class="testimonial-text">Parfait et service rapide. Produit toujours aussi beau et toujours aussi rapide pour l'avoir.</p>
          <div class="testimonial-meta">
            <p class="author-name">Charles Belhumeur</p>
          </div>
        </div>


        <div class="testimonial-card">
          <div class="rating">★★★★★</div>
          <p class="testimonial-text">Commande reçue dans les délais, emballage parfait. Je recommande ce site pour la qualité de ses produits.</p>
          <div class="testimonial-meta">
            <p class="author-name">Émilie Rousseau</p>
          </div>
        </div>
      </div>

      <div class="slider-controls">
        <button class="slider-arrow" id="prevTestimonial">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M15 18l-6-6 6-6"/>
          </svg>
        </button>
        <button class="slider-arrow" id="nextTestimonial">
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 18l6-6-6-6"/>
          </svg>
        </button>
      </div>
    </div>
  </div>
</section>


    <section class="blog-section">
        <div class="container">
            <div class="section-title animate">
                <h2>Conseils & Actualités</h2>
                <p>Découvrez nos articles sur l'univers du vin</p>
            </div>
            
            <div class="row">
                <div class="col-lg-4 col-md-6 animate delay-1">
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="https://images.unsplash.com/photo-1514933651103-005eec06c04b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Conserver son vin">
                        </div>
                        <div class="blog-body">
                            <span class="blog-date">15 juin 2023</span>
                            <h3>Comment bien conserver son vin à la maison</h3>
                            <p>Découvrez nos conseils d'expert pour conserver vos bouteilles de vin dans les meilleures conditions, même sans cave professionnelle.</p>
                            <a href="#" class="blog-link">Lire l'article <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                

                <div class="col-lg-4 col-md-6 animate delay-2">
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="https://images.unsplash.com/photo-1506377247377-2a5b3b417ebb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Choisir ses verres">
                        </div>
                        <div class="blog-body">
                            <span class="blog-date">2 juin 2023</span>
                            <h3>Guide complet pour choisir ses verres à vin</h3>
                            <p>Quel verre pour quel vin ? Notre guide vous aide à sélectionner les verres adaptés à chaque type de vin pour une dégustation optimale.</p>
                            <a href="#" class="blog-link">Lire l'article <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                

                <div class="col-lg-4 col-md-6 animate delay-3">
                    <div class="blog-card">
                        <div class="blog-img">
                            <img src="https://images.unsplash.com/photo-1423483641154-5411ec9c0ddf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80" alt="Décantation du vin">
                        </div>
                        <div class="blog-body">
                            <span class="blog-date">20 mai 2023</span>
                            <h3>L'art de la décantation : pourquoi et comment faire</h3>
                            <p>Tout ce que vous devez savoir sur la décantation du vin : les bénéfices, les techniques et les erreurs à éviter.</p>
                            <a href="#" class="blog-link">Lire l'article <i class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-5 animate delay-3">
                <a href="#" class="btn-hero">Voir tous les articles</a>
            </div>
        </div>
    </section>
    


<section class="features-section">
    <div class="container">
        <div class="features-grid">

            <div class="feature-card" style="--accent: var(--burgundy);">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M19 14v3h3v2h-3v3h-2v-3h-3v-2h3v-3h2zm1.243-9.243a6 6 0 10-8.486 8.486L12 18.364l-4.757-4.757a6 6 0 118.486-8.486L12 5.636l4.243-4.243z"/>
                    </svg>
                </div>
                <h3>SAV</h3>
                <p>Service Après-Vente Premium</p>
                <div class="feature-hover"></div>
            </div>


            <div class="feature-card" style="--accent: var(--navy);">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91 4.59-1.15 8-5.86 8-10.91V5l-8-3zm-1.06 13.54L7.4 12l1.41-1.41 2.12 2.12 4.24-4.24 1.41 1.41-5.64 5.66z"/>
                    </svg>
                </div>
                <h3>Normes Franchise</h3>
                <p>Qualité certifiée</p>
                <div class="feature-hover"></div>
            </div>


            <div class="feature-card" style="--accent: var(--gold);">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M19 7h-3V6a3 3 0 00-3-3H5a3 3 0 00-3 3v10a3 3 0 003 3h14a3 3 0 003-3v-6a3 3 0 00-3-3zM5 6h8v2H5V6zm14 12H5v-4h14v4zm0-6H5V8h14v4z"/>
                    </svg>
                </div>
                <h3>Livraison</h3>
                <p>Express 24/48h</p>
                <div class="feature-hover"></div>
            </div>


            <div class="feature-card" style="--accent: var(--burgundy);">
                <div class="feature-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12 2L4 5v6.09c0 5.05 3.41 9.76 8 10.91 4.59-1.15 8-5.86 8-10.91V5l-8-3zm3.5 12.09l-1.41 1.41L12 13.42 9.91 15.5 8.5 14.09 10.59 12 8.5 9.91 9.91 8.5 12 10.59l2.09-2.09 1.41 1.41L13.42 12l2.08 2.09z"/>
                    </svg>
                </div>
                <h3>Qualité</h3>
                <p>Produits sélectionnés</p>
                <div class="feature-hover"></div>
            </div>
        </div>
    </div>
</section>

   @include('layouts.footer') 


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/home.js') }}"></script>
   
</body>
</html>