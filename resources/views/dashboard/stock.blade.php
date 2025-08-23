<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Stock - Cave & Cellier</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard-stock.css') }}">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-wine-glass-alt" style="color: var(--gold); font-size: 1.75rem;"></i>
            <h1>Rose & Bouchon</h1>
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="/dashboard" ><i class="fas fa-tachometer-alt"></i> Tableau de Bord</a></li>
            <li><a href="/dashboard/categories" ><i class="fas fa-tags"></i> Gestion des Catégories</a></li>
            <li><a href="/dashboard/produits" ><i class="fas fa-wine-bottle"></i> Gestion des Produits</a></li>
            <li><a href="/dashboard/stock" class="active"><i class="fas fa-boxes"></i> Gestion des Stocks</a></li>
            <li><a href="/dashboard/statistique" ><i class="fas fa-chart-bar"></i> Statistiques</a></li>
            <li><a href="/dashboard/commandes" ><i class="fas fa-shopping-basket"></i> Gestion des Commandes</a></li>
            <li><a href="/dashboard/livraisons" ><i class="fas fa-truck"></i> Gestion des Livraisons</a></li>
            <li><a href="/dashboard/contacts" ><i class="fas fa-envelope"></i> Messages de Contact</a></li>
            <li><a href="/dashboard/events" ><i class="fas fa-calendar-alt"></i> Participations Événements</a></li>
            <li><a href="/dashboard/marketing" ><i class="fas fa-bullhorn"></i> Marketing & Email</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" style="background: none; border: none; padding: 0; margin: 0; cursor: pointer; color: inherit; font: inherit;">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </button>
                </form>
            </li>
        </ul>
    </div>
    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
            <h2>Gestion des Stocks</h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin Profile">
                <span>Rose & Bouchon</span>
            </div>
        </div>
        
        <!-- Stock Summary Cards -->
        <!-- Search and Filter -->
        <form method="GET" action="{{ route('stock.index') }}" class="search-filter d-flex gap-2 mb-3">
            <select name="category_id" class="filter-select form-select">
                <option value="">Toutes les catégories</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->nom }}
                    </option>
                    @foreach ($cat->children as $sub)
                        <option value="{{ $sub->id }}" {{ request('category_id') == $sub->id ? 'selected' : '' }}>
                            — {{ $sub->nom }}
                        </option>
                    @endforeach
                @endforeach
            </select>

            <select name="stock_status" class="filter-select form-select">
                <option value="">Tous les statuts</option>
                <option value="in-stock" {{ request('stock_status') == 'in-stock' ? 'selected' : '' }}>En stock</option>
                <option value="low-stock" {{ request('stock_status') == 'low-stock' ? 'selected' : '' }}>Stock faible</option>
                <option value="out-of-stock" {{ request('stock_status') == 'out-of-stock' ? 'selected' : '' }}>Rupture de stock</option>
            </select>

            <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>
        
        <!-- Stock Management Table -->
        <div class="stock-management">
            <div class="section-header">
                <h3>État des Stocks</h3>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>Produit</th>
                        <th>Référence</th>
                        <th>Catégorie</th>
                        <th>Stock actuel</th>
                        <th>Seuil d'alerte</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        @php
                            $stock = $product->stock;
                            $threshold = 5;
                            $stockClass = $stock == 0 ? 'stock-out' : ($stock <= $threshold ? 'stock-low' : 'stock-high');
                            $alertText = $stock == 0 ? 'Rupture de stock' : ($stock <= $threshold ? 'Stock faible' : 'Stock suffisant');
                            $alertClass = $stock == 0 ? 'alert-danger' : ($stock <= $threshold ? 'alert-warning' : 'alert-success');
                        @endphp
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 1rem;">
                                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/60' }}" class="product-img" alt="{{ $product->nom }}">
                                    <span>{{ $product->nom }}</span>
                                </div>
                            </td>
                            <td>{{ $product->reference ?? 'N/A' }}</td>
                            <td>{{ $product->subcategory->nom ?? $product->category->nom ?? 'N/A' }}</td>
                            <td class="{{ $stockClass }}">{{ $stock }}</td>
                            <td>{{ $threshold }}</td>
                            <td><span class="stock-alert {{ $alertClass }}">{{ $alertText }}</span></td>
                            <td>
                                <button class="btn btn-sm btn-edit update-stock-btn"
                                        data-product-id="{{ $product->id }}"
                                        data-product-name="{{ $product->nom }}"
                                        data-product-image="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/60' }}"
                                        data-current-stock="{{ $product->stock }}">
                                    <i class="fas fa-sync-alt"></i>
                                </button>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--pagination -->
        <div class="pagination-container">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($products->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $products->previousPageUrl() }}" rel="prev">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                        @if ($page == $products->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($products->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $products->nextPageUrl() }}" rel="next">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

    <!-- Update Stock Modal -->
    
    <div class="modal" id="updateStockModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Mise à jour du stock</h3>
                <button class="close-modal" id="closeModal">&times;</button>
            </div>

            <form id="updateStockForm" method="POST">
                @csrf
                @method('PUT')

                <div class="modal-product-info">
                    <img id="modalProductImage" class="modal-product-img" src="" alt="Product Image">
                    <div>
                        <h4 id="modalProductName" class="modal-product-name"></h4>
                        <p>Stock actuel: <span id="modalCurrentStock"></span></p>
                    </div>
                </div>

                <div class="modal-form-group">
                    <label for="newStockQuantity">Nouvelle quantité</label>
                    <input type="number" id="newStockQuantity" name="stock" min="0" required>
                </div>

                <div class="modal-actions">
                    <button type="button" class="btn btn-edit" id="cancelUpdate">Annuler</button>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </div>
            </form>
        </div>
    </div>

    <script>
    const modal = document.getElementById('updateStockModal');
    const closeModal = document.getElementById('closeModal');
    const cancelBtn = document.getElementById('cancelUpdate');
    const updateBtns = document.querySelectorAll('.update-stock-btn');

    updateBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            const productId = this.dataset.productId;
            const productName = this.dataset.productName;
            const productImage = this.dataset.productImage;
            const currentStock = this.dataset.currentStock;

            document.getElementById('modalProductName').textContent = productName;
            document.getElementById('modalProductImage').src = productImage;
            document.getElementById('modalProductImage').alt = productName;
            document.getElementById('modalCurrentStock').textContent = currentStock;
            document.getElementById('newStockQuantity').value = currentStock;

            // Set the form action
            document.getElementById('updateStockForm').action = `/dashboard/stock/${productId}`;

            modal.style.display = 'flex';
        });
    });

    function closeStockModal() {
        modal.style.display = 'none';
    }

    closeModal.addEventListener('click', closeStockModal);
    cancelBtn.addEventListener('click', closeStockModal);

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeStockModal();
        }
    });
</script>

</body>
</html>