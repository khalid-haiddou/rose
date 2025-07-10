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
        }
        
        .status.pending {
            background-color: rgba(255, 193, 7, 0.1);
            color: #ffc107;
        }
        
        .status.in-transit {
            background-color: rgba(13, 110, 253, 0.1);
            color: #0d6efd;
        }
        
        .status.delivered {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
        }
        
        .status.failed {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
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
        
        /* Delivery Progress */
        .delivery-progress {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .progress-steps {
            flex: 1;
            display: flex;
            justify-content: space-between;
            position: relative;
        }
        
        .progress-steps::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 2px;
            background-color: rgba(0, 0, 0, 0.1);
            z-index: 1;
        }
        
        .progress-bar {
            position: absolute;
            top: 50%;
            left: 0;
            height: 2px;
            background-color: var(--gold);
            z-index: 2;
            transition: width 0.3s ease;
        }
        
        .step {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: white;
            border: 2px solid rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            z-index: 3;
        }
        
        .step.active {
            border-color: var(--gold);
            background-color: var(--gold);
            color: white;
        }
        
        .step.completed {
            border-color: var(--gold);
            background-color: var(--gold);
            color: white;
        }
        
        .step-label {
            position: absolute;
            top: 100%;
            margin-top: 0.5rem;
            font-size: 0.7rem;
            white-space: nowrap;
            color: rgba(0, 0, 0, 0.6);
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
            
            .delivery-progress {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }
            
            .progress-steps {
                width: 100%;
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
                <option value="pending">En préparation</option>
                <option value="in-transit">En cours</option>
                <option value="delivered">Livrée</option>
                <option value="failed">Échouée</option>
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
                                $statusClass = match ($status) {
                                    'en-preparation' => 'pending',
                                    'en-cours-de-livraison' => 'in-transit',
                                    'livree' => 'delivered',
                                    'echec-de-la-livraison' => 'failed',
                                    default => '',
                                };
                            @endphp
                            <span class="status {{ $statusClass }}">{{ ucfirst(str_replace('-', ' ', $status)) }}</span>
                        </td>
                        <td>
                            {{-- You can generate progress dynamically later --}}
                            <div class="delivery-progress">
                                <div class="progress-steps">
                                    {{-- Example for now --}}
                                    <div class="progress-bar" style="width: 0%;"></div>
                                    <div class="step active">
                                        <i class="fas fa-box" style="font-size: 0.6rem;"></i>
                                        <span class="step-label">Préparée</span>
                                    </div>
                                    <div class="step">
                                        <i class="fas fa-truck" style="font-size: 0.6rem;"></i>
                                        <span class="step-label">En transit</span>
                                    </div>
                                    <div class="step">
                                        <i class="fas fa-home" style="font-size: 0.6rem;"></i>
                                        <span class="step-label">Livrée</span>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="action-btns">
                                <button class="btn btn-sm btn-edit">
                                    <i class="fas fa-edit"></i>
                                </button>
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