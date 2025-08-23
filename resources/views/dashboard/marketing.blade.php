<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketing Email - Cave & Cellier</title>
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
        }
        
        body {
            background-color: var(--ivory);
            color: var(--dark);
            display: flex;
            min-height: 100vh;
            overflow-x: hidden;
            font-family: 'Cormorant Garamond', serif;
        }
        
        /* Sidebar */
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
        
        .sidebar-menu a:hover, 
        .sidebar-menu a.active {
            background-color: rgba(196, 162, 103, 0.15);
            color: var(--ivory);
        }
        
        .sidebar-menu a:hover::before, 
        .sidebar-menu a.active::before {
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
        
        /* Main Content */
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
        
        /* Marketing Management */
        .marketing-management {
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
            background-color: var(--navy);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: #00005a;
        }
        
        .btn i {
            margin-right: 0.5rem;
        }
        
        .filter-section {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            align-items: flex-end;
        }
        
        .filter-group {
            display: flex;
            flex-direction: column;
        }
        
        .filter-group label {
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--navy);
        }
        
        .filter-select {
            padding: 0.6rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 0.95rem;
            background-color: white;
            min-width: 200px;
        }
        
        /* Recipients List */
        .recipients-list {
            margin-top: 1.5rem;
        }
        
        .recipients-count {
            font-weight: 500;
            color: var(--burgundy);
            margin-bottom: 1rem;
        }
        
        .recipients-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1.5rem;
        }
        
        .recipients-table th, 
        .recipients-table td {
            padding: 0.75rem 1rem;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 117, 0.05);
        }
        
        .recipients-table th {
            font-weight: 500;
            color: var(--navy);
            font-size: 0.9rem;
            background-color: #f5f5f5;
        }
        
        .recipients-table tr:hover {
            background-color: #f9f9f9;
        }
        
        .action-btns {
            display: flex;
            gap: 0.5rem;
            margin-top: 1.5rem;
            justify-content: flex-end;
        }
        
        .checkbox-cell {
            width: 40px;
            text-align: center;
        }
        
        /* Modal */
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
            max-width: 500px;
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
        
        .modal-actions {
            display: flex;
            justify-content: flex-end;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        /* Menu Toggle */
        .menu-toggle {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--navy);
            cursor: pointer;
            margin-right: 1rem;
        }
        
        /* Responsive */
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
            }
            
            .menu-toggle {
                display: block;
            }

            .modal-content {
                width: 95%;
                padding: 1.5rem;
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
            
            .filter-section {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .filter-select {
                width: 100%;
            }
            
            .action-btns {
                flex-direction: column;
            }
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
            <li><a href="/dashboard/livraisons" ><i class="fas fa-truck"></i> Gestion des Livraisons</a></li>
            <li><a href="/dashboard/contacts" ><i class="fas fa-envelope"></i> Messages de Contact</a></li>
            <li><a href="/dashboard/events" ><i class="fas fa-calendar-alt"></i> Participations Événements</a></li>
            <li><a href="/dashboard/marketing" class="active"><i class="fas fa-bullhorn"></i> Marketing & Email</a></li>
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
            <h2>Email Marketing</h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin Profile">
                <span>Rose & Bouchon</span>
            </div>
        </div>
        
        <div class="marketing-management">
    <!-- Filter Section -->
    <div class="filter-section">
        <form method="GET" action="{{ route('marketing.index') }}">
            <div class="filter-group">
                <label for="categoryFilter">Filtrer par catégorie</label>
                <select class="filter-select" id="categoryFilter" name="category_id">
                    <option value="all" {{ request('category_id') === 'all' ? 'selected' : '' }}>Toutes les catégories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button class="btn btn-primary" type="submit">
                <i class="fas fa-filter"></i> Filtrer
            </button>
        </form>
    </div>

    <!-- Recipients List -->
    <div class="recipients-list">
        <h4>Sélectionnez les destinataires</h4>
        <p class="recipients-count">{{ count($clients) }} clients trouvés</p>

        <form method="POST" action="{{ route('marketing.send') }}">
            @csrf
            <table class="recipients-table">
                <thead>
                    <tr>
                        <th class="checkbox-cell"><input type="checkbox" id="selectAll"></th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Catégories achetées</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clients as $client)
                        <tr>
                            <td class="checkbox-cell">
                                <input type="checkbox" class="client-checkbox" name="client_emails[]" value="{{ $client['email'] }}">
                            </td>
                            <td>{{ $client['lastname'] }}</td>
                            <td>{{ $client['firstname'] }}</td>
                            <td>{{ $client['email'] }}</td>
                            <td>{{ implode(', ', $client['categories']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="action-btns">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-paper-plane"></i> Envoyer aux clients sélectionnés
                </button>
            </div>
        </form>
    </div>
</div>
    </div>


    <script>
        // Menu toggle functionality
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });
    </script>
    <script>
    document.getElementById('selectAll').addEventListener('change', function () {
        let checkboxes = document.querySelectorAll('.client-checkbox');
        checkboxes.forEach(cb => cb.checked = this.checked);
    });
</script>

</body>
</html>