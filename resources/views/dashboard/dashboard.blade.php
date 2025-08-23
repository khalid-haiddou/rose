<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Admin - Cave & Cellier</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
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
            <li><a href="/dashboard" class="active"><i class="fas fa-tachometer-alt"></i> Tableau de Bord</a></li>
            <li><a href="/dashboard/categories" ><i class="fas fa-tags"></i> Gestion des Catégories</a></li>
            <li><a href="/dashboard/produits"><i class="fas fa-wine-bottle"></i> Gestion des Produits</a></li>
            <li><a href="/dashboard/stock"><i class="fas fa-boxes"></i> Gestion des Stocks</a></li>
            <li><a href="/dashboard/statistique"><i class="fas fa-chart-bar"></i> Statistiques</a></li>
            <li><a href="/dashboard/commandes" ><i class="fas fa-shopping-basket"></i> Gestion des Commandes</a></li>
            <li><a href="/dashboard/livraisons"><i class="fas fa-truck"></i> Gestion des Livraisons</a></li>
            <li><a href="/dashboard/contacts" ><i class="fas fa-envelope"></i> Messages de Contact</a></li>
            <li><a href="/dashboard/events" ><i class="fas fa-calendar-alt"></i> Participations Événements</a></li>
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
            <h2>Tableau de Bord</h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin Profile">
                <span>Rose & Bouchon</span>
            </div>
        </div>
        
        <!-- Stats Cards -->
        <div class="cards-grid">
            <div class="card">
                <div class="card-header">
                    <h3>Commandes Aujourd'hui</h3>
                    <i class="fas fa-shopping-basket"></i>
                </div>
                <div class="card-value">{{ $commandesTodayCount }}</div>
                <div class="card-description">—</div> {{-- Optional: Add growth calc --}}
            </div>

            <div class="card">
                <div class="card-header">
                    <h3>Produits en Stock</h3>
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="card-value">{{ $productsInStock }}</div>
                <div class="card-description">{{ $outOfStock }} en rupture</div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <h3>Livraisons en Cours</h3>
                    <i class="fas fa-truck"></i>
                </div>
                <div class="card-value">{{ $deliveriesInProgress }}</div>
                <div class="card-description">{{ $deliveriesDone }} livrées</div>
            </div>
        </div>

        
        <!-- Recent Orders -->
<div class="recent-orders">
    <div class="section-header">
        <h3>Commandes Récentes</h3>
        <a href="{{ route('dashboard.commandes') }}">Voir Tout <i class="fas fa-chevron-right"></i></a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>N° Commande</th>
                <th>Client</th>
                <th>Date</th>
                <th>Montant</th>
                <th>Statut</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentCommandes as $commande)
                <tr>
                    <td>#{{ $commande->order_number }}</td>
                    <td>{{ $commande->firstname }} {{ $commande->lastname }}</td>
                    <td>{{ $commande->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($commande->total, 2, ',', ' ') }} Dhs</td>
                    <td>
                        @php
                            $statusClass = match($commande->status) {
                                'livree' => 'completed',
                                'en-cours-de-livraison', 'en-transit' => 'shipped',
                                'en-attente' => 'pending',
                                default => 'pending'
                            };
                        @endphp
                        <span class="status {{ $statusClass }}">
                            {{ ucfirst(str_replace(['-', '_'], ' ', $commande->status)) }}
                        </span>
                    </td>
                    <td>
                        <a href="{{ route('dashboard.commandes') }}"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Aucune commande récente.</td></tr>
            @endforelse
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