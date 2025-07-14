<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande - Rose & Bouchon</title>
    <style>
        :root {
            --navy: #000075;
            --burgundy: #960018;
            --dark: #121212;
            --ivory: #FEFEFA;
            --gold: #C4A267;
        }
        
        body {
            font-family: 'Cormorant Garamond', serif;
            background-color: var(--ivory);
            color: var(--dark);
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-image: linear-gradient(rgba(254, 254, 250, 0.94), rgba(254, 254, 250, 0.96)), 
                              url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=1200');
            background-size: cover;
            background-position: center;
        }
        
        .header {
            text-align: center;
            padding: 30px 0;
            border-bottom: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .header h1 {
            color: var(--navy);
            font-size: 2.2rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 10px;
            font-variant: small-caps;
        }
        
        .header p {
            color: var(--burgundy);
            font-style: italic;
            font-size: 1.1rem;
        }
        
        .content-box {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            padding: 30px;
            margin: 20px 0;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(150, 0, 24, 0.1);
            border-top: 4px solid var(--burgundy);
        }
        
        h2 {
            color: var(--navy);
            font-size: 1.5rem;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(0, 0, 117, 0.1);
            position: relative;
        }
        
        h2::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 80px;
            height: 2px;
            background: var(--burgundy);
        }
        
        .order-details {
            margin: 25px 0;
        }
        
        .order-item {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px dashed rgba(150, 0, 24, 0.1);
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .item-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 4px;
            margin-right: 15px;
            border: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-name {
            font-weight: 600;
            color: var(--navy);
            margin-bottom: 5px;
        }
        
        .item-price {
            color: var(--burgundy);
            font-size: 0.95rem;
        }
        
        .item-qty {
            color: var(--dark);
            font-size: 0.9rem;
        }
        
        .total-section {
            background-color: rgba(150, 0, 24, 0.05);
            padding: 15px;
            border-radius: 6px;
            margin-top: 25px;
            text-align: right;
        }
        
        .total-line {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .grand-total {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--navy);
            border-top: 1px solid rgba(150, 0, 24, 0.2);
            padding-top: 8px;
            margin-top: 8px;
        }
        
        .shipping-info {
            margin-top: 30px;
        }
        
        .info-box {
            background-color: rgba(196, 162, 103, 0.05);
            border-left: 3px solid var(--gold);
            padding: 15px;
            margin: 15px 0;
            font-size: 0.95rem;
        }
        
        .cta-button {
            display: inline-block;
            background: linear-gradient(135deg, var(--navy), var(--burgundy));
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 4px;
            font-weight: 500;
            margin: 20px 0;
            text-align: center;
            transition: all 0.3s ease;
        }
        
        .cta-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(150, 0, 24, 0.2);
        }
        
        .footer {
            text-align: center;
            padding: 20px 0;
            font-size: 0.9rem;
            color: var(--dark);
            border-top: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-link {
            display: inline-block;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--burgundy);
            color: white;
            text-align: center;
            line-height: 36px;
            margin: 0 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            transform: translateY(-3px);
        }
        
        @media (max-width: 600px) {
            .header h1 {
                font-size: 1.8rem;
            }
            
            .content-box {
                padding: 20px;
            }
            
            .order-item {
                flex-direction: column;
            }
            
            .item-image {
                margin-bottom: 10px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Confirmation de commande</h1>
            <p>Merci pour votre achat chez Rose & Bouchon</p>
        </div>

        <div class="content-box">
            <h2>Votre commande {{ $commande->order_number }}</h2>
            <p>Bonjour {{ $commande->firstname }},</p>
            <p>Nous avons bien reçu votre commande et nous vous en remercions. Voici les détails de votre achat :</p>

            <div class="order-details">
                @foreach ($commande->products as $product)
                    <div class="order-item">
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nom }}" class="item-image">
                        <div class="item-details">
                            <div class="item-name">{{ $product->nom }}</div>
                            <div class="item-price">{{ number_format($product->pivot->price_ttc, 2, ',', ' ') }} Dhs</div>
                            <div class="item-qty">Quantité: {{ $product->pivot->quantity }}</div>
                        </div>
                    </div>
                @endforeach

                <div class="total-section">
                    <div class="total-line">
                        <span>Sous-total :</span>
                        <span>{{ number_format($commande->products->sum(fn($p) => $p->pivot->price_ttc * $p->pivot->quantity), 2, ',', ' ') }} Dhs</span>
                    </div>
                    <div class="total-line">
                        <span>Livraison :</span>
                        <span>{{ number_format($commande->shipping_price, 2, ',', ' ') }} Dhs</span>
                    </div>
                    <div class="total-line grand-total">
                        <span>Total :</span>
                        <span>{{ number_format($commande->total, 2, ',', ' ') }} Dhs</span>
                    </div>
                </div>
            </div>

            <div class="shipping-info">
                <h2>Informations de livraison</h2>
                <p>
                    <strong>{{ $commande->firstname }} {{ $commande->lastname }}</strong><br>
                    {{ $commande->address }}<br>
                    {{ $commande->city }}, {{ $commande->postcode }}<br>
                    Maroc
                </p>

                <div class="info-box">
                    <i class="fas fa-info-circle"></i> Votre commande sera expédiée dans un délai de 1-2 jours ouvrables. Vous recevrez un email de confirmation avec un numéro de suivi dès l'expédition.
                </div>

                <a href="{{ url('/') }}/account/orders" class="cta-button">Suivre ma commande</a>
            </div>

            <p>Avec toute notre gratitude,<br>
            <strong>L'équipe Rose & Bouchon</strong></p>

            <div class="info-box">
                <strong>Questions sur votre commande ?</strong><br>
                Contactez-nous à <a href="mailto:contact@roseetbouchon.com">contact@roseetbouchon.com</a> ou au +33 1 23 45 67 89.<br>
                Nos conseillers œnophiles se feront un plaisir de vous aider.
            </div>
        </div>

        <div class="footer">
            <div class="social-links">
                <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-link"><i class="fab fa-pinterest-p"></i></a>
            </div>

            <p>Rose & Bouchon - Accessoires d'exception pour l'art de vivre le vin</p>
            <p>© 2023 Rose & Bouchon. Tous droits réservés.</p>
        </div>
    </div>
</body>


</html>