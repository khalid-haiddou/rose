<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Gestion des Produits - Cave & Cellier</title>
    <style>
        :root {
            --navy: #000075;
            --burgundy: #960018;
            --dark: #121212;
            --ivory: #FEFEFA;
            --gold: #C4A267;
            --sidebar-width: 280px;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Cormorant Garamond', serif;
        }
        
        body {
            background-color: var(--ivory);
            color: var(--dark);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Sidebar Styles */
        .sidebar {
            width: var(--sidebar-width);
            background-color: var(--navy);
            color: var(--ivory);
            height: 100vh;
            position: fixed;
            padding:  1.5rem;
            transition: all 0.3s ease;
            z-index: 100;
            border-right: 1px solid rgba(196, 162, 103, 0.1);
        }
        
        .sidebar-header {
            display: flex;
            align-items: center;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(196, 162, 103, 0.2);
        }
        
        .sidebar-header h1 {
            font-size: 1.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            color: var(--ivory);
            margin-left: 0.75rem;
            font-variant: small-caps;
        }
        
        .sidebar-menu {
            list-style: none;
        }
        
        .sidebar-menu li {
            margin-bottom: 0.5rem;
            position: relative;
        }
        
        .sidebar-menu a {
            display: flex;
            align-items: center;
            padding: 0.85rem 1rem;
            color: rgba(254, 254, 250, 0.8);
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s ease;
            font-size: 1.05rem;
        }
        
        .sidebar-menu a:hover, .sidebar-menu a.active {
            background-color: rgba(196, 162, 103, 0.15);
            color: var(--ivory);
        }
        
        .sidebar-menu a:hover::before, .sidebar-menu a.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 3px;
            background-color: var(--gold);
        }
        
        .sidebar-menu i {
            margin-right: 0.75rem;
            font-size: 1.1rem;
            width: 24px;
            text-align: center;
        }
        ul {
        padding-left: 0rem;
        }
        
        /* Main Content Styles */
        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s ease;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 117, 0.1);
        }
        
        .header h2 {
            font-size: 1.75rem;
            color: var(--navy);
            font-weight: 600;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
        }
        
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 0.75rem;
            object-fit: cover;
            border: 2px solid var(--gold);
        }
        
        .user-profile span {
            font-weight: 500;
        }
        
        /* Products Table */
        .products-table {
            background-color: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }
        
        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .section-header h3 {
            font-size: 1.25rem;
            color: var(--navy);
            font-weight: 500;
        }
        
        .btn {
            padding: 0.6rem 1.2rem;
            border-radius: 6px;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
        }
        
        .btn-primary {
            background-color: var(--burgundy);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #7d0014;
        }
        
        .btn i {
            margin-right: 0.5rem;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 117, 0.05);
        }
        
        th {
            font-weight: 500;
            color: var(--navy);
            font-size: 0.9rem;
        }
        
        td {
            font-size: 0.95rem;
        }
        
        .product-img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .action-btns {
            display: flex;
            gap: 0.5rem;
        }
        
        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
            border-radius: 4px;
        }
        
        .btn-edit {
            background-color: rgba(0, 0, 117, 0.1);
            color: var(--navy);
        }
        
        .btn-edit:hover {
            background-color: rgba(0, 0, 117, 0.2);
        }
        
        .btn-delete {
            background-color: rgba(150, 0, 24, 0.1);
            color: var(--burgundy);
        }
        
        .btn-delete:hover {
            background-color: rgba(150, 0, 24, 0.2);
        }
        
        .stock-high {
            color: #28a745;
        }
        
        .stock-low {
            color: #ffc107;
        }
        
        .stock-out {
            color: #dc3545;
        }
        
        .search-filter {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .search-box {
            flex: 1;
            padding: 0.6rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 0.95rem;
        }
        
        .filter-select {
            padding: 0.6rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 0.95rem;
            background-color: white;
        }
        
        /* Mobile Responsiveness */
        @media (max-width: 992px) {
            .sidebar {
                transform: translateX(-100%);
                width: 280px;
            }
            
            .sidebar.active {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
                width: 100%;
            }
            
            .menu-toggle {
                display: block;
            }
        }
        
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .user-profile {
                margin-top: 1rem;
            }
            
            .section-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
            
            .search-filter {
                flex-direction: column;
            }
        }
        
        /* Menu Toggle Button */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--navy);
            cursor: pointer;
            margin-right: 1rem;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="fas fa-wine-glass-alt" style="color: var(--gold); font-size: 1.75rem;"></i>
            <h1>Admin</h1>
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="#"><i class="fas fa-tachometer-alt"></i> Tableau de Bord</a></li>
            <li><a href="#"><i class="fas fa-tags"></i> Gestion des Catégories</a></li>
            <li><a href="#" class="active"><i class="fas fa-wine-bottle"></i> Gestion des Produits</a></li>
            <li><a href="#"><i class="fas fa-boxes"></i> Gestion des Stocks</a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i> Statistiques</a></li>
            <li><a href="#"><i class="fas fa-shopping-basket"></i> Gestion des Commandes</a></li>
            <li><a href="#"><i class="fas fa-truck"></i> Gestion des Livraisons</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Paramètres</a></li>
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
            <h2>Gestion des Produits</h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin Profile">
                <span>Admin</span>
            </div>
        </div>
        
        <!-- Search and Filter -->
        <form method="GET" action="{{ route('products.index') }}" class="search-filter d-flex gap-2 mb-3">
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

        
        <!-- Products Table -->
        <div class="products-table">
            <div class="section-header">
                <h3>Liste des Produits</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProductModal">
                    <i class="fas fa-plus"></i> Ajouter un Produit
                </button>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Nom</th>
                        <th>Référence</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" class="product-img" alt="{{ $product->nom }}">
                                @else
                                    <img src="https://via.placeholder.com/60" class="product-img" alt="Image manquante">
                                @endif
                            </td>
                            <td>{{ $product->nom }}</td>
                            <td>{{ $product->reference }}</td>
                            <td>
                                {{ $product->subcategory?->nom ?? $product->category?->nom ?? '—' }}
                            </td>
                            <td>{{ number_format($product->prix_ttc ?? $product->prix_ht, 2, ',', ' ') }} Dhs</td>
                            <td class="{{ $product->stock == 0 ? 'stock-out' : ($product->stock <= 5 ? 'stock-low' : 'stock-high') }}">
                                {{ $product->stock }}
                            </td>
                            <td>
                                <div class="action-btns">
                                   <a href="#" class="btn btn-sm btn-edit"
                                        onclick="editProduct(event)"
                                        data-product="{{ json_encode($product) }}"
                                        data-characteristics="{{ json_encode($product->characteristics) }}">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-delete" onclick="return confirm('Supprimer ce produit ?')">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">Aucun produit trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <!--pagination -->
        <div class="pagination mt-3">
            {{ $products->withQueryString()->links() }}
        </div>
    <!-- Modal pour store new produit -->
    <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="productForm" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" id="product_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createProductModalLabel">Ajouter un Nouveau Produit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom du produit</label>
                                <input type="text" name="nom" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="reference" class="form-label">Référence</label>
                                <input type="text" name="reference" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Catégorie</label>
                                <select name="category_id" class="form-select" required>
                                    <option value="">-- Sélectionner --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="subcategory_id" class="form-label">Sous-catégorie (facultatif)</label>
                                <select name="subcategory_id" class="form-select">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach($categories as $cat)
                                        @foreach($cat->children as $sub)
                                            <option value="{{ $sub->id }}">{{ $cat->nom }} > {{ $sub->nom }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="prix_ht" class="form-label">Prix HT</label>
                                <input type="number" step="0.01" name="prix_ht" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="prix_ttc" class="form-label">Prix TTC</label>
                                <input type="number" step="0.01" name="prix_ttc" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="remise" class="form-label">Remise (%)</label>
                                <input type="number" name="remise" class="form-control" min="0" max="100">
                            </div>

                            <div class="col-md-6">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label for="is_new" class="form-label">Produit Nouveau ?</label>
                                <select name="is_new" class="form-select">
                                    <option value="0">Non</option>
                                    <option value="1">Oui</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="description" class="form-label">Description courte</label>
                                <textarea name="description" rows="2" class="form-control"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="description_longue" class="form-label">Description longue</label>
                                <textarea name="description_longue" rows="3" class="form-control"></textarea>
                            </div>

                            <div class="col-md-6">
                                <label for="image" class="form-label">Image principale</label>
                                <input type="file" name="image" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label for="gallery" class="form-label">Galerie d'images</label>
                                <input type="file" name="gallery[]" class="form-control" multiple>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label">Caractéristiques</label>
                                <div id="char-container">
                                    <div class="row mb-2 char-row">
                                        <div class="col-md-5">
                                            <input type="text" name="characteristics[0][label]" class="form-control" placeholder="Ex: Matériau">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="characteristics[0][value]" class="form-control" placeholder="Ex: Acier inoxydable">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger remove-char w-100">X</button>
                                        </div>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary mt-2" id="add-char">+ Ajouter une caractéristique</button>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Modal de Modification -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <form id="editProductForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="product_id" id="edit_product_id">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editProductModalLabel">Modifier le Produit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom</label>
                                <input type="text" name="nom" class="form-control" id="edit_nom" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Référence</label>
                                <input type="text" name="reference" class="form-control" id="edit_reference" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Catégorie</label>
                                <select name="category_id" class="form-select" id="edit_category_id" required>
                                    <option value="">-- Sélectionner --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Sous-catégorie</label>
                                <select name="subcategory_id" class="form-select" id="edit_subcategory_id">
                                    <option value="">-- Sélectionner --</option>
                                    @foreach($categories as $cat)
                                        @foreach($cat->children as $sub)
                                            <option value="{{ $sub->id }}">{{ $cat->nom }} > {{ $sub->nom }}</option>
                                        @endforeach
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Prix HT</label>
                                <input type="number" step="0.01" name="prix_ht" class="form-control" id="edit_prix_ht" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Prix TTC</label>
                                <input type="number" step="0.01" name="prix_ttc" class="form-control" id="edit_prix_ttc">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Remise (%)</label>
                                <input type="number" name="remise" class="form-control" id="edit_remise" min="0" max="100">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control" id="edit_stock" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Produit Nouveau ?</label>
                                <select name="is_new" class="form-select" id="edit_is_new">
                                    <option value="0">Non</option>
                                    <option value="1">Oui</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description</label>
                                <textarea name="description" rows="2" class="form-control" id="edit_description"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Description longue</label>
                                <textarea name="description_longue" rows="3" class="form-control" id="edit_description_longue"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Image principale</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Galerie d'images</label>
                                <input type="file" name="gallery[]" class="form-control" multiple>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Caractéristiques</label>
                                <div id="edit-char-container"></div>
                                <button type="button" class="btn btn-secondary mt-2" id="edit-add-char">+ Ajouter une caractéristique</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let charIndex = 1;

            document.getElementById('add-char').addEventListener('click', function () {
                const container = document.getElementById('char-container');
                const row = document.createElement('div');
                row.className = 'row mb-2 char-row';
                row.innerHTML = `
                    <div class="col-md-5">
                        <input type="text" name="characteristics[${charIndex}][label]" class="form-control" placeholder="Ex: Dimension">
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="characteristics[${charIndex}][value]" class="form-control" placeholder="Ex: 12cm">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-char w-100">X</button>
                    </div>
                `;
                container.appendChild(row);
                charIndex++;
            });

            document.addEventListener('click', function (e) {
                if (e.target && e.target.classList.contains('remove-char')) {
                    e.target.closest('.char-row').remove();
                }
            });
        });
    </script>
    <script>
        function editProduct(id) {
            const btn = event.currentTarget;
            const product = JSON.parse(btn.getAttribute('data-product'));
            const characteristics = JSON.parse(btn.getAttribute('data-characteristics'));

            // Remplir les champs
            document.getElementById('edit_nom').value = product.nom || '';
            document.getElementById('edit_reference').value = product.reference || '';
            document.getElementById('edit_category_id').value = product.category_id || '';
            document.getElementById('edit_subcategory_id').value = product.subcategory_id || '';
            document.getElementById('edit_prix_ht').value = product.prix_ht || '';
            document.getElementById('edit_prix_ttc').value = product.prix_ttc || '';
            document.getElementById('edit_remise').value = product.remise || '';
            document.getElementById('edit_stock').value = product.stock || '';
            document.getElementById('edit_is_new').value = product.is_new || 0;
            document.getElementById('edit_description').value = product.description || '';
            document.getElementById('edit_description_longue').value = product.description_longue || '';

            // ID pour action
            const form = document.getElementById('editProductForm');
            form.action = `/dashboard/produits/${product.id}`;
            document.getElementById('edit_product_id').value = product.id;

            // Caractéristiques
            const container = document.getElementById('edit-char-container');
            container.innerHTML = '';
            if (Array.isArray(characteristics)) {
                characteristics.forEach((char, index) => {
                    container.innerHTML += `
                        <div class="row mb-2 char-row">
                            <div class="col-md-5">
                                <input type="text" name="characteristics[${index}][label]" class="form-control" value="${char.label}">
                            </div>
                            <div class="col-md-5">
                                <input type="text" name="characteristics[${index}][value]" class="form-control" value="${char.value}">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-danger remove-char w-100">X</button>
                            </div>
                        </div>
                    `;
                });
            }

            // Show modal
            new bootstrap.Modal(document.getElementById('editProductModal')).show();
        }

        // Ajouter dynamique une nouvelle caractéristique
        document.getElementById('edit-add-char').addEventListener('click', () => {
            const container = document.getElementById('edit-char-container');
            const index = container.querySelectorAll('.char-row').length;
            const html = `
                <div class="row mb-2 char-row">
                    <div class="col-md-5">
                        <input type="text" name="characteristics[${index}][label]" class="form-control" placeholder="Ex: Couleur">
                    </div>
                    <div class="col-md-5">
                        <input type="text" name="characteristics[${index}][value]" class="form-control" placeholder="Ex: Rouge">
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger remove-char w-100">X</button>
                    </div>
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        });

        // Supprimer une ligne de caractéristique
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('remove-char')) {
                e.target.closest('.char-row').remove();
            }
        });
    </script>

</body>
</html>