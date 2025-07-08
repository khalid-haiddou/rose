<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande - Rose & Bouchon</title>
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
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }
        
        .checkout-header {
            width: 100%;
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .checkout-header h1 {
            color: var(--navy);
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            font-variant: small-caps;
        }
        
        .checkout-header p {
            color: var(--burgundy);
            font-style: italic;
            font-size: 1.05rem;
            letter-spacing: 0.3px;
        }
        
        .checkout-form {
            flex: 1;
            min-width: 300px;
            background-color: var(--ivory);
            padding: 2rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--burgundy);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .checkout-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--navy), var(--burgundy));
            z-index: 2;
        }
        
        .checkout-form::after {
            content: '🍷';
            position: absolute;
            bottom: -30px;
            right: -30px;
            font-size: 180px;
            opacity: 0.03;
            z-index: 0;
            transform: rotate(15deg);
        }
        
        .form-section {
            margin-bottom: 2.5rem;
            position: relative;
            z-index: 1;
        }
        
        .form-section h2 {
            color: var(--navy);
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 117, 0.1);
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .form-group {
            flex: 1;
            min-width: 200px;
            margin-bottom: 0;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.75rem;
            color: var(--dark);
            font-size: 0.95rem;
            font-weight: 500;
        }
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 15px 18px;
            border: 1px solid rgba(0, 0, 117, 0.15);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            background-color: rgba(255, 255, 255, 0.7);
            font-family: 'Cormorant Garamond', serif;
        }
        
        .form-group input:focus, .form-group select:focus {
            border-color: var(--navy);
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 0, 117, 0.1);
            background-color: white;
        }
        
        .form-group input::placeholder {
            color: rgba(18, 18, 18, 0.4);
            font-style: italic;
        }
        
        .shipping-methods, .payment-methods {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }
        
        .method {
            display: flex;
            align-items: center;
            padding: 1rem;
            border: 1px solid rgba(0, 0, 117, 0.1);
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            background-color: rgba(255, 255, 255, 0.7);
        }
        
        .method:hover {
            border-color: var(--navy);
            background-color: white;
        }
        
        .method.active {
            border-color: var(--burgundy);
            background-color: rgba(150, 0, 24, 0.03);
        }
        
        .method input {
            margin-right: 1rem;
            accent-color: var(--burgundy);
        }
        
        .method-content {
            flex: 1;
        }
        
        .method-title {
            font-weight: 500;
            color: var(--navy);
            margin-bottom: 0.25rem;
        }
        
        .method-description {
            font-size: 0.9rem;
            color: var(--dark);
            opacity: 0.8;
        }
        
        .method-price {
            font-weight: 500;
            color: var(--burgundy);
            margin-left: 1rem;
        }
        
        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            margin: 1.5rem 0;
        }
        
        .terms-checkbox input {
            margin-right: 1rem;
            margin-top: 0.3rem;
            accent-color: var(--burgundy);
        }
        
        .terms-checkbox label {
            font-size: 0.9rem;
            line-height: 1.5;
        }
        
        .terms-checkbox a {
            color: var(--burgundy);
            text-decoration: none;
            border-bottom: 1px dotted var(--burgundy);
        }
        
        .btn {
            width: 100%;
            padding: 16px;
            background-color: var(--burgundy);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            letter-spacing: 0.5px;
            font-weight: 500;
            font-family: 'Cormorant Garamond', serif;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
            z-index: -1;
        }
        
        .btn:hover {
            background-color: #7a0014;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(150, 0, 24, 0.2);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .order-summary {
            flex: 0 0 350px;
            background-color: var(--ivory);
            padding: 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--navy);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(0, 0, 117, 0.1);
            height: fit-content;
        }
        
        .order-summary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--burgundy), var(--navy));
            z-index: 2;
        }
        
        .order-summary h2 {
            color: var(--navy);
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 117, 0.1);
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        
        .order-items {
            margin-bottom: 1.5rem;
        }
        
        .order-item {
            display: flex;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px dashed rgba(0, 0, 117, 0.1);
        }
        
        .order-item:last-child {
            border-bottom: none;
        }
        
        .item-image {
            width: 70px;
            height: 70px;
            border-radius: 6px;
            overflow: hidden;
            margin-right: 1rem;
            background-color: #f5f5f5;
        }
        
        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .item-details {
            flex: 1;
        }
        
        .item-name {
            font-weight: 500;
            color: var(--navy);
            margin-bottom: 0.25rem;
        }
        
        .item-variant {
            font-size: 0.85rem;
            color: var(--dark);
            opacity: 0.7;
            margin-bottom: 0.25rem;
        }
        
        .item-price {
            font-weight: 500;
            color: var(--burgundy);
        }
        
        .order-totals {
            border-top: 1px solid rgba(0, 0, 117, 0.1);
            padding-top: 1.5rem;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.75rem;
        }
        
        .total-row:last-child {
            margin-top: 1rem;
            font-weight: 600;
            font-size: 1.1rem;
            border-top: 1px solid rgba(0, 0, 117, 0.1);
            padding-top: 0.75rem;
        }
        
        .total-label {
            color: var(--dark);
        }
        
        .total-value {
            color: var(--burgundy);
        }
        
        .grand-total .total-label {
            color: var(--navy);
        }
        
        .grand-total .total-value {
            color: var(--burgundy);
            font-weight: 600;
        }
        
        /* Mobile-specific enhancements */
        @media (max-width: 768px) {
            body {
                padding: 15px;
                background-image: linear-gradient(rgba(254, 254, 250, 0.96), rgba(254, 254, 250, 0.98)), 
                                  url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=1200');
            }
            
            .checkout-form, .order-summary {
                padding: 1.75rem 1.25rem;
                border-radius: 10px;
            }
            
            .checkout-header h1 {
                font-size: 1.8rem;
            }
            
            .form-group input, .form-group select {
                padding: 14px 16px;
            }
            
            .btn {
                padding: 15px;
            }
            
            .checkout-form::after, .order-summary::after {
                font-size: 140px;
                bottom: -20px;
                right: -20px;
            }
            
            .form-group {
                min-width: 100%;
            }
            
            .order-summary {
                flex: 1;
                min-width: 100%;
            }
        }
        
        /* Animation for subtle interactivity */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .checkout-form, .order-summary {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .form-section, .order-items, .order-totals, .btn {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .form-section:nth-child(1) { animation-delay: 0.1s; }
        .form-section:nth-child(2) { animation-delay: 0.2s; }
        .form-section:nth-child(3) { animation-delay: 0.3s; }
        .order-items { animation-delay: 0.1s; }
        .order-totals { animation-delay: 0.2s; }
        .btn { animation-delay: 0.4s; }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="checkout-header">
            <h1>Finalisez votre commande</h1>
            <p>L'élégance de la conservation du vin</p>
        </header>
        
        <form class="checkout-form" action="{{ route('checkout.store') }}" method="POST">
            @csrf
            <section class="form-section">
                <h2>Informations personnelles</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstname">Prénom</label>
                        <input type="text" id="firstname" name="firstname" placeholder="Votre prénom" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Nom</label>
                        <input type="text" id="lastname" name="lastname" placeholder="Votre nom" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="votre@email.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Téléphone</label>
                        <input type="tel" id="phone" name="phone" placeholder="06 12 34 56 78" required>
                    </div>
                </div>
            </section>

            <section class="form-section">
                <h2>Adresse de livraison</h2>
                <div class="form-group">
                    <label for="address">Adresse</label>
                    <input type="text" id="address" name="address" placeholder="N° et nom de rue" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="city">Ville</label>
                        <input type="text" id="city" name="city" placeholder="Votre ville" required>
                    </div>
                    <div class="form-group">
                        <label for="postcode">Code postal</label>
                        <input type="text" id="postcode" name="postcode" placeholder="Code postal">
                    </div>
                </div>
            </section>

            <section class="form-section">
                <h2>Méthode de livraison</h2>
                <div class="shipping-methods">
                    <label class="method">
                        <input type="radio" name="shipping_method" value="standard" checked>
                        <div class="method-content">
                            <div class="method-title">Livraison standard</div>
                            <div class="method-description">Délai de 2-4 jours ouvrés</div>
                        </div>
                        <div class="method-price">{{ $shipping > 0 ? number_format($shipping, 2, ',', ' ') . ' Dhs' : 'Gratuite' }}</div>
                    </label>
                </div>
            </section>

            <section class="form-section">
                <h2>Méthode de paiement</h2>
                <div class="payment-methods">
                    <label class="method">
                        <input type="radio" name="payment_method" value="CMI" checked>
                        <div class="method-content">
                            <div class="method-title">Paiement par carte (CMI)</div>
                            <div class="method-description">Paiement sécurisé en ligne</div>
                        </div>
                    </label>
                    <label class="method">
                        <input type="radio" name="payment_method" value="COD">
                        <div class="method-content">
                            <div class="method-title">Paiement à la livraison</div>
                            <div class="method-description">Payez lorsque vous recevez votre commande</div>
                        </div>
                    </label>
                </div>
            </section>

            <aside class="order-summary">
                <h2>Votre commande</h2>
                <div class="order-items">
                    @foreach($cart as $item)
                        <div class="order-item">
                            <div class="item-image">
                                <img src="{{ $item['product']->image ? asset('storage/' . $item['product']->image) : 'https://via.placeholder.com/300x300' }}" alt="{{ $item['product']->nom }}">
                            </div>
                            <div class="item-details">
                                <div class="item-name">{{ $item['product']->nom }}</div>
                                <div class="item-variant">x{{ $item['quantity'] }}</div>
                                <div class="item-price">{{ number_format($item['product']->prix_ttc * $item['quantity'], 2, ',', ' ') }} Dhs</div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="order-totals">
                    <div class="total-row">
                        <span class="total-label">Sous-total</span>
                        <span class="total-value">{{ number_format($subtotal, 2, ',', ' ') }} Dhs</span>
                    </div>
                    <div class="total-row">
                        <span class="total-label">Livraison</span>
                        <span class="total-value">{{ $shipping > 0 ? number_format($shipping, 2, ',', ' ') . ' Dhs' : 'Gratuite' }}</span>
                    </div>
                    <div class="total-row grand-total">
                        <span class="total-label">Total</span>
                        <span class="total-value">{{ number_format($total, 2, ',', ' ') }} Dhs</span>
                    </div>
                </div>

                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">Je reconnais avoir lu et accepté les <a href="#">conditions générales de vente</a> et la <a href="#">politique de confidentialité</a>.</label>
                </div>

                <button type="submit" class="btn">Passer la commande</button>
            </aside>
        </form>

    </div>
</body>
</html>