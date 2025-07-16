<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte - Rose & Bouchon</title>
    <style>
        :root {
            --navy: #000075;
            --burgundy: #960018;
            --dark: #121212;
            --ivory: #FEFEFA;
            --gold: #C4A267;
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Cormorant Garamond', serif;
            background-color: var(--ivory);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-image: linear-gradient(rgba(254, 254, 250, 0.92), rgba(254, 254, 250, 0.94)), 
                              url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=2000');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 20px;
            color: var(--dark);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }
        
        .account-header {
            width: 100%;
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .account-header h1 {
            color: var(--navy);
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 2.8rem;
            margin-bottom: 0.5rem;
            font-variant: small-caps;
        }
        
        .account-header p {
            color: var(--burgundy);
            font-style: italic;
            font-size: 1.2rem;
            letter-spacing: 0.3px;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .account-section {
            background-color: var(--ivory);
            padding: 3rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--burgundy);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(150, 0, 24, 0.1);
            margin-bottom: 3rem;
        }
        
        .account-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--navy), var(--burgundy));
            z-index: 2;
        }
        
        .account-section::after {
            content: '🍷';
            position: absolute;
            bottom: -30px;
            right: -30px;
            font-size: 180px;
            opacity: 0.03;
            z-index: 0;
            transform: rotate(15deg);
        }
        
        .account-section h2 {
            color: var(--navy);
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 117, 0.1);
            font-weight: 600;
            letter-spacing: 0.3px;
            position: relative;
        }
        
        .account-section h2::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100px;
            height: 2px;
            background: var(--burgundy);
        }
        
        .account-grid {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 2rem;
            margin: 3rem 0;
        }
        
        @media (max-width: 768px) {
            .account-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
                margin: 1.5rem 0;
            }
        }
        
        .account-sidebar {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(150, 0, 24, 0.1);
            height: fit-content;
        }
        
        .account-sidebar h3 {
            color: var(--navy);
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 117, 0.1);
        }
        
        .account-menu {
            list-style: none;
        }
        
        .account-menu li {
            margin-bottom: 0.75rem;
        }
        
        .account-menu a {
            display: flex;
            align-items: center;
            color: var(--dark);
            text-decoration: none;
            padding: 0.5rem 0;
            transition: all 0.3s ease;
        }
        
        .account-menu a:hover {
            color: var(--burgundy);
            transform: translateX(5px);
        }
        
        .account-menu a i {
            margin-right: 0.75rem;
            width: 20px;
            text-align: center;
            color: var(--burgundy);
        }
        
        .account-menu a.active {
            color: var(--burgundy);
            font-weight: 600;
        }
        
        .account-content {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .welcome-message {
            margin-bottom: 2rem;
            line-height: 1.6;
        }
        
        .welcome-message p {
            margin-bottom: 1rem;
        }
        
        /* Updated Loyalty Program Styles */
        .loyalty-card {
            background: linear-gradient(135deg, rgba(196, 162, 103, 0.1), rgba(150, 0, 24, 0.1));
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid rgba(196, 162, 103, 0.3);
            position: relative;
            overflow: hidden;
        }

        .loyalty-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1514933651103-005eec06c04b?q=80&w=1000') center/cover;
            opacity: 0.05;
            z-index: 0;
        }

        .loyalty-card h3 {
            color: var(--navy);
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .loyalty-card h3 i {
            margin-right: 0.75rem;
            color: var(--burgundy);
        }

        .loyalty-points {
            display: flex;
            align-items: baseline;
            margin-bottom: 1.5rem;
            position: relative;
        }

        .points-count {
            font-size: 2.5rem;
            font-weight: 600;
            color: var(--burgundy);
            margin-right: 1rem;
        }

        .points-label {
            font-size: 1rem;
            color: var(--dark);
            opacity: 0.8;
        }

        .loyalty-explanation {
            background-color: rgba(255, 255, 255, 0.6);
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(150, 0, 24, 0.1);
        }

        .loyalty-explanation p {
            margin-bottom: 1.5rem;
            text-align: center;
            font-size: 1.1rem;
        }

        .example-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.5rem;
            max-width: 300px;
            margin: 0 auto;
        }

        .example-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            padding: 1rem;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            border: 1px solid rgba(150, 0, 24, 0.1);
        }

        .example-label {
            font-size: 0.9rem;
            color: var(--dark);
            opacity: 0.8;
        }

        .example-amount {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--burgundy);
            margin-top: 0.3rem;
        }

        .example-arrow {
            color: var(--burgundy);
            font-size: 1.2rem;
        }

        .loyalty-benefits {
            margin-top: 1.5rem;
        }

        .loyalty-benefits h4 {
            color: var(--navy);
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
            text-align: center;
        }

        .benefits-list {
            list-style-type: none;
        }

        .benefits-list li {
            margin-bottom: 0.75rem;
            display: flex;
            align-items: flex-start;
            line-height: 1.5;
        }

        .benefits-list li::before {
            content: '•';
            color: var(--burgundy);
            font-weight: bold;
            margin-right: 0.5rem;
            flex-shrink: 0;
        }

        .next-order-info {
            margin-top: 1.5rem;
            padding: 1rem;
            background-color: rgba(150, 0, 24, 0.05);
            border-radius: 8px;
            border: 1px solid rgba(150, 0, 24, 0.1);
            text-align: center;
            font-size: 0.95rem;
        }

        .next-order-info i {
            color: var(--burgundy);
            margin-right: 0.5rem;
        }
        
        .orders-section h3 {
            color: var(--navy);
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 117, 0.1);
        }
        
        .orders-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        
        .orders-table th {
            background-color: rgba(150, 0, 24, 0.1);
            color: var(--navy);
            padding: 0.75rem;
            text-align: left;
            font-weight: 600;
        }
        
        .orders-table td {
            padding: 0.75rem;
            border-bottom: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .orders-table tr:hover {
            background-color: rgba(150, 0, 24, 0.03);
        }
        
        .order-number {
            color: var(--burgundy);
            font-weight: 600;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .order-number:hover {
            color: var(--navy);
        }
        
        .order-status {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-pending {
            background-color: rgba(255, 193, 7, 0.2);
            color: #b78c00;
        }
        
        .status-processing {
            background-color: rgba(3, 169, 244, 0.2);
            color: #0288d1;
        }
        
        .status-shipped {
            background-color: rgba(76, 175, 80, 0.2);
            color: #388e3c;
        }
        
        .status-delivered {
            background-color: rgba(104, 58, 183, 0.2);
            color: #5e35b1;
        }
        
        .status-cancelled {
            background-color: rgba(244, 67, 54, 0.2);
            color: #d32f2f;
        }
        
        .no-orders {
            text-align: center;
            padding: 2rem;
            color: var(--dark);
            font-style: italic;
        }
        
        .view-all {
            display: inline-block;
            margin-top: 1rem;
            color: var(--burgundy);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .view-all:hover {
            color: var(--navy);
            text-decoration: underline;
        }
        
        .view-all i {
            margin-left: 0.3rem;
        }
        
        /* Enhanced Mobile Responsiveness */
        @media (max-width: 768px) {
            body {
                padding: 12px;
                background-image: linear-gradient(rgba(254, 254, 250, 0.96), rgba(254, 254, 250, 0.98)), 
                                  url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=1200');
            }
            
            .account-header {
                margin-bottom: 1.5rem;
            }
            
            .account-header h1 {
                font-size: 2rem;
            }
            
            .account-header p {
                font-size: 0.95rem;
                padding: 0 10px;
            }
            
            .account-section {
                padding: 1.5rem;
                margin-bottom: 1.5rem;
            }
            
            .account-section h2 {
                font-size: 1.4rem;
            }
            
            .account-section::after {
                font-size: 120px;
                bottom: -15px;
                right: -15px;
            }
            
            .account-sidebar,
            .account-content {
                padding: 1.5rem;
            }
            
            .orders-table {
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }
            
            .orders-table th,
            .orders-table td {
                padding: 0.5rem;
                font-size: 0.85rem;
            }
            
            .loyalty-points {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }
            
            .points-count {
                margin-right: 0;
                margin-bottom: 0.5rem;
                font-size: 2rem;
            }
            
            .loyalty-explanation {
                padding: 1rem;
            }
            
            .loyalty-explanation p {
                font-size: 1rem;
            }
            
            .example-item {
                padding: 0.75rem;
            }
            
            .example-amount {
                font-size: 1.3rem;
            }
            
            .benefits-list li {
                font-size: 0.95rem;
            }
            
            .next-order-info {
                font-size: 0.9rem;
                padding: 0.75rem;
            }
        }

        /* Small mobile devices */
        @media (max-width: 480px) {
            .account-header h1 {
                font-size: 1.8rem;
            }
            
            .account-section {
                padding: 1rem;
            }
            
            .account-sidebar,
            .account-content {
                padding: 1rem;
            }
            
            .loyalty-card {
                padding: 1rem;
            }
            
            .orders-table th,
            .orders-table td {
                padding: 0.4rem;
                font-size: 0.8rem;
            }
            
            .order-status {
                font-size: 0.7rem;
                padding: 0.2rem 0.5rem;
            }
        }
        
        /* Animation for subtle interactivity */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .account-header {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .account-section {
            opacity: 0;
            animation: fadeIn 0.6s ease-out 0.2s forwards;
        }
        
        .account-sidebar, .loyalty-card {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .account-sidebar { animation-delay: 0.3s; }
        .loyalty-card { animation-delay: 0.4s; }
        .orders-section { animation-delay: 0.5s; }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="account-header">
            <h1>Mon Compte</h1>
            <p>Gérez vos commandes, vos informations personnelles et vos avantages fidélité</p>
        </header>
        
        <section class="account-section">
            <div class="account-grid">
                <aside class="account-sidebar">
                    <h3>Mon Profil</h3>
                    <ul class="account-menu">
                        <li><a href="/mon-compte" class="active"><i class="fas fa-user"></i> Tableau de bord</a></li>
                        <li><a href="/mon-compte/commandes"><i class="fas fa-box-open"></i> Mes commandes</a></li>
                        <li><a href="#"><i class="fas fa-heart"></i> Ma liste de souhaits</a></li>
                        <li><a href="/mon-compte/fidelisation"><i class="fas fa-percentage"></i> Fidélité</a></li>
                        <li><a href="#"><i class="fas fa-cog"></i> Paramètres</a></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" style="background: none; border: none; padding: 0; color: inherit; font: inherit; cursor: pointer;">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </button>
                            </form>
                        </li>
                    </ul>
                </aside>
                
                <main class="account-content">
                    <div class="welcome-message">
                        @auth
                            <div class="welcome-message">
                                <h2>Bienvenue, {{ Auth::user()->prenom }}</h2>
                                <p>Depuis votre compte, vous pouvez consulter vos commandes récentes, gérer vos adresses de livraison et de facturation, ainsi que suivre votre crédit fidélité.</p>
                            </div>
                        @endauth
                    </div>
                    
                    <div class="loyalty-card">
                        <h3><i class="fas fa-percentage"></i> Programme Fidélité</h3>

                        <div class="loyalty-points">
                            <span class="points-count">
                                {{ number_format(Auth::user()->fidelity_credit, 2, ',', ' ') }} Dhs
                            </span>
                            <span class="points-label">crédit disponible</span>
                        </div>
                        <div class="loyalty-explanation">
                            <p>Notre programme fidélité vous offre <strong>10% de crédit</strong> sur chaque achat, utilisable sur votre prochaine commande.</p>
                            <div class="example-box">
                                <div class="example-item">
                                    <span class="example-label">Vous dépensez</span>
                                    <span class="example-amount">100 Dhs</span>
                                </div>
                                <div class="example-arrow">
                                    <i class="fas fa-arrow-down"></i>
                                </div>
                                <div class="example-item">
                                    <span class="example-label">Vous gagnez</span>
                                    <span class="example-amount">10 Dhs</span>
                                </div>
                            </div>
                        </div>

                        <div class="loyalty-benefits">
                            <h4>Comment ça marche :</h4>
                            <ul class="benefits-list">
                                <li>10% du montant de chaque commande est crédité sur votre compte</li>
                                <li>Votre crédit est disponible immédiatement après validation de la commande</li>
                                <li>Utilisable sur tout achat ultérieur sans minimum d'achat</li>
                                <li>Pas de date d'expiration - votre crédit reste valable indéfiniment</li>
                                <li>Combinable avec les offres promotionnelles</li>
                            </ul>
                        </div>

                        <div class="next-order-info">
                            <i class="fas fa-info-circle"></i> Votre prochaine commande sera éligible à une réduction de
                            <strong>{{ number_format(Auth::user()->fidelity_credit, 2, ',', ' ') }} Dhs</strong>
                        </div>
                    </div>

                    
                    <div class="orders-section">
    <h3>Mes commandes récentes</h3>
    <table class="orders-table">
        <thead>
            <tr>
                <th>Commande</th>
                <th>Date</th>
                <th>Montant</th>
                <th>Crédit gagné</th>
                <th>Statut</th>
            </tr>
        </thead>
        <tbody>
            @forelse($recentOrders as $order)
                <tr>
                    <td><a href="#" class="order-number">#{{ $order->order_number }}</a></td>
                    <td>{{ \Carbon\Carbon::parse($order->created_at)->locale('fr_FR')->isoFormat('D MMMM YYYY') }}</td>
                    <td>{{ number_format($order->total, 2, ',', ' ') }} Dhs</td>
                    <td>+{{ number_format($order->fidelity_earned, 2, ',', ' ') }} Dhs</td>
                    <td>
                        <span class="order-status status-{{ Str::slug($order->status) }}">
                            {{ ucfirst(str_replace('-', ' ', $order->status)) }}
                        </span>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Aucune commande récente.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($recentOrders->count() > 0)
        <a href="" class="view-all">
            Voir toutes mes commandes <i class="fas fa-chevron-right"></i>
        </a>
    @endif
</div>

                </main>
            </div>
        </section>
    </div>
</body>
</html>