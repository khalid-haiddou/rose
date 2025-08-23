<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande - Rose & Bouchon</title>
    <link rel="stylesheet" href="{{ asset('assets/css/checkout.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>

    @include('layouts.header') 

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
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="votre@email.com"
                            value="{{ old('email', Auth::user()->email ?? '') }}"
                            required
                        >
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

                {{-- Section pour utilisateurs non connectés --}}
                @if(!auth()->check())
                <div class="account-promotion">
                    <div class="promotion-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z" fill="currentColor"/>
                            <path d="M12 22L13.09 15.74L20 15L13.09 14.26L12 8L10.91 14.26L4 15L10.91 15.74L12 22Z" fill="currentColor" opacity="0.6"/>
                        </svg>
                    </div>
                    <div class="promotion-content">
                        <h3>Gagnez du crédit fidélité !</h3>
                        <p>Créez votre compte maintenant et obtenez <strong>50 Dhs</strong> de crédit fidélité à utiliser sur vos prochaines commandes.</p>
                        <div class="promotion-benefits">
                            <div class="benefit">
                                <span class="benefit-icon">💰</span>
                                <span>Crédit fidélité sur chaque achat</span>
                            </div>
                            <div class="benefit">
                                <span class="benefit-icon">🎁</span>
                                <span>Offres exclusives membres</span>
                            </div>
                            <div class="benefit">
                                <span class="benefit-icon">📦</span>
                                <span>Suivi de vos commandes</span>
                            </div>
                        </div>
                        <div class="promotion-actions">
                            <a href="{{ route('register') }}" class="btn-primary">Créer mon compte</a>
                            <a href="{{ route('login') }}" class="btn-secondary">Se connecter</a>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Section crédit fidélité pour utilisateurs connectés --}}
                @if(auth()->check())
                    @if($fidelityCredit > 0)
                    <div class="fidelity-section">
                        <div class="fidelity-header">
                            <div class="fidelity-icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 2L13.09 8.26L20 9L13.09 9.74L12 16L10.91 9.74L4 9L10.91 8.26L12 2Z" fill="currentColor"/>
                                </svg>
                            </div>
                            <h3>Crédit fidélité disponible</h3>
                        </div>
                        <div class="fidelity-balance">
                            <span class="balance-amount">{{ number_format($fidelityCredit, 2, ',', ' ') }} Dhs</span>
                            <span class="balance-label">disponible</span>
                        </div>
                        <div class="fidelity-apply">
                            <div class="apply-input-group">
                                <input type="number" 
                                       min="0" 
                                       step="0.01" 
                                       id="cashback" 
                                       name="cashback" 
                                       placeholder="0,00" 
                                       value="0">
                                <span class="input-suffix">Dhs</span>
                            </div>
                            <button type="button" class="apply-btn">Appliquer</button>
                        </div>
                        <div class="fidelity-note">
                            <small>Vous pouvez utiliser jusqu'à {{ number_format(min($fidelityCredit, $subtotal), 2, ',', ' ') }} Dhs sur cette commande</small>
                        </div>
                    </div>
                    @else
                    <div class="fidelity-empty">
                        <div class="empty-icon">
                            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/>
                                <path d="M8 12h8" stroke="currentColor" stroke-width="2"/>
                            </svg>
                        </div>
                        <h4>Aucun crédit fidélité disponible</h4>
                        <p>Gagnez du crédit fidélité sur vos prochains achats !</p>
                    </div>
                    @endif
                @endif

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
                        <span class="total-value" id="subtotal">{{ number_format($subtotal, 2, ',', ' ') }} Dhs</span>
                    </div>
                    <div class="total-row">
                        <span class="total-label">Livraison</span>
                        <span class="total-value" id="shipping">{{ $shipping > 0 ? number_format($shipping, 2, ',', ' ') . ' Dhs' : 'Gratuite' }}</span>
                    </div>
                    @if(auth()->check())
                    <div class="total-row fidelity-discount">
                        <span class="total-label">Remise fidélité</span>
                        <span class="total-value" id="cashback-discount">-0,00 Dhs</span>
                    </div>
                    @endif
                    <div class="total-row grand-total">
                        <span class="total-label">Total</span>
                        <span class="total-value" id="grand-total">{{ number_format($total, 2, ',', ' ') }} Dhs</span>
                    </div>
                </div>

                <div class="terms-checkbox">
                    <input type="checkbox" id="terms" name="terms" required>
                    <label for="terms">J'accepte les <a href="#">conditions générales de vente</a> et la <a href="#">politique de confidentialité</a>.</label>
                </div>

                <button type="submit" class="btn checkout-btn">Passer la commande</button>
            </aside>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const applyBtn = document.querySelector('.apply-btn');
            const cashbackInput = document.getElementById('cashback');
            const cashbackAvailable = {{ $fidelityCredit ?? 0 }};
            const subtotal = {{ $subtotal }};
            const shipping = {{ $shipping }};

            if (!applyBtn || !cashbackInput) return;

            applyBtn.addEventListener('click', () => {
                let cashbackValue = parseFloat(cashbackInput.value) || 0;

                if (cashbackValue < 0) {
                    alert("Veuillez entrer un montant positif.");
                    cashbackInput.value = 0;
                    cashbackValue = 0;
                }

                if (cashbackValue > cashbackAvailable) {
                    alert(`Votre solde disponible est de {{ number_format($fidelityCredit, 2, ',', ' ') }} Dhs`);
                    cashbackValue = cashbackAvailable;
                    cashbackInput.value = cashbackAvailable.toFixed(2);
                }

                if (cashbackValue > subtotal) {
                    alert("Le cashback ne peut pas dépasser le montant total des produits.");
                    cashbackValue = subtotal;
                    cashbackInput.value = subtotal.toFixed(2);
                }

                const total = subtotal + shipping - cashbackValue;

                document.getElementById('cashback-discount').textContent = '-' + cashbackValue.toFixed(2).replace('.', ',') + ' Dhs';
                document.getElementById('grand-total').textContent = total.toFixed(2).replace('.', ',') + ' Dhs';
            });
        });
</script>
    
    @include('layouts.footer') 

</body>
</html>