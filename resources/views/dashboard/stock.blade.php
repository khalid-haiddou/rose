<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Stock - Cave & Cellier</title>
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
            padding: 2rem 1.5rem;
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
        
        /* Stock Management */
        .stock-management {
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
        
        .btn-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        
        .btn-warning:hover {
            background-color: rgba(255, 193, 7, 0.2);
        }
        
        .stock-high {
            color: #28a745;
            font-weight: 500;
            text-align: center;
        }
        
        .stock-low {
            color: #ffc107;
            font-weight: 500;
            text-align: center;
        }
        
        .stock-out {
            color: #dc3545;
            font-weight: 500;
            text-align: center;
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
        
        .stock-alert {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .alert-success {
            background-color: rgba(40, 167, 69, 0.1);
            color: #28a745;
        }
        
        .alert-warning {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        
        .alert-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        
        .stock-form {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .stock-input {
            width: 70px;
            padding: 0.35rem 0.5rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            text-align: center;
        }
        
        /* Center the stock numbers */
        td:nth-child(4),
        td:nth-child(5) {
            text-align: center;
        }
        
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .modal-header h3 {
            color: var(--navy);
            font-size: 1.5rem;
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--dark);
        }
        
        .modal-product-info {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .modal-product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            border: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .modal-product-name {
            font-size: 1.2rem;
            font-weight: 500;
            color: var(--dark);
        }
        
        .modal-form-group {
            margin-bottom: 1.5rem;
        }
        
        .modal-form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--navy);
        }
        
        .modal-form-group input {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 1rem;
        }
        
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
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
            
            .action-btns {
                flex-direction: column;
            }
            
            .modal-content {
                padding: 1.5rem;
                margin: 0 1rem;
            }
            
            .modal-product-info {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
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
            <li><a href="#"><i class="fas fa-wine-bottle"></i> Gestion des Produits</a></li>
            <li><a href="#" class="active"><i class="fas fa-boxes"></i> Gestion des Stocks</a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i> Statistiques</a></li>
            <li><a href="#"><i class="fas fa-shopping-basket"></i> Gestion des Commandes</a></li>
            <li><a href="#"><i class="fas fa-truck"></i> Gestion des Livraisons</a></li>
            <li><a href="#"><i class="fas fa-cog"></i> Paramètres</a></li>
            <li><a href="#"><i class="fas fa-sign-out-alt"></i> Déconnexion</a></li>
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
                <span>Admin</span>
            </div>
        </div>
        
        <!-- Stock Summary Cards -->
        <div class="search-filter">
            <input type="text" class="search-box" placeholder="Rechercher un produit...">
            <select class="filter-select">
                <option value="">Toutes les catégories</option>
                <option value="1">Verres à vin</option>
                <option value="2">Accessoires de dégustation</option>
                <option value="3">Accessoires de conservation</option>
                <option value="4">Caves à vin</option>
                <option value="5">Ouvre-bouteilles</option>
            </select>
            <select class="filter-select">
                <option value="">Tous les statuts</option>
                <option value="in-stock">En stock</option>
                <option value="low-stock">Stock faible</option>
                <option value="out-of-stock">Rupture de stock</option>
            </select>
        </div>
        
        <!-- Stock Management Table -->
        <div class="stock-management">
            <div class="section-header">
                <h3>État des Stocks</h3>
                <button class="btn btn-primary">
                    <i class="fas fa-file-export"></i> Exporter
                </button>
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