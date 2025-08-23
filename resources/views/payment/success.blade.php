<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement réussi - Rose & Bouchon</title>
    <style>
        :root {
            --navy: #000075;
            --burgundy: #960018;
            --dark: #121212;
            --ivory: #FEFEFA;
            --gold: #C4A267;
            --success: #28a745;
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
            background-image: linear-gradient(rgba(254, 254, 250, 0.95), rgba(254, 254, 250, 0.97)),
            url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=2000');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 20px;
            color: var(--dark);
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
        }

        .success-card {
            background-color: var(--ivory);
            padding: 3rem 2rem;
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
            border-top: 4px solid var(--success);
            text-align: center;
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(40, 167, 69, 0.1);
            width: 100%;
        }

        .success-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--success), var(--gold));
            z-index: 2;
        }

        .success-icon {
            font-size: 4rem;
            color: var(--success);
            margin-bottom: 1.5rem;
            animation: bounce 1s ease-in-out;
        }

        .success-title {
            color: var(--navy);
            font-size: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .success-message {
            color: var(--dark);
            font-size: 1.1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
            opacity: 0.8;
        }

        .order-info {
            background-color: rgba(40, 167, 69, 0.05);
            border-left: 3px solid var(--success);
            padding: 1rem;
            margin-bottom: 2rem;
            border-radius: 0 4px 4px 0;
            text-align: left;
            font-size: 0.95rem;
        }

        .order-info strong {
            color: var(--success);
            display: block;
            margin-bottom: 0.5rem;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
        }

        .btn {
            padding: 15px 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            letter-spacing: 0.5px;
            font-weight: 500;
            font-family: 'Cormorant Garamond', serif;
            text-decoration: none;
            display: inline-block;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .btn-primary {
            background-color: var(--burgundy);
            color: white;
        }

        .btn-primary:hover {
            background-color: #7a0014;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(150, 0, 24, 0.2);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--navy);
            border: 2px solid var(--navy);
        }

        .btn-secondary:hover {
            background-color: var(--navy);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 117, 0.2);
        }

        .countdown {
            margin-top: 2rem;
            padding: 1rem;
            background-color: rgba(196, 162, 103, 0.1);
            border-radius: 8px;
            font-size: 0.9rem;
            color: var(--gold);
        }

        .countdown strong {
            font-size: 1.1rem;
            color: var(--burgundy);
        }

        /* Mobile responsiveness */
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }

            .success-card {
                padding: 2rem 1.5rem;
                border-radius: 12px;
            }

            .success-title {
                font-size: 1.6rem;
            }

            .success-message {
                font-size: 1rem;
            }

            .success-icon {
                font-size: 3rem;
            }

            .action-buttons {
                gap: 0.75rem;
            }

            .btn {
                padding: 14px 1.5rem;
                font-size: 1rem;
            }
        }

        /* Animations */
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
            40% { transform: translateY(-10px); }
            60% { transform: translateY(-5px); }
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .success-card {
            animation: fadeIn 0.6s ease-out forwards;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .countdown strong {
            animation: pulse 1s infinite;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="success-card">
        <div class="success-icon">✅</div>

        <h1 class="success-title">Paiement réussi !</h1>

        <p class="success-message">
            Votre commande a été traitée avec succès. Vous recevrez un email de confirmation
            avec les détails de votre commande et les informations de livraison.
        </p>

        <div class="order-info">
            <strong>Prochaines étapes:</strong>
            • Vous recevrez un email de confirmation dans quelques minutes<br>
            • Votre commande sera préparée dans les 24-48h<br>
            • Vous recevrez un numéro de suivi une fois expédiée
        </div>

        <div class="action-buttons">
            <a href="{{ route('account.commandes.index') }}" class="btn btn-primary">
                📋 Voir mes commandes
            </a>

            <a href="{{ route('shop') }}" class="btn btn-secondary">
                🛍️ Continuer les achats
            </a>
        </div>

        <div class="countdown">
            <p>Redirection automatique vers l'accueil dans <strong id="countdown">10</strong> secondes</p>
        </div>
    </div>
</div>

<script>
    // Auto-redirect countdown
    let timeLeft = 10;
    const countdownElement = document.getElementById('countdown');

    const timer = setInterval(() => {
        timeLeft--;
        countdownElement.textContent = timeLeft;

        if (timeLeft <= 0) {
            clearInterval(timer);
            window.location.href = "{{ route('home') }}";
        }
    }, 1000);

    // Clear timer if user navigates away
    window.addEventListener('beforeunload', () => {
        clearInterval(timer);
    });
</script>
</body>
</html>
