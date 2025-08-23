<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participations aux Événements - Cave & Cellier</title>
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
        
        /* Participations Management */
        .participations-management {
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
        
        .status.annulee {
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
        
        .btn-view {
            background-color: rgba(0, 0, 117, 0.1);
            color: var(--navy);
        }
        
        .btn-view:hover {
            background-color: rgba(0, 0, 117, 0.2);
        }
        
        .btn-confirm {
            background-color: rgba(32, 201, 151, 0.1);
            color: #20c997;
        }
        
        .btn-confirm:hover {
            background-color: rgba(32, 201, 151, 0.2);
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
            max-width: 700px;
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
        
        .participation-details {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .participation-section {
            margin-bottom: 1.5rem;
        }
        
        .participation-section h4 {
            font-size: 1.1rem;
            color: var(--navy);
            margin-bottom: 0.75rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .participant-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .participant-info p {
            margin-bottom: 0.5rem;
        }
        
        .participant-info strong {
            color: var(--navy);
            font-weight: 500;
        }
        
        .comments-content {
            background-color: rgba(0, 0, 117, 0.03);
            padding: 1.5rem;
            border-radius: 6px;
            line-height: 1.6;
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
            
            .participant-info {
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
        
        .pagination-container {
            margin-top: 3rem;
            display: flex;
            justify-content: center;
        }

        .pagination {
            display: flex;
            list-style: none;
            padding: 0;
            border-radius: 4px;
            overflow: hidden;
        }

        .page-item {
            margin: 0 2px;
        }

        .page-link {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 40px;
            height: 40px;
            padding: 0 12px;
            color: #000075; /* Navy */
            background-color: #FEFEFA; /* Ivory */
            border: 1px solid rgba(150, 0, 24, 0.1); /* Burgundy tint */
            font-family: 'Cormorant Garamond', serif;
            font-weight: 500;
            font-size: 1.1rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .page-link:hover {
            color: #960018; /* Burgundy */
            background-color: rgba(150, 0, 24, 0.05);
            border-color: rgba(150, 0, 24, 0.2);
        }

        .page-item.active .page-link {
            color: white;
            background: linear-gradient(135deg, #000075, #960018); /* Navy to Burgundy */
            border-color: transparent;
            box-shadow: 0 2px 8px rgba(150, 0, 24, 0.2);
        }

        .page-item.disabled .page-link {
            color: rgba(18, 18, 18, 0.3); /* Dark with opacity */
            background-color: rgba(254, 254, 250, 0.5); /* Ivory with opacity */
            pointer-events: none;
        }

        .page-link i {
            font-size: 0.9rem;
        }
        
        .status-dropdown {
            padding: 5px 8px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 0.95rem;
        }
        
        .comments-cell {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
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
            <h1>Rose & Bouchon</h1>
        </div>
        
        <ul class="sidebar-menu">
            <li><a href="/dashboard" ><i class="fas fa-tachometer-alt"></i> Tableau de Bord</a></li>
            <li><a href="/dashboard/categories" ><i class="fas fa-tags"></i> Gestion des Catégories</a></li>
            <li><a href="/dashboard/produits"><i class="fas fa-wine-bottle"></i> Gestion des Produits</a></li>
            <li><a href="/dashboard/stock"><i class="fas fa-boxes"></i> Gestion des Stocks</a></li>
            <li><a href="/dashboard/statistique"><i class="fas fa-chart-bar"></i> Statistiques</a></li>
            <li><a href="/dashboard/commandes" ><i class="fas fa-shopping-basket"></i> Gestion des Commandes</a></li>
            <li><a href="/dashboard/livraisons"><i class="fas fa-truck"></i> Gestion des Livraisons</a></li>
            <li><a href="/dashboard/contacts" ><i class="fas fa-envelope"></i> Messages de Contact</a></li>
            <li><a href="/dashboard/events" class="active"><i class="fas fa-calendar-alt"></i> Participations Événements</a></li>
            <li><a href="/dashboard/marketing"><i class="fas fa-bullhorn"></i> Marketing & Email</a></li>
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
            <h2>Participations aux Événements</h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin Profile">
                <span>Rose & Bouchon</span>
            </div>
        </div>
        
        <form method="GET" action="{{ route('dashboard.events') }}" class="search-filter">
            <select name="status" class="filter-select">
                <option value="">Tous les statuts</option>
                <option value="en-attente" {{ request('status') == 'en-attente' ? 'selected' : '' }}>En attente</option>
                <option value="confirmee" {{ request('status') == 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                <option value="annulee" {{ request('status') == 'annulee' ? 'selected' : '' }}>Annulée</option>
            </select>
            
            <select name="date_filter" class="filter-select">
                <option value="">Toutes les dates</option>
                <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Aujourd'hui</option>
                <option value="yesterday" {{ request('date_filter') == 'yesterday' ? 'selected' : '' }}>Hier</option>
                <option value="week" {{ request('date_filter') == 'week' ? 'selected' : '' }}>Cette semaine</option>
                <option value="month" {{ request('date_filter') == 'month' ? 'selected' : '' }}>Ce mois</option>
            </select>
            
            <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>
        
        <!-- Participations Table -->
        <div class="participations-management">
            <div class="section-header">
                <h3>Liste des Participations</h3>
            </div>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>Participant</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Commentaires</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($participations as $participation)
                        <tr data-participation-id="{{ $participation->id }}">
                            <td>{{ $participation->firstname }} {{ $participation->lastname }}</td>
                            <td>{{ $participation->email }}</td>
                            <td>{{ $participation->phone }}</td>
                            <td class="comments-cell" title="{{ e($participation->comments) }}">
                                {{ $participation->comments ? Str::limit($participation->comments, 30) : 'Aucun' }}
                            </td>
                            <td>{{ $participation->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <form action="{{ route('dashboard.events.updateStatus', $participation->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" class="status-dropdown {{ $participation->status }}" onchange="this.form.submit()">
                                        <option value="en-attente" {{ $participation->status === 'en-attente' ? 'selected' : '' }}>En attente</option>
                                        <option value="confirmee" {{ $participation->status === 'confirmee' ? 'selected' : '' }}>Confirmée</option>
                                        <option value="annulee" {{ $participation->status === 'annulee' ? 'selected' : '' }}>Annulée</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button type="button" class="btn btn-sm btn-view" onclick="openParticipationModal('{{ $participation->id }}')">
                                        <i class="fas fa-eye"></i> Voir
                                    </button>

                                    <form action="{{ route('dashboard.events.destroy', $participation->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette participation ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Aucune participation trouvée.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        
        
    </div>

    <!-- Participation Details Modal -->
    @foreach($participations as $participation)
        <div class="modal" id="participationModal-{{ $participation->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Participation de {{ $participation->firstname }} {{ $participation->lastname }}</h3>
                    <button class="close-modal" onclick="closeModal('participationModal-{{ $participation->id }}')">&times;</button>
                </div>
                
                <div class="participation-details">
                    <div class="participant-info">
                        <div>
                            <h4>Informations du participant</h4>
                            <p><strong>Nom:</strong> {{ $participation->firstname }} {{ $participation->lastname }}</p>
                            <p><strong>Email:</strong> {{ $participation->email }}</p>
                            <p><strong>Téléphone:</strong> {{ $participation->phone }}</p>
                        </div>
                        
                        <div>
                            <h4>Détails de la participation</h4>
                            <p><strong>Date:</strong> {{ $participation->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Statut:</strong> 
                                <span class="status {{ $participation->status }}">
                                    @if($participation->status == 'en-attente')
                                        En attente
                                    @elseif($participation->status == 'confirmee')
                                        Confirmée
                                    @else
                                        Annulée
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="participation-section">
                        <h4>Commentaires & Informations</h4>
                        <div class="comments-content">
                            {{ $participation->comments ?? 'Aucun commentaire fourni' }}
                        </div>
                    </div>
                    
                    <div class="modal-actions">
                        <form action="{{ route('dashboard.events.updateStatus', $participation->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="confirmee">
                            <button type="submit" class="btn btn-confirm">
                                <i class="fas fa-check"></i> Confirmer
                            </button>
                        </form>
                        
                        <form action="{{ route('dashboard.events.updateStatus', $participation->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="annulee">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times"></i> Annuler
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script>
        // Menu toggle functionality
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Participation Modal Functions
        function openParticipationModal(id) {
            document.getElementById(`participationModal-${id}`).style.display = "block";
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = "none";
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            if (event.target.className === 'modal') {
                event.target.style.display = 'none';
            }
        }
    </script>
</body>
</html>