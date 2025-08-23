<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rose & Bouchon - Accessoires de Vin</title>
    <link rel="stylesheet" href="{{ asset('assets/css/header.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="header-container">
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            
            <a href="/" class="logo">
                <span class="logo-icon">🍷</span>
                <span class="logo-text">Rose & Bouchon</span>
            </a>
            
            <nav>
                <ul class="nav-menu">
                    <li class="nav-item"><a href="/boutique" class="nav-link">Boutique</a></li>
                    <li class="nav-item"><a href="/evenements" class="nav-link">Events</a></li>
                    <li class="nav-item"><a href="/blog" class="nav-link">Conseils</a></li>
                    <li class="nav-item"><a href="/a-propos" class="nav-link">À propos</a></li>
                    <li class="nav-item"><a href="/contact" class="nav-link">Contact</a></li>
                </ul>
            </nav>
            
            <div class="search-box" style="position: relative;">
                <i class="fas fa-search search-icon"></i>
                <input type="text" class="search-input" placeholder="Rechercher..." id="searchInput" autocomplete="off">
                <ul id="suggestionList" class="suggestions"></ul>
            </div>

            
            <div class="header-icons">
                <a href="/mon-compte" class="header-icon" aria-label="Mon compte">
                    <i class="far fa-user"></i>
                </a>
                <a href="/panier" class="header-icon" aria-label="Panier">
                    <i class="fas fa-shopping-bag"></i>
                    @if ($cartCount > 0)
                        <span class="cart-count">{{ $cartCount }}</span>
                    @endif
                </a>
            </div>
        </div>
        
        <!-- Enhanced Mobile Menu -->
        <div class="mobile-menu" id="mobileMenu">
            <div class="mobile-menu-overlay"></div>
            <div class="mobile-menu-content">
                <button class="mobile-menu-close" id="mobileMenuClose">
                    <i class="fas fa-times"></i>
                </button>
                <ul class="mobile-menu-items">
                    <li class="mobile-menu-item"><a href="/boutique" class="mobile-menu-link">Boutique</a></li>
                    <li class="mobile-menu-item"><a href="/evenements" class="mobile-menu-link">Events</a></li>
                    <li class="mobile-menu-item"><a href="/blog" class="mobile-menu-link">Conseils</a></li>
                    <li class="mobile-menu-item"><a href="/a-propos" class="mobile-menu-link">À propos</a></li>
                    <li class="mobile-menu-item"><a href="/contact" class="mobile-menu-link">Contact</a></li>
                    <li class="mobile-menu-item"><a href="/mon-compte" class="mobile-menu-link">Mon compte</a></li>
                </ul>
                
                <div class="mobile-menu-footer">
                    <p style="color: var(--ivory); margin-bottom: 1rem;">Suivez-nous</p>
                    <div class="mobile-menu-social">
                        <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" aria-label="Pinterest"><i class="fab fa-pinterest-p"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <script src="{{ asset('assets/js/header.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('searchInput');
            const suggestionList = document.getElementById('suggestionList');

            searchInput.addEventListener('input', function () {
                const query = this.value;

                if (query.length < 2) {
                    suggestionList.classList.remove('visible');
                    suggestionList.innerHTML = '';
                    return;
                }

                fetch(`/search-products?q=${encodeURIComponent(query)}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestionList.innerHTML = '';
                        if (data.length === 0) {
                            suggestionList.innerHTML = '<li class="no-results">Aucun produit trouvé</li>';
                            suggestionList.classList.add('visible');
                            return;
                        }

                        data.forEach(product => {
                            const li = document.createElement('li');
                            li.innerHTML = `
                                <span class="product-name">${product.nom}</span>
                                ${product.categorie ? `<span class="product-category">${product.categorie}</span>` : ''}
                            `;
                            li.addEventListener('click', () => {
                                window.location.href = `/produits/${product.slug}`;
                            });
                            suggestionList.appendChild(li);
                        });
                        suggestionList.classList.add('visible');
                    });
            });

            // Handle keyboard navigation
            searchInput.addEventListener('keydown', function(e) {
                const items = suggestionList.querySelectorAll('li:not(.no-results)');
                let current = -1;
                
                items.forEach((item, index) => {
                    if (item.classList.contains('highlight')) {
                        item.classList.remove('highlight');
                        current = index;
                    }
                });

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    current = (current < items.length - 1) ? current + 1 : 0;
                    items[current].classList.add('highlight');
                    items[current].scrollIntoView({ block: 'nearest' });
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    current = (current > 0) ? current - 1 : items.length - 1;
                    items[current].classList.add('highlight');
                    items[current].scrollIntoView({ block: 'nearest' });
                } else if (e.key === 'Enter' && current !== -1) {
                    e.preventDefault();
                    items[current].click();
                }
            });

            // Hide suggestions when clicking outside
            document.addEventListener('click', function (e) {
                if (!searchInput.contains(e.target) && !suggestionList.contains(e.target)) {
                    suggestionList.classList.remove('visible');
                }
            });

            // Show suggestions when search input is focused and has content
            searchInput.addEventListener('focus', function() {
                if (this.value.length >= 2 && suggestionList.children.length > 0) {
                    suggestionList.classList.add('visible');
                }
            });
        });
    </script>

</body>
</html>