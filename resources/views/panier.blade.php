<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - Rose & Bouchon</title>
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
        
        .cart-header {
            width: 100%;
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .cart-header h1 {
            color: var(--navy);
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 2.2rem;
            margin-bottom: 0.5rem;
            font-variant: small-caps;
        }
        
        .cart-header p {
            color: var(--burgundy);
            font-style: italic;
            font-size: 1.05rem;
            letter-spacing: 0.3px;
        }
        
        .cart-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }
        
        .cart-items {
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
        
        .cart-items::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--navy), var(--burgundy));
            z-index: 2;
        }
        
        .cart-items::after {
            content: '🍷';
            position: absolute;
            bottom: -30px;
            right: -30px;
            font-size: 180px;
            opacity: 0.03;
            z-index: 0;
            transform: rotate(15deg);
        }
        
        .cart-item {
            display: flex;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px dashed rgba(0, 0, 117, 0.1);
        }
        
        .cart-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .item-image {
            width: 120px;
            height: 120px;
            border-radius: 8px;
            overflow: hidden;
            margin-right: 1.5rem;
            background-color: #f5f5f5;
            flex-shrink: 0;
        }
        
        .item-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .item-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        
        .item-name {
            font-weight: 600;
            color: var(--navy);
            font-size: 1.2rem;
        }
        
        .item-price {
            font-weight: 500;
            color: var(--burgundy);
            font-size: 1.1rem;
        }
        
        .item-variant {
            font-size: 0.9rem;
            color: var(--dark);
            opacity: 0.8;
            margin-bottom: 1rem;
        }
        
        .item-actions {
            display: flex;
            align-items: center;
            margin-top: auto;
        }
        
        .quantity-selector {
            display: flex;
            align-items: center;
            margin-right: 2rem;
        }
        
        .quantity-btn {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(0, 0, 117, 0.05);
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1rem;
            color: var(--navy);
            transition: all 0.2s ease;
        }
        
        .quantity-btn:hover {
            background-color: rgba(0, 0, 117, 0.1);
        }
        
        .quantity-input {
            width: 50px;
            text-align: center;
            margin: 0 0.5rem;
            padding: 5px;
            border: 1px solid rgba(0, 0, 117, 0.1);
            border-radius: 4px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1rem;
        }
        
        .remove-btn {
            background: none;
            border: none;
            color: var(--burgundy);
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.9rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
        }
        
        .remove-btn:hover {
            text-decoration: underline;
        }
        
        .remove-btn svg {
            margin-right: 0.5rem;
        }
        
        .wishlist-btn {
            background: none;
            border: none;
            color: var(--navy);
            font-family: 'Cormorant Garamond', serif;
            font-size: 0.85rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            margin-left: 1rem;
            transition: all 0.2s ease;
        }
        
        .wishlist-btn:hover {
            text-decoration: underline;
        }
        
        .wishlist-btn svg {
            margin-right: 0.5rem;
        }
        
        .cart-summary {
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
        
        .cart-summary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--burgundy), var(--navy));
            z-index: 2;
        }
        
        .cart-summary h2 {
            color: var(--navy);
            font-size: 1.4rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 117, 0.1);
            font-weight: 600;
            letter-spacing: 0.3px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
        }
        
        .summary-label {
            color: var(--dark);
        }
        
        .summary-value {
            color: var(--burgundy);
        }
        
        .grand-total {
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(0, 0, 117, 0.1);
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .grand-total .summary-label {
            color: var(--navy);
        }
        
        .grand-total .summary-value {
            color: var(--burgundy);
        }
        
        .btn {
            width: 100%;
            padding: 16px;
            background-color: var(--navy);
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
            margin-top: 1.5rem;
            text-align: center;
            text-decoration: none;
            display: block;
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
            background-color: #00005a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 117, 0.2);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--burgundy);
            color: var(--burgundy);
        }
        
        .btn-outline:hover {
            background-color: rgba(150, 0, 24, 0.05);
        }
        
        .continue-shopping {
            display: inline-flex;
            align-items: center;
            color: var(--navy);
            text-decoration: none;
            margin-top: 1.5rem;
            transition: all 0.2s ease;
        }
        
        .continue-shopping:hover {
            color: var(--burgundy);
        }
        
        .continue-shopping svg {
            margin-right: 0.5rem;
        }
        
        /* Mobile-specific enhancements */
        @media (max-width: 768px) {
            body {
                padding: 15px;
                background-image: linear-gradient(rgba(254, 254, 250, 0.96), rgba(254, 254, 250, 0.98)), 
                                  url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=1200');
            }
            
            .cart-items, .cart-summary {
                padding: 1.75rem 1.25rem;
                border-radius: 10px;
            }
            
            .cart-header h1 {
                font-size: 1.8rem;
            }
            
            .cart-item {
                flex-direction: column;
            }
            
            .item-image {
                width: 100%;
                height: 200px;
                margin-right: 0;
                margin-bottom: 1rem;
            }
            
            .quantity-selector {
                margin-right: 1rem;
            }
        }
        
        /* Animation for subtle interactivity */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .cart-items, .cart-summary {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .cart-item, .summary-row, .btn {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .cart-item:nth-child(1) { animation-delay: 0.1s; }
        .cart-item:nth-child(2) { animation-delay: 0.2s; }
        .summary-row:nth-child(1) { animation-delay: 0.3s; }
        .summary-row:nth-child(2) { animation-delay: 0.4s; }
        .btn { animation-delay: 0.5s; }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="cart-header">
            <h1>Votre Panier</h1>
            <p>L'élégance de la conservation du vin</p>
        </header>
        
        <div class="cart-container">
            <div class="cart-items">
                @if ($errors->any())
                    <div  style="margin-bottom: 1rem; color:red">
                        <ul style="margin: 0;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @forelse ($cart as $item)
                    <div class="cart-item">
                        <div class="item-image">
                            <img src="{{ $item['product']->image ? asset('storage/' . $item['product']->image) : 'https://via.placeholder.com/300x300' }}" alt="{{ $item['product']->nom }}">
                        </div>
                        <div class="item-details">
                            <div class="item-header">
                                <h3 class="item-name">{{ $item['product']->nom }}</h3>
                                <span class="item-price">{{ number_format($item['product']->prix_ttc ?? $item['product']->prix_ht, 2, ',', ' ') }} Dhs</span>
                            </div>
                            <div class="item-actions">
                                <div class="quantity-selector" data-id="{{ $item['product']->id }}">
                                    <button type="button" class="quantity-btn minus">-</button>
                                    <input type="number" class="quantity-input" name="quantity" value="{{ $item['quantity'] }}" min="1" data-id="{{ $item['product']->id }}">
                                    <button type="button" class="quantity-btn plus">+</button>
                                </div>

                                <form action="{{ route('cart.remove', $item['product']->id) }}" method="POST">
                                    @csrf
                                    <button class="remove-btn" type="submit">
                                        <!-- Icon -->
                                        Supprimer
                                    </button>
                                </form>
                                
                                <button class="wishlist-btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                                    </svg>
                                    Ajouter à la liste d'envies
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p>Votre panier est vide.</p>
                @endforelse
            </div>

            <div class="cart-summary">
                <h2>Résumé de la commande</h2>

                <div class="summary-row">
                    <span class="summary-label">
                        Sous-total ({{ count($cart) }} {{ count($cart) > 1 ? 'articles' : 'article' }})
                    </span>
                    <span class="summary-value subtotal">
                        {{ number_format($subtotal, 2, ',', ' ') }} Dhs
                    </span>
                </div>

                <div class="summary-row">
                    <span class="summary-label">Livraison</span>
                    <span class="summary-value shipping">
                        {{ $shipping > 0 ? number_format($shipping, 2, ',', ' ') . ' Dhs' : 'Gratuite' }}
                    </span>
                </div>

                <div class="summary-row grand-total">
                    <span class="summary-label">Total</span>
                    <span class="summary-value total">
                        {{ number_format($total, 2, ',', ' ') }} Dhs
                    </span>
                </div>

                <a href="{{ route('checkout') }}" class="btn">Passer la commande</a>

                <a href="/boutique" class="continue-shopping">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    Continuer vos achats
                </a>
            </div>


        </div>
    </div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.quantity-selector').forEach(selector => {
            const minusBtn = selector.querySelector('.minus');
            const plusBtn = selector.querySelector('.plus');
            const input = selector.querySelector('.quantity-input');
            const productId = selector.dataset.id;

            let debounceTimer = null;

            const updateQuantity = (newQty) => {
                fetch(`/cart/ajax-update/${productId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ quantity: newQty })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        input.value = newQty;

                        // Optional: update individual item total if shown somewhere
                        const itemRow = selector.closest('.cart-item');
                        const priceElement = itemRow.querySelector('.item-price');
                        if (priceElement) {
                            priceElement.textContent = data.item_total + ' Dhs';
                        }

                        // Update summary totals
                        document.querySelector('.summary-value.subtotal').textContent = data.subtotal + ' Dhs';
                        document.querySelector('.summary-value.shipping').textContent = data.shipping + (data.shipping === 'Gratuite' ? '' : ' Dhs');
                        document.querySelector('.summary-value.total').textContent = data.total + ' Dhs';
                    } else {
                        alert(data.message);
                    }
                })
                .catch(err => console.error('Erreur:', err));
            };

            minusBtn.addEventListener('click', function () {
                let current = parseInt(input.value);
                if (current > 1) {
                    updateQuantity(current - 1);
                }
            });

            plusBtn.addEventListener('click', function () {
                let current = parseInt(input.value);
                updateQuantity(current + 1);
            });

            input.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(() => {
                    let val = parseInt(input.value);
                    if (!isNaN(val) && val >= 1) {
                        updateQuantity(val);
                    } else {
                        input.value = 1;
                        updateQuantity(1);
                    }
                }, 500);
            });
        });
    });
</script>


</body>
</html>