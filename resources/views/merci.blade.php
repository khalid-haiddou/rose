<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merci - Rose & Bouchon</title>
    <link rel="stylesheet" href="{{ asset('assets/css/merci.css') }}">

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
            @include('layouts.header') 

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
   @include('layouts.footer') 

    <!-- Include your footer here -->
</body>
</html>