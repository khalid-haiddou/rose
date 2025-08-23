<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messages de Contact - Cave & Cellier</title>
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
        
        /* Messages Management */
        .messages-management {
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
        
        .status.non-lu {
            background-color: rgba(220, 53, 69, 0.1);
            color: #dc3545;
        }
        
        .status.lu {
            background-color: rgba(32, 201, 151, 0.1);
            color: #20c997;
        }
        
        .status.repondu {
            background-color: rgba(25, 135, 84, 0.1);
            color: #198754;
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
        
        .btn-reply {
            background-color: rgba(32, 201, 151, 0.1);
            color: #20c997;
        }
        
        .btn-reply:hover {
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
        
        .message-details {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .message-section {
            margin-bottom: 1.5rem;
        }
        
        .message-section h4 {
            font-size: 1.1rem;
            color: var(--navy);
            margin-bottom: 0.75rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .message-content {
            background-color: rgba(0, 0, 117, 0.03);
            padding: 1.5rem;
            border-radius: 6px;
            line-height: 1.6;
        }
        
        .sender-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .sender-info p {
            margin-bottom: 0.5rem;
        }
        
        .sender-info strong {
            color: var(--navy);
            font-weight: 500;
        }
        
        .reply-form {
            margin-top: 2rem;
        }
        
        .form-group {
            margin-bottom: 1rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--navy);
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 6px;
            font-size: 0.95rem;
            font-family: 'Cormorant Garamond', serif;
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
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
            
            .sender-info {
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
            <li><a href="/dashboard"><i class="fas fa-tachometer-alt"></i> Tableau de Bord</a></li>
            <li><a href="/dashboard/categories" ><i class="fas fa-tags"></i> Gestion des Catégories</a></li>
            <li><a href="/dashboard/produits"><i class="fas fa-wine-bottle"></i> Gestion des Produits</a></li>
            <li><a href="/dashboard/stock"><i class="fas fa-boxes"></i> Gestion des Stocks</a></li>
            <li><a href="/dashboard/statistique"><i class="fas fa-chart-bar"></i> Statistiques</a></li>
            <li><a href="/dashboard/commandes" ><i class="fas fa-shopping-basket"></i> Gestion des Commandes</a></li>
            <li><a href="/dashboard/livraisons"><i class="fas fa-truck"></i> Gestion des Livraisons</a></li>
            <li><a href="/dashboard/contacts" class="active"><i class="fas fa-envelope"></i> Messages de Contact</a></li>
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
            <h2>Messages de Contact</h2>
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Admin Profile">
                <span>Rose & Bouchon</span>
            </div>
        </div>
        
        <form method="GET" action="{{ route('dashboard.contacts') }}" class="search-filter">
            <select name="status" class="filter-select">
                <option value="">Tous les statuts</option>
                <option value="non-lu" {{ request('status') == 'non-lu' ? 'selected' : '' }}>Non lu</option>
                <option value="lu" {{ request('status') == 'lu' ? 'selected' : '' }}>Lu</option>
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
        
        <!-- Messages Table -->
        <div class="messages-management">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Sujet</th>
                        <th>Date</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                        <tr data-message-id="{{ $message->id }}" class="{{ $message->is_read ? '' : 'unread' }}">
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ Str::limit($message->subject, 50) }}</td>
                            <td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <form action="{{ route('dashboard.contacts.updateStatus', $message->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="status-dropdown {{ $message->status }}">
                                        <option value="non-lu" {{ $message->status === 'non-lu' ? 'selected' : '' }}>Non lu</option>
                                        <option value="lu" {{ $message->status === 'lu' ? 'selected' : '' }}>Lu</option>
                                        <option value="repondu" {{ $message->status === 'repondu' ? 'selected' : '' }}>Répondu</option>
                                    </select>
                                </form>
                            </td>
                            <td>
                                <div class="action-btns">
                                    <button class="btn btn-sm btn-view" onclick="openMessageModal('{{ $message->id }}')">
                                        <i class="fas fa-eye"></i> Voir
                                    </button>
                                    <form action="{{ route('dashboard.contacts.destroy', $message->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Aucun message trouvé.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        
        
    </div>

    <!-- Message Details Modal -->
    @foreach($messages as $message)
        <div class="modal" id="messageModal-{{ $message->id }}">
            <div class="modal-content">
                <div class="modal-header">
                    <h3>Message de {{ $message->name }}</h3>
                    <button class="close-modal" onclick="closeModal('messageModal-{{ $message->id }}')">&times;</button>
                </div>
                
                <div class="message-details">
                    <div class="sender-info">
                        <div>
                            <h4>Informations de l'expéditeur</h4>
                            <p><strong>Nom:</strong> {{ $message->name }}</p>
                            <p><strong>Email:</strong> {{ $message->email }}</p>
                            <p><strong>Téléphone:</strong> {{ $message->phone ?? 'Non fourni' }}</p>
                        </div>
                        
                        <div>
                            <h4>Détails du message</h4>
                            <p><strong>Sujet:</strong> {{ $message->subject }}</p>
                            <p><strong>Date:</strong> {{ $message->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Statut:</strong> 
                                <span class="status {{ $message->status }}">
                                    @if($message->status == 'non-lu')
                                        Non lu
                                    @elseif($message->status == 'lu')
                                        Lu
                                    @else
                                        Répondu
                                    @endif
                                </span>
                            </p>
                        </div>
                    </div>
                    
                    <div class="message-section">
                        <h4>Message</h4>
                        <div class="message-content">
                            {{ $message->message }}
                        </div>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    @endforeach

    <!-- Reply Modal -->
    <div class="modal" id="replyModal">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Répondre au message</h3>
                <button class="close-modal" onclick="closeModal('replyModal')">&times;</button>
            </div>
            
            <form method="POST" id="replyForm">
                @csrf
                @method('PUT')
                
                <div class="message-details">
                    <div class="sender-info">
                        <div>
                            <h4>À</h4>
                            <p id="reply-to-name"></p>
                            <p id="reply-to-email"></p>
                        </div>
                        
                        <div>
                            <h4>Sujet</h4>
                            <p id="reply-subject"></p>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="reply-message">Votre réponse</label>
                        <textarea id="reply-message" name="reply_message" class="form-control" placeholder="Écrivez votre réponse ici..." required></textarea>
                    </div>
                    
                    <input type="hidden" name="status" value="repondu">
                    
                    <div class="modal-actions">
                        <button type="button" class="btn btn-edit" onclick="closeModal('replyModal')">
                            Annuler
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane"></i> Envoyer
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Menu toggle functionality
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('active');
        });

        // Message Modal Functions
        function openMessageModal(id) {
            // Mark as read when opening
            fetch(`/dashboard/contacts/${id}/mark-as-read`, {
                method: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                }
            }).then(response => {
                if (response.ok) {
                    // Update status in the table
                    const statusElement = document.querySelector(`tr[data-message-id="${id}"] .status`);
                    if (statusElement) {
                        statusElement.textContent = 'Lu';
                        statusElement.className = 'status lu';
                    }
                    
                    // Remove unread class
                    const row = document.querySelector(`tr[data-message-id="${id}"]`);
                    if (row) {
                        row.classList.remove('unread');
                    }
                }
            });
            
            document.getElementById(`messageModal-${id}`).style.display = "block";
        }

        function openReplyModal(id) {
            // Get message details (in a real app, you'd fetch this from the server)
            const messageRow = document.querySelector(`tr[data-message-id="${id}"]`);
            if (messageRow) {
                const name = messageRow.cells[0].textContent;
                const email = messageRow.cells[1].textContent;
                const subject = "Re: " + messageRow.cells[2].textContent;
                
                document.getElementById("reply-to-name").textContent = name;
                document.getElementById("reply-to-email").textContent = email;
                document.getElementById("reply-subject").textContent = subject;
                
                // Set form action
                document.getElementById("replyForm").action = `/dashboard/contacts/${id}`;
                
                // Show modal
                document.getElementById("replyModal").style.display = "block";
            }
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