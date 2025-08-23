<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Commandes - Cave & Cellier</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard-commande.css') }}">
    
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
            <li><a href="/dashboard/categories" ><i class="fas fa-tags"></i> Gestion des Catégories</a></li>
            <li><a href="/dashboard/produits"><i class="fas fa-wine-bottle"></i> Gestion des Produits</a></li>
            <li><a href="/dashboard/stock"><i class="fas fa-boxes"></i> Gestion des Stocks</a></li>
            <li><a href="/dashboard/statistique"><i class="fas fa-chart-bar"></i> Statistiques</a></li>
            <li><a href="/dashboard/commandes" class="active"><i class="fas fa-shopping-basket"></i> Gestion des Commandes</a></li>
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
            <h2>Gestion des Commandes</h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin Profile">
                <span>Rose & Bouchon</span>
            </div>
        </div>
        
        <form method="GET" action="{{ route('dashboard.commandes') }}" class="search-filter d-flex gap-2 mb-3">
            <input type="text" name="search" value="{{ request('search') }}" class="search-box form-control" placeholder="Rechercher nom ou N° commande...">

                <select name="status" class="filter-select form-select">
                    <option value="">Tous les statuts</option>
                    @foreach(['en-attente', 'confirmee', 'en-preparation', 'en-cours-de-livraison', 'livree', 'echec-de-la-livraison', 'retournee', 'annulee', 'en-transit'] as $statut)
                        <option value="{{ $statut }}" {{ request('status') == $statut ? 'selected' : '' }}>
                            {{ ucfirst(str_replace('-', ' ', $statut)) }}
                        </option>
                    @endforeach
                </select>

                <select name="date_filter" class="filter-select form-select">
                    <option value="">Toutes les dates</option>
                    <option value="today" {{ request('date_filter') == 'today' ? 'selected' : '' }}>Aujourd'hui</option>
                    <option value="yesterday" {{ request('date_filter') == 'yesterday' ? 'selected' : '' }}>Hier</option>
                    <option value="week" {{ request('date_filter') == 'week' ? 'selected' : '' }}>Cette semaine</option>
                    <option value="month" {{ request('date_filter') == 'month' ? 'selected' : '' }}>Ce mois</option>
                    <option value="year" {{ request('date_filter') == 'year' ? 'selected' : '' }}>Cette année</option>
                </select>

                <button type="submit" class="btn btn-primary">Filtrer</button>
        </form>

        
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
                                        <span>{{ number_format($commande->fidelity_used ?? 0, 2, ',', ' ') }} Dhs</span>
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
                            <option value="en-transit">en transit</option>
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
            'retournee': 'Retournée',
            'en-transit': 'En transit'
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