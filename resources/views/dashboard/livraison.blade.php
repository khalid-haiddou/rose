<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Livraisons - Cave & Cellier</title>

    <link rel="stylesheet" href="{{ asset('assets/css/dashboard-livraison.css') }}">
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
            <li><a href="/dashboard/livraisons" class="active"><i class="fas fa-truck"></i> Gestion des Livraisons</a></li>
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
            <h2>Gestion des Livraisons</h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin Profile">
                <span>Rose & Bouchon</span>
            </div>
        </div>
        
        <!-- Search and Filter -->
        <form method="GET" action="{{ route('livraisons.index') }}" class="search-filter">
            <input type="text" name="search" value="{{ request('search') }}" class="search-box" placeholder="Rechercher une livraison...">

            <select name="status" class="filter-select">
                <option value="">Tous les statuts</option>
                @foreach ([
                    'en-attente' => 'En attente',
                    'confirmee' => 'Confirmée',
                    'en-preparation' => 'En préparation',
                    'en-cours-de-livraison' => 'En cours de livraison',
                    'en-transit' => 'En transit',
                    'livree' => 'Livrée',
                    'echec-de-la-livraison' => 'Échec de la livraison',
                    'retournee' => 'Retournée',
                    'annulee' => 'Annulée',
                ] as $value => $label)
                    <option value="{{ $value }}" {{ request('status') === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>
        
        <!-- Deliveries Table -->
        <div class="delivery-management">
            <div class="section-header">
                <h3>Suivi des Livraisons</h3>
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
                                <button class="btn btn-sm btn-edit"
                                    onclick="openEditModal({{ $commande->id }}, '{{ $commande->delivery_number }}', '{{ $commande->order_number }}', '{{ $commande->status }}')">
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
        <!--pagination -->
        <div class="pagination-container">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    {{-- Previous Page Link --}}
                    @if ($commandes->onFirstPage())
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">
                                <i class="fas fa-chevron-left"></i>
                            </span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $commandes->previousPageUrl() }}" rel="prev">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($commandes->getUrlRange(1, $commandes->lastPage()) as $page => $url)
                        @if ($page == $commandes->currentPage())
                            <li class="page-item active" aria-current="page">
                                <span class="page-link">{{ $page }}</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($commandes->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $commandes->nextPageUrl() }}" rel="next">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    @else
                        <li class="page-item disabled" aria-disabled="true">
                            <span class="page-link">
                                <i class="fas fa-chevron-right"></i>
                            </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>

    <!-- Edit Delivery Modal -->
<div class="modal" id="editDeliveryModal">
    <div class="modal-content">
        <div class="modal-header">
            <h3>Mettre à jour la livraison</h3>
            <button class="close-modal" onclick="closeModal()">&times;</button>
        </div>

        <form method="POST" action="{{ route('livraison.updateDeliveryNumber', ['commande' => '__ID__']) }}" id="deliveryUpdateForm">
            @csrf
            @method('PUT')

            <input type="hidden" id="commandeId">

            <!-- Order Number (readonly) -->
            <div class="form-group">
                <label for="orderNumber">Numéro de commande</label>
                <input type="text" class="form-control" id="orderNumber" readonly>
            </div>

            <!-- Delivery Number -->
            <div class="form-group">
                <label for="deliveryNumber">Numéro de livraison *</label>
                <input type="text" class="form-control" id="deliveryNumber" name="delivery_number" required>
            </div>

            <!-- Status Dropdown -->
            <div class="form-group">
                <label for="status">Statut de la commande</label>
                <select name="status" id="status" class="form-control" required>
                    <option value="confirmee">Confirmée</option>
                    <option value="en-preparation">En préparation</option>
                    <option value="en-cours-de-livraison">En cours de livraison</option>
                    <option value="livree">Livrée</option>
                    <option value="echec-de-la-livraison">Échec de la livraison</option>
                    <option value="retournee">Retournée</option>
                    <option value="annulee">annulée</option>
                    <option value="en-transit">en transit</option>
                </select>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Annuler</button>
                <button type="submit" class="btn btn-primary">Enregistrer</button>
            </div>
        </form>
    </div>
</div>



<script>
    // Toggle sidebar
    document.getElementById('menuToggle').addEventListener('click', function () {
        document.querySelector('.sidebar').classList.toggle('active');
    });

    // Show modal and populate fields
    function openEditModal(commandeId, deliveryNumber, orderNumber, currentStatus = '') {
        const modal = document.getElementById('editDeliveryModal');
        document.getElementById('commandeId').value = commandeId;
        document.getElementById('orderNumber').value = orderNumber;
        document.getElementById('deliveryNumber').value = deliveryNumber ?? '';

        // Set current status if provided
        if (document.getElementById('status')) {
            document.getElementById('status').value = currentStatus;
        }

        const form = document.getElementById('deliveryUpdateForm');
        const routeTemplate = "{{ route('livraison.updateDeliveryNumber', ['commande' => '__ID__']) }}";
        form.action = routeTemplate.replace('__ID__', commandeId);

        modal.style.display = 'flex';
    }

    function closeModal() {
        document.getElementById('editDeliveryModal').style.display = 'none';
    }

    // Close modal when clicking outside
    window.addEventListener('click', function (event) {
        const modal = document.getElementById('editDeliveryModal');
        if (event.target === modal) {
            closeModal();
        }
    });
</script>



</body>
</html>