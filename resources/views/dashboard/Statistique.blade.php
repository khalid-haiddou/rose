<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - Cave & Cellier</title>
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
        
        /* Stats Cards */
        .stats-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .stat-card {
            background-color: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            border-top: 3px solid var(--gold);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        
        .stat-card-header h3 {
            font-size: 1.1rem;
            color: var(--navy);
            font-weight: 500;
        }
        
        .stat-card-header i {
            font-size: 1.25rem;
            color: var(--burgundy);
        }
        
        .stat-card-value {
            font-size: 2rem;
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 0.5rem;
        }
        
        .stat-card-description {
            font-size: 0.9rem;
            color: rgba(18, 18, 18, 0.7);
        }
        
        .trend-up {
            color: #28a745;
        }
        
        .trend-down {
            color: #dc3545;
        }
        
        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        
        @media (max-width: 992px) {
            .charts-section {
                grid-template-columns: 1fr;
            }
        }
        
        .chart-container {
            background-color: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }
        
        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .chart-header h3 {
            font-size: 1.25rem;
            color: var(--navy);
            font-weight: 500;
        }
        
        .chart-header select {
            padding: 0.5rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            background-color: white;
        }
        
        .chart-placeholder {
            height: 300px;
            background-color: #f8f9fa;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(0, 0, 0, 0.3);
            font-size: 1.1rem;
        }
        
        /* Recent Activity */
        .recent-activity {
            background-color: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }
        
        .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .activity-header h3 {
            font-size: 1.25rem;
            color: var(--navy);
            font-weight: 500;
        }
        
        .activity-header a {
            color: var(--burgundy);
            text-decoration: none;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
        }
        
        .activity-header a i {
            margin-left: 0.5rem;
        }
        
        .activity-item {
            display: flex;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(196, 162, 103, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: var(--gold);
            font-size: 1rem;
        }
        
        .activity-content {
            flex: 1;
        }
        
        .activity-title {
            font-weight: 500;
            margin-bottom: 0.25rem;
        }
        
        .activity-description {
            font-size: 0.9rem;
            color: rgba(18, 18, 18, 0.7);
        }
        
        .activity-time {
            font-size: 0.8rem;
            color: rgba(18, 18, 18, 0.5);
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
            .stats-cards {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .user-profile {
                margin-top: 1rem;
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
        
        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .stat-card {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        .stat-card:nth-child(1) { animation-delay: 0.1s; }
        .stat-card:nth-child(2) { animation-delay: 0.2s; }
        .stat-card:nth-child(3) { animation-delay: 0.3s; }
        .stat-card:nth-child(4) { animation-delay: 0.4s; }
        
        .chart-container {
            animation: fadeIn 0.6s ease-out forwards;
            animation-delay: 0.5s;
        }
        
        .recent-activity {
            animation: fadeIn 0.7s ease-out forwards;
            animation-delay: 0.6s;
        }

        /* Filter dropdown */
        .stat-filter {
            padding: 0.5rem 1rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 4px;
            background-color: white;
            margin-bottom: 1.5rem;
            font-size: 0.95rem;
            color: var(--navy);
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
            <li><a href="/dashboard/produits" ><i class="fas fa-wine-bottle"></i> Gestion des Produits</a></li>
            <li><a href="/dashboard/stock"><i class="fas fa-boxes"></i> Gestion des Stocks</a></li>
            <li><a href="/dashboard/statistique" class="active"><i class="fas fa-chart-bar"></i> Statistiques</a></li>
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
            <h2>Statistiques</h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin Profile">
                <span>Rose & Bouchon</span>
            </div>
        </div>
        
        <form method="GET" action="{{ route('dashboard.stats') }}">
            <select name="periode" class="stat-filter" onchange="this.form.submit()">
                <option value="month" {{ $filter === 'month' ? 'selected' : '' }}>Ce mois</option>
                <option value="last_month" {{ $filter === 'last_month' ? 'selected' : '' }}>Mois dernier</option>
                <option value="year" {{ $filter === 'year' ? 'selected' : '' }}>Cette année</option>
            </select>
        </form>

        <div class="stats-cards">
            <!-- Chiffre d'affaires -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Chiffre d'affaires</h3>
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-card-value">
                    {{ number_format($chiffreAffaires, 2, ',', ' ') }} Dhs
                </div>
            </div>

            <!-- Commandes -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Commandes</h3>
                    <i class="fas fa-shopping-basket"></i>
                </div>
                <div class="stat-card-value">
                    {{ $commandesCount }}
                </div>
            </div>

            <!-- Clients -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Clients</h3>
                    <i class="fas fa-user-plus"></i>
                </div>
                <div class="stat-card-value">
                    {{ $clients }}
                </div>
            </div>

            <!-- Total Commandes livrées -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Total Commandes livrées</h3>
                    <i class="fas fa-box"></i>
                </div>
                <div class="stat-card-value">
                    {{ $livrees }}
                </div>
            </div>

            <!-- Best Seller -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Best Seller</h3>
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-card-value">
                    {{ $bestSeller ?? 'Aucun' }}
                </div>
            </div>

            <!-- Panier moyen -->
            <div class="stat-card">
                <div class="stat-card-header">
                    <h3>Panier moyen</h3>
                    <i class="fas fa-cart-plus"></i>
                </div>
                <div class="stat-card-value">
                    {{ number_format($panierMoyen, 2, ',', ' ') }} Dhs
                </div>
            </div>
        </div>
        
        <!-- Charts Section -->
        <div class="charts-section">
            <!-- Ventes Mensuelles -->
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Ventes mensuelles</h3>
                </div>
                <canvas id="monthlySalesChart" height="300"></canvas>
            </div>

            <!-- Top Catégories -->
            <div class="chart-container">
                <div class="chart-header">
                    <h3>Top catégories</h3>
                </div>
                <canvas id="topCategoriesChart" height="300"></canvas>
            </div>
        </div>
    </div>

    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Toggle sidebar on mobile
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Monthly Sales Chart
        const monthlySalesCtx = document.getElementById('monthlySalesChart').getContext('2d');
        const monthlySalesChart = new Chart(monthlySalesCtx, {
            type: 'line',
            data: {
                labels: @json($monthlySales['labels']),
                datasets: [{
                    label: 'Chiffre d\'affaires (Dhs)',
                    data: @json($monthlySales['data']),
                    backgroundColor: 'rgba(196, 162, 103, 0.1)',
                    borderColor: 'rgba(196, 162, 103, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y.toLocaleString('fr-FR') + ' Dhs';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('fr-FR') + ' Dhs';
                            }
                        }
                    }
                }
            }
        });

        // Top Categories Chart
        const topCategoriesCtx = document.getElementById('topCategoriesChart').getContext('2d');
        const topCategoriesChart = new Chart(topCategoriesCtx, {
            type: 'bar',
            data: {
                labels: @json($topCategories['labels']),
                datasets: [{
                    label: 'Nombre de commandes',
                    data: @json($topCategories['data']),
                    backgroundColor: [
                        'rgba(0, 0, 117, 0.7)',
                        'rgba(150, 0, 24, 0.7)',
                        'rgba(196, 162, 103, 0.7)',
                        'rgba(18, 18, 18, 0.7)',
                        'rgba(254, 254, 250, 0.7)'
                    ],
                    borderColor: [
                        'rgba(0, 0, 117, 1)',
                        'rgba(150, 0, 24, 1)',
                        'rgba(196, 162, 103, 1)',
                        'rgba(18, 18, 18, 1)',
                        'rgba(254, 254, 250, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' commandes';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });

        // Filter change handlers (for future implementation)
        document.getElementById('monthly-sales-filter').addEventListener('change', function() {
            // You can implement AJAX call here to update the chart data
            console.log('Filter changed to:', this.value);
        });

        document.getElementById('top-categories-filter').addEventListener('change', function() {
            // You can implement AJAX call here to update the chart data
            console.log('Filter changed to:', this.value);
        });
    </script>
</body>
</html>