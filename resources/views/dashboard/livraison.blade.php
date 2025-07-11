<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Livraisons - Cave & Cellier</title>
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
        
        /* Delivery Management */
        .delivery-management {
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
            display: inline-block;
            min-width: 120px;
            text-align: center;
        }
        
        .status.en-attente {
            background-color: rgba(255, 193, 7, 0.15);
            color: #ff9800;
            border: 1px solid rgba(255, 193, 7, 0.3);
        }
        
        .status.confirmee {
            background-color: rgba(33, 150, 243, 0.15);
            color: #2196f3;
            border: 1px solid rgba(33, 150, 243, 0.3);
        }
        
        .status.en-preparation {
            background-color: rgba(156, 39, 176, 0.15);
            color: #9c27b0;
            border: 1px solid rgba(156, 39, 176, 0.3);
        }
        
        .status.en-cours-de-livraison, .status.en-transit, .status.en_transit {
            background-color: rgba(13, 110, 253, 0.15);
            color: #0d6efd;
            border: 1px solid rgba(13, 110, 253, 0.3);
        }
        
        .status.livree {
            background-color: rgba(25, 135, 84, 0.15);
            color: #198754;
            border: 1px solid rgba(25, 135, 84, 0.3);
        }
        
        .status.echec-de-la-livraison {
            background-color: rgba(220, 53, 69, 0.15);
            color: #dc3545;
            border: 1px solid rgba(220, 53, 69, 0.3);
        }
        
        .status.retournee {
            background-color: rgba(111, 66, 193, 0.15);
            color: #6f42c1;
            border: 1px solid rgba(111, 66, 193, 0.3);
        }
        
        .status.annulee {
            background-color: rgba(108, 117, 125, 0.15);
            color: #6c757d;
            border: 1px solid rgba(108, 117, 125, 0.3);
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
        
        .btn-track {
            background-color: rgba(32, 201, 151, 0.1);
            color: #20c997;
        }
        
        .btn-track:hover {
            background-color: rgba(32, 201, 151, 0.2);
        }
        
        /* Beautiful Tracking Info Style */
        .tracking-info {
            display: flex;
            flex-direction: column;
            gap: 10px;
            min-width: 180px;
        }
        
        .tracking-number {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            color: var(--navy);
            padding: 6px 10px;
            border-radius: 6px;
            background: linear-gradient(135deg, rgba(0,0,117,0.03) 0%, rgba(150,0,24,0.03) 100%);
            border: 1px solid rgba(0,0,117,0.08);
        }
        
        .tracking-number i {
            color: var(--gold);
            font-size: 1rem;
            width: 18px;
            text-align: center;
        }
        
        .tracking-date {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.8rem;
            color: #666;
            padding: 6px 10px;
            border-radius: 6px;
            background: linear-gradient(135deg, rgba(196,162,103,0.03) 0%, rgba(254,254,250,0.03) 100%);
            border: 1px solid rgba(196,162,103,0.08);
        }
        
        .tracking-date i {
            color: var(--gold);
            font-size: 0.9rem;
            width: 18px;
            text-align: center;
        }
        
        .tracking-status {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 0.85rem;
            font-weight: 500;
            background: white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            border: 1px solid rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .tracking-status i {
            font-size: 1.1rem;
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            transition: all 0.3s ease;
        }
        
        /* Beautiful Status Icons */
        .tracking-status.en-attente {
            color: #ff9800;
            background: linear-gradient(135deg, rgba(255,193,7,0.1) 0%, rgba(255,255,255,0.8) 100%);
            border: 1px solid rgba(255,193,7,0.2);
        }
        .tracking-status.en-attente i {
            background-color: rgba(255,193,7,0.15);
            color: #ff9800;
        }
        
        .tracking-status.confirmee {
            color: #2196f3;
            background: linear-gradient(135deg, rgba(33,150,243,0.1) 0%, rgba(255,255,255,0.8) 100%);
            border: 1px solid rgba(33,150,243,0.2);
        }
        .tracking-status.confirmee i {
            background-color: rgba(33,150,243,0.15);
            color: #2196f3;
        }
        
        .tracking-status.en-preparation {
            color: #9c27b0;
            background: linear-gradient(135deg, rgba(156,39,176,0.1) 0%, rgba(255,255,255,0.8) 100%);
            border: 1px solid rgba(156,39,176,0.2);
        }
        .tracking-status.en-preparation i {
            background-color: rgba(156,39,176,0.15);
            color: #9c27b0;
        }
        
        /* Enhanced En Transit/En Cours de Livraison Status */
        .tracking-status.en-cours-de-livraison,
        .tracking-status.en-transit,
        .tracking-status.en_transit {
            color: #0d6efd;
            background: linear-gradient(135deg, rgba(13,110,253,0.1) 0%, rgba(255,255,255,0.8) 100%);
            border: 1px solid rgba(13,110,253,0.2);
        }
        .tracking-status.en-cours-de-livraison i,
        .tracking-status.en-transit i,
        .tracking-status.en_transit i {
            background-color: rgba(13,110,253,0.15);
            color: #0d6efd;
        }
        
        .tracking-status.livree {
            color: #198754;
            background: linear-gradient(135deg, rgba(25,135,84,0.1) 0%, rgba(255,255,255,0.8) 100%);
            border: 1px solid rgba(25,135,84,0.2);
        }
        .tracking-status.livree i {
            background-color: rgba(25,135,84,0.15);
            color: #198754;
        }
        
        .tracking-status.echec-de-la-livraison {
            color: #dc3545;
            background: linear-gradient(135deg, rgba(220,53,69,0.1) 0%, rgba(255,255,255,0.8) 100%);
            border: 1px solid rgba(220,53,69,0.2);
        }
        .tracking-status.echec-de-la-livraison i {
            background-color: rgba(220,53,69,0.15);
            color: #dc3545;
        }
        
        .tracking-status.retournee {
            color: #6f42c1;
            background: linear-gradient(135deg, rgba(111,66,193,0.1) 0%, rgba(255,255,255,0.8) 100%);
            border: 1px solid rgba(111,66,193,0.2);
        }
        .tracking-status.retournee i {
            background-color: rgba(111,66,193,0.15);
            color: #6f42c1;
        }
        
        .tracking-status.annulee {
            color: #6c757d;
            background: linear-gradient(135deg, rgba(108,117,125,0.1) 0%, rgba(255,255,255,0.8) 100%);
            border: 1px solid rgba(108,117,125,0.2);
        }
        .tracking-status.annulee i {
            background-color: rgba(108,117,125,0.15);
            color: #6c757d;
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
            
            table {
                display: block;
                overflow-x: auto;
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
            <li><a href="#"><i class="fas fa-shopping-basket"></i> Gestion des Commandes</a></li>
            <li><a href="#" class="active"><i class="fas fa-truck"></i> Gestion des Livraisons</a></li>
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
            <h2>Gestion des Livraisons</h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin Profile">
                <span>Admin</span>
            </div>
        </div>
        
        <!-- Search and Filter -->
        <div class="search-filter">
            <input type="text" class="search-box" placeholder="Rechercher une livraison...">
            <select class="filter-select">
                <option value="">Tous les statuts</option>
                <option value="en-attente">En attente</option>
                <option value="confirmee">Confirmée</option>
                <option value="en-preparation">En préparation</option>
                <option value="en-cours-de-livraison">En cours de livraison</option>
                <option value="en-transit">En transit</option>
                <option value="livree">Livrée</option>
                <option value="echec-de-la-livraison">Échec de la livraison</option>
                <option value="retournee">Retournée</option>
                <option value="annulee">Annulée</option>
            </select>
            <select class="filter-select">
                <option value="">Tous les transporteurs</option>
                <option value="chronopost">Chronopost</option>
                <option value="colissimo">Colissimo</option>
                <option value="ups">UPS</option>
                <option value="dhl">DHL</option>
            </select>
        </div>
        
        <!-- Deliveries Table -->
        <div class="delivery-management">
            <div class="section-header">
                <h3>Suivi des Livraisons</h3>
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvelle Expédition
                </button>
            </div>
            
            <table>
                <thead>
                    <tr>
                        <th>N° Livraison</th>
                        <th>N° Commande</th>
                        <th>Client</th>
                        <th>Transporteur</th>
                        <th>Statut</th>
                        <th>Suivi</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($commandes as $commande)
                    <tr>
                        <td>{{ $commande->delivery_number ?? '—' }}</td>
                        <td>#{{ $commande->order_number }}</td>
                        <td>{{ $commande->firstname }} {{ $commande->lastname }}</td>
                        <td>{{ $commande->shipping_method ?? '—' }}</td>
                        <td>
                            @php
                                $status = $commande->status;
                                $statusClass = str_replace('_', '-', $status);
                                $statusLabel = ucfirst(str_replace(['-', '_'], ' ', $status));
                            @endphp
                            <span class="status {{ $statusClass }}">{{ $statusLabel }}</span>
                        </td>
                        <td>
                            <div class="tracking-info">
                                @if($commande->tracking_number)
                                    <span class="tracking-number">
                                        <i class="fas fa-shipping-fast"></i> {{ $commande->tracking_number }}
                                    </span>
                                @endif
                                @if($commande->shipping_date)
                                    <span class="tracking-date">
                                        <i class="far fa-calendar-check"></i> {{ date('d/m/Y', strtotime($commande->shipping_date)) }}
                                    </span>
                                @endif
                                <span class="tracking-status {{ $statusClass }}">
                                    @switch(str_replace('_', '-', $status))
                                        @case('en-attente')
                                            <i class="fas fa-hourglass-half"></i> 
                                            <span>En attente</span>
                                            @break
                                        @case('confirmee')
                                            <i class="fas fa-clipboard-check"></i> 
                                            <span>Confirmée</span>
                                            @break
                                        @case('en-preparation')
                                            <i class="fas fa-boxes"></i> 
                                            <span>En préparation</span>
                                            @break
                                        @case('en-cours-de-livraison')
                                        @case('en-transit')
                                        @case('en_transit')
                                            <i class="fas fa-truck-fast"></i> 
                                            <span>En transit</span>
                                            @break
                                        @case('livree')
                                            <i class="fas fa-check-double"></i> 
                                            <span>Livrée</span>
                                            @break
                                        @case('echec-de-la-livraison')
                                            <i class="fas fa-exclamation-triangle"></i> 
                                            <span>Échec</span>
                                            @break
                                        @case('retournee')
                                            <i class="fas fa-rotate-left"></i> 
                                            <span>Retour</span>
                                            @break
                                        @case('annulee')
                                            <i class="fas fa-times-circle"></i> 
                                            <span>Annulée</span>
                                            @break
                                    @endswitch
                                </span>
                            </div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="btn btn-sm btn-edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                @if($commande->tracking_number)
                                    <button class="btn btn-sm btn-track">
                                        <i class="fas fa-map-marked-alt"></i> Suivre
                                    </button>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Toggle sidebar on mobile
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
</body>
</html>