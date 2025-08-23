<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Catégories - Cave & Cellier</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard-category.css') }}">

    
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
            <li><a href="/dashboard"><i class="fas fa-tachometer-alt"></i> Tableau de Bord</a></li>
            <li><a href="/dashboard/categories" class="active"><i class="fas fa-tags"></i> Gestion des Catégories</a></li>
            <li><a href="/dashboard/produits"><i class="fas fa-wine-bottle"></i> Gestion des Produits</a></li>
            <li><a href="/dashboard/stock"><i class="fas fa-boxes"></i> Gestion des Stocks</a></li>
            <li><a href="/dashboard/statistique"><i class="fas fa-chart-bar"></i> Statistiques</a></li>
            <li><a href="/dashboard/commandes"><i class="fas fa-shopping-basket"></i> Gestion des Commandes</a></li>
            <li><a href="/dashboard/livraisons"><i class="fas fa-truck"></i> Gestion des Livraisons</a></li>
            <li><a href="/dashboard/contacts"><i class="fas fa-envelope"></i> Messages de Contact</a></li>
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
            <h2>Gestion des Catégories</h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin Profile">
                <span>Rose & Bouchon</span>
            </div>
        </div>
        
        <!-- Categories Table -->
        <div class="categories-table">
            <div class="section-header">
                <h3>Liste des Catégories</h3>
                <button class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter une Catégorie
                </button>
            </div>
    
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                    <!-- Category row -->
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>
                            {{ $category->nom }}
                            @if($category->children->count())
                                <button class="toggle-subcategories" data-target="subcat-{{ $category->id }}">
                                    <i class="fas fa-chevron-down"></i>
                                </button>
                            @endif
                        </td>
                        <td>{{ $category->slug }}</td>
                        <td>
                            <div class="action-btns">
                                <button class="btn btn-sm btn-edit">
                                    <i class="fas fa-edit"></i> Modifier
                                </button>
                                <button class="btn btn-sm btn-delete">
                                    <i class="fas fa-trash"></i> Supprimer
                                </button>
                                <button class="btn btn-sm btn-primary">
                                    <i class="fas fa-plus"></i> Sous-catégorie
                                </button>
                            </div>
                        </td>
                    </tr>

                    @if($category->children->count())
                        <tbody id="subcat-{{ $category->id }}" class="subcategories-container">
                            @foreach($category->children as $index => $sub)
                                <tr class="subcategory-row">
                                    <td>{{ $category->id }}.{{ $index + 1 }}</td>
                                    <td>{{ $sub->nom }}</td>
                                    <td>{{ $sub->slug }}</td>
                                    <td>
                                        <div class="action-btns">
                                            <button class="btn btn-sm btn-edit">
                                                <i class="fas fa-edit"></i> Modifier
                                            </button>
                                            <button class="btn btn-sm btn-delete">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    @endif
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

        // Toggle subcategories visibility
        document.querySelectorAll('.toggle-subcategories').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const subcategories = document.getElementById(targetId);
                subcategories.classList.toggle('show');
                
                // Toggle icon
                const icon = this.querySelector('i');
                if (subcategories.classList.contains('show')) {
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                } else {
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                }
            });
        });
    </script>
</body>
</html>