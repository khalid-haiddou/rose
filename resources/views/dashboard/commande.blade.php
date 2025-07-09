<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Commandes - Cave & Cellier</title>
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
        
        /* Orders Management */
        .orders-management {
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
        
        .status {
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status.en-attente {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        
        .status.confirmee {
            background-color: rgba(32, 201, 151, 0.1);
            color: #20c997;
        }
        
        .status.en-preparation {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }
        
        .status.en-cours-de-livraison {
            background-color: rgba(111, 66, 193, 0.1);
            color: #6f42c1;
        }
        
        .status.livree {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
        }
        
        .status.echec-de-la-livraison {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        .status.annulee {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        
        .status.retournee {
            background-color: rgba(108, 117, 125, 0.1);
            color: #6c757d;
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
        
        .btn-danger {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        
        .btn-danger:hover {
            background-color: rgba(220, 53, 69, 0.2);
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
            overflow-y: auto;
        }
        
        .modal-content {
            background-color: white;
            margin: 2rem auto;
            padding: 2rem;
            border-radius: 8px;
            width: 80%;
            max-width: 900px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .modal-header h3 {
            font-size: 1.5rem;
            color: var(--navy);
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--dark);
        }
        
        .order-details {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .order-section {
            margin-bottom: 1.5rem;
        }
        
        .order-section h4 {
            font-size: 1.1rem;
            color: var(--navy);
            margin-bottom: 0.75rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .order-products {
            width: 100%;
            margin-bottom: 1.5rem;
        }
        
        .order-products th {
            text-align: left;
            padding: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .order-products td {
            padding: 0.75rem 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .product-info {
            display: flex;
            align-items: center;
        }
        
        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 1rem;
        }
        
        .order-summary {
            background-color: rgba(0, 0, 117, 0.03);
            padding: 1.5rem;
            border-radius: 6px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .summary-total {
            font-weight: 600;
            font-size: 1.1rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }
        
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
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

            .modal-content {
                width: 95%;
                padding: 1.5rem;
            }
            
            .order-details {
                grid-template-columns: 1fr;
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
            <li><a href="#"><i class="fas fa-boxes"></i> Gestion des Stocks</a></li>
            <li><a href="#"><i class="fas fa-chart-bar"></i> Statistiques</a></li>
            <li><a href="#" class="active"><i class="fas fa-shopping-basket"></i> Gestion des Commandes</a></li>
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
            <h2>Gestion des Commandes</h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin Profile">
                <span>Admin</span>
            </div>
        </div>
        
        <!-- Search and Filter -->
        <div class="search-filter">
            <input type="text" class="search-box" placeholder="Rechercher une commande...">
            <select class="filter-select">
                <option value="">Tous les statuts</option>
                <option value="en-attente">En attente</option>
                <option value="confirmee">Confirmée</option>
                <option value="en-preparation">En préparation</option>
                <option value="en-cours-de-livraison">En cours de livraison</option>
                <option value="livree">Livrée</option>
                <option value="echec-de-la-livraison">Échec de la livraison</option>
                <option value="retournee">Retournée</option>
            </select>
            <select class="filter-select">
                <option value="">Toutes les dates</option>
                <option value="today">Aujourd'hui</option>
                <option value="week">Cette semaine</option>
                <option value="month">Ce mois</option>
            </select>
        </div>
        
        <!-- Orders Table -->
        <div class="orders-management">
            <div class="section-header">
                <h3>Liste des Commandes</h3>
                <button class="btn btn-primary">
                    <i class="fas fa-file-export"></i> Exporter
                </button>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>N° Commande</th>
                        <th>Client</th>
                        <th>Date</th>
                        <th>Montant</th>
                        <th>Paiement</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commandes as $commande)
                        <tr data-order-id="{{ $commande->id }}">
                            <td>{{ $commande->order_number }}</td>
                            <td>{{ $commande->firstname }} {{ $commande->lastname }}</td>
                            <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                            <td>{{ number_format($commande->total, 2, ',', ' ') }} Dhs</td>
                            <td>{{ $commande->is_payed ? 'Payé' : 'Non payé' }}</td>
                            <td>
                                <span class="status {{ strtolower(str_replace(' ', '-', $commande->status)) }}">
                                    {{ ucfirst($commande->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn btn-sm btn-edit" onclick="openOrderModal('{{ $commande->id }}')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-primary" onclick="showStatusOptions('{{ $commande->id }}')">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                    <form action="{{ route('dashboard.commandes.destroy', $commande->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette commande ?')">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Aucune commande trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

<!-- Order Details Modal -->
        @foreach($commandes as $commande)
        <div class="modal" id="orderModal-{{ $commande->id }}">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3>Détails de la Commande <span>{{ $commande->order_number }}</span></h3>
                            <button class="close-modal" onclick="closeModal('orderModal-{{ $commande->id }}')">&times;</button>
                        </div>
                        
                        <div class="order-section">
                            <h4>Produits</h4>
                            <table class="order-products">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Produit</th>
                                        <th>Prix unitaire</th>
                                        <th>Quantité</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($commande->products as $product)
                                        <tr>
                                            <td>
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nom }}" style="width: 60px; height: auto;">
                                                @else
                                                    <span>—</span>
                                                @endif
                                            </td>
                                            <td>{{ $product->nom ?? 'N/A' }}</td>
                                            <td>{{ number_format($product->pivot->price_ttc ?? 0, 2, ',', ' ') }} Dhs</td>
                                            <td>{{ $product->pivot->quantity ?? 0 }}</td>
                                            <td>{{ number_format(($product->pivot->price_ttc ?? 0) * ($product->pivot->quantity ?? 0), 2, ',', ' ') }} Dhs</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="5">Aucun produit trouvé pour cette commande</td></tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                
                <div class="order-details">
                    <div>
                        <div class="order-section">
                            <h4>Informations Client</h4>
                            <p><strong>Nom:</strong> {{ $commande->firstname }} {{ $commande->lastname }}</p>
                            <p><strong>Email:</strong> {{ $commande->email }}</p>
                            <p><strong>Téléphone:</strong> {{ $commande->phone }}</p>
                        </div>
                        
                        <div class="order-section">
                            <h4>Adresse de Livraison</h4>
                            <p>{{ $commande->address }}, {{ $commande->city }} {{ $commande->postcode }}</p>
                        </div>
                    </div>
                    
                    <div>
                        <div class="order-section">
                            <h4>Résumé de la Commande</h4>
                            <div class="order-summary">
                                <div class="summary-row">
                                    <span>Sous-total:</span>
                                    <span>{{ number_format($commande->total - $commande->shipping_price, 2, ',', ' ') }} Dhs</span>
                                </div>
                                <div class="summary-row">
                                    <span>Livraison:</span>
                                    <span>{{ number_format($commande->shipping_price, 2, ',', ' ') }} Dhs</span>
                                </div>
                                <div class="summary-row">
                                    <span>Remise:</span>
                                    <span>0.00 Dhs</span>
                                </div>
                                <div class="summary-row summary-total">
                                    <span>Total:</span>
                                    <span>{{ number_format($commande->total, 2, ',', ' ') }} Dhs</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-section">
                            <h4>Statut de la Commande</h4>
                            <p><strong>Statut:</strong> 
                                <span class="status {{ strtolower(str_replace(' ', '-', $commande->status)) }}">
                                    {{ ucfirst($commande->status) }}
                                </span>
                            </p>
                            <p><strong>Paiement:</strong> {{ $commande->is_payed ? 'Payé' : 'Non payé' }}</p>
                            <p><strong>Date:</strong> {{ $commande->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="modal-actions">
                    <button class="btn btn-edit" onclick="window.print()">
                        <i class="fas fa-print"></i> Imprimer
                    </button>
                    <button class="btn btn-primary" onclick="showStatusOptions('{{ $commande->id }}')">
                        <i class="fas fa-sync-alt"></i> Mettre à jour le statut
                    </button>
                </div>
            </div>
        </div>
        @endforeach

    <!-- Status Update Modal -->
        <div class="modal" id="statusModal">
            <form method="POST" id="statusForm">
                @csrf
                @method('PUT')

                <div class="modal-content" style="max-width: 500px;">
                    <div class="modal-header">
                        <h3>Mettre à jour le statut</h3>
                        <button class="close-modal" type="button" onclick="closeStatusModal()">&times;</button>
                    </div>
                    
                    <div class="order-section">
                        <p>Choisissez le nouveau statut pour la commande <strong id="statusOrderNumber"></strong></p>
                        
                        <select name="status" id="statusSelect" class="filter-select" style="width: 100%; margin-top: 1rem;">
                            <option value="en-attente">En attente</option>
                            <option value="confirmee">Confirmée</option>
                            <option value="en-preparation">En préparation</option>
                            <option value="en-cours-de-livraison">En cours de livraison</option>
                            <option value="livree">Livrée</option>
                            <option value="echec-de-la-livraison">Échec de la livraison</option>
                            <option value="retournee">Retournée</option>
                            <option value="annulee">annulée</option>
                        </select>

                        <div style="margin-top: 1.5rem;">
                            <label for="paymentStatus">Statut de paiement</label>
                            <select name="is_payed" id="paymentStatus" class="filter-select" style="width: 100%; margin-top: 0.5rem;">
                                <option value="1">Payé</option>
                                <option value="0">Non payé</option>
                            </select>
                        </div>

                        <div style="margin-top: 1rem;">
                            <label for="orderAddress">Adresse</label>
                            <input type="text" name="address" id="orderAddress" class="filter-select" style="width: 100%; margin-top: 0.5rem;" placeholder="Entrez l'adresse de livraison">
                        </div>

                        <div style="margin-top: 1rem;">
                            <label for="orderCity">Ville</label>
                            <input type="text" name="city" id="orderCity" class="filter-select" style="width: 100%; margin-top: 0.5rem;" placeholder="Entrez la ville de livraison">
                        </div>
                    </div>

                    <div class="modal-actions">
                        <button type="button" class="btn btn-edit" onclick="closeStatusModal()">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Mettre à jour
                        </button>
                    </div>
                </div>
            </form>
        </div>


<script>
    // Inject commandes from Laravel
    const commandes = @json($commandes->keyBy('id'));
    const csrfToken = '{{ csrf_token() }}';

    // Menu toggle functionality
    document.getElementById('menuToggle').addEventListener('click', function() {
        document.querySelector('.sidebar').classList.toggle('active');
    });

    // Order Modal Functions
    function openOrderModal(id) {
        document.getElementById(`orderModal-${id}`).style.display = "block";
    }

    function closeModal(modalId) {
        document.getElementById(modalId).style.display = "none";
    }

    // Status Modal Functions
    let currentOrderId = null;

    function showStatusOptions(orderId) {
        currentOrderId = orderId;

        const commande = commandes[orderId];
        if (!commande) {
            alert("Commande introuvable");
            return;
        }

        // Fill order number
        const orderNumber = document.querySelector(`tr[data-order-id="${orderId}"] td:first-child`).textContent;
        document.getElementById("statusOrderNumber").textContent = orderNumber;

        // Fill status
        const statusSelect = document.getElementById("statusSelect");
        const statusSlug = commande.status?.toLowerCase().replace(/\s/g, '-') || "en-attente";
        statusSelect.value = statusSlug;

        // Fill payment status
        document.getElementById("paymentStatus").value = commande.is_payed ? "1" : "0";


        // Fill address and city
        document.getElementById("orderAddress").value = commande.address || "";
        document.getElementById("orderCity").value = commande.city || "";

        // ✅ Set the form action dynamically
        document.getElementById("statusForm").action = `/dashboard/commandes/${orderId}`;

        // Show modal
        document.getElementById("statusModal").style.display = "block";
    }

    function closeStatusModal() {
        document.getElementById("statusModal").style.display = "none";
    }

    function updateStatus() {
        if (!currentOrderId) return;

        const statusMap = {
            'en-attente': 'En attente',
            'confirmee': 'Confirmée',
            'en-preparation': 'En préparation',
            'en-cours-de-livraison': 'En cours de livraison',
            'livree': 'Livrée',
            'echec-de-la-livraison': 'Échec de la livraison',
            'retournee': 'Retournée'
        };

        const newStatus = statusMap[document.getElementById("statusSelect").value] || "En attente";
        const isPayed = document.getElementById("paymentStatus").value === "paye" ? 1 : 0;
        const address = document.getElementById("orderAddress").value;
        const city = document.getElementById("orderCity").value;

        // Create and submit form manually
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/dashboard/commandes/${currentOrderId}`;

        // Add hidden inputs
        form.innerHTML = `
            <input type="hidden" name="_token" value="${csrfToken}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="status" value="${newStatus}">
            <input type="hidden" name="is_payed" value="${isPayed}">
            <input type="hidden" name="address" value="${address}">
            <input type="hidden" name="city" value="${city}">
        `;

        document.body.appendChild(form);
        form.submit();
    }
</script>




</body>
</html>