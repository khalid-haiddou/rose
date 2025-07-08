<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merci - Rose & Bouchon</title>
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
            max-width: 800px;
            margin: 0 auto;
            width: 100%;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            flex: 1;
        }
        
        .thank-you-card {
            background-color: var(--ivory);
            padding: 3rem 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--navy);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(150, 0, 24, 0.1);
            max-width: 600px;
            width: 100%;
        }
        
        .thank-you-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--navy), var(--burgundy));
            z-index: 2;
        }
        
        .thank-you-icon {
            font-size: 4rem;
            color: var(--navy);
            margin-bottom: 1.5rem;
            animation: bounce 1s ease infinite alternate;
        }
        
        .thank-you-title {
            color: var(--navy);
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-variant: small-caps;
        }
        
        .thank-you-message {
            color: var(--dark);
            font-size: 1.2rem;
            line-height: 1.8;
            margin-bottom: 2rem;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .order-details {
            background-color: rgba(150, 0, 24, 0.05);
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border-left: 3px solid var(--navy);
        }
        
        .order-number {
            font-weight: 600;
            color: var(--burgundy);
            font-size: 1.1rem;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: var(--navy);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            letter-spacing: 0.5px;
            font-weight: 500;
            font-family: 'Cormorant Garamond', serif;
            text-decoration: none;
            margin-top: 1rem;
        }
        
        .btn:hover {
            background-color: #7a0014;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(150, 0, 24, 0.2);
        }
        
        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--burgundy);
            color: var(--burgundy);
            margin-left: 1rem;
        }
        
        .btn-outline:hover {
            background-color: rgba(150, 0, 24, 0.05);
        }
        
        @keyframes bounce {
            from { transform: translateY(0); }
            to { transform: translateY(-10px); }
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .thank-you-card {
            animation: fadeIn 0.8s ease-out forwards;
        }
        
        @media (max-width: 768px) {
            body {
                padding: 15px;
            }
            
            .thank-you-title {
                font-size: 2rem;
            }
            
            .thank-you-message {
                font-size: 1.1rem;
            }
            
            .btn-container {
                display: flex;
                flex-direction: column;
                gap: 1rem;
            }
            
            .btn, .btn-outline {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="thank-you-card">
            <div class="thank-you-icon">
                <i class="fas fa-check-circle"></i>
            </div>
            <h1 class="thank-you-title">Merci pour votre commande</h1>
            <p class="thank-you-message">
                Votre commande a été reçue avec succès. Nous préparons votre sélection d'accessoires avec soin et vous enverrons une confirmation dès l'expédition.
            </p>

            <div class="order-details">
                <p>Numéro de commande : 
                    <span class="order-number">
                        {{ session('order_number') ?? '—' }}
                    </span>
                </p>
                <p>
                    Un email de confirmation a été envoyé à 
                    <strong>{{ session('order_email') ?? '—' }}</strong>
                </p>
            </div>

            <div class="btn-container">
                <a href="{{ route('shop') }}" class="btn">Continuer vos achats</a>
                <a href="{{ url('/mon-compte') }}" class="btn btn-outline">Voir mes commandes</a>
            </div>
        </div>
    </div>

    <!-- Include your footer here -->
</body>
</html>