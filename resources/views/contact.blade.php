<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - Rose & Bouchon</title>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/contact.css') }}">

</head>
<body>
           @include('layouts.header') 

    <div class="container">
        <header class="contact-header">
            <h1>Contactez-nous</h1>
            <p>Nos conseillers œnophiles sont à votre écoute</p>
        </header>
        
        <form class="contact-form" method="POST" action="{{ route('contact.submit') }}">
            @csrf
            <section class="form-section">
                <h2>Envoyez-nous un message</h2>
                <div class="form-row">
                    <div class="form-group">
                        <label for="contact-name">Nom complet</label>
                        <input type="text" id="contact-name" name="name" placeholder="Votre nom" required>
                    </div>
                    <div class="form-group">
                        <label for="contact-email">Email</label>
                        <input type="email" id="contact-email" name="email" placeholder="votre@email.com" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="contact-subject">Sujet</label>
                    <input type="text" id="contact-subject" name="subject" placeholder="Objet de votre message" required>
                </div>
                <div class="form-group">
                    <label for="contact-message">Message</label>
                    <textarea id="contact-message" name="message" placeholder="Votre message..." required></textarea>
                </div>
            </section>

            <button type="submit" class="btn">Envoyer le message</button>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </form>
        
        
        <aside class="contact-info">
            <h2>Nos coordonnées</h2>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="info-content">
                    <h3>Notre boutique</h3>
                    <p>123 Avenue des Vignerons<br>75000 Paris, France</p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-phone-alt"></i>
                </div>
                <div class="info-content">
                    <h3>Téléphone</h3>
                    <p><a href="tel:+33123456789">+212 07 70 70 70 32</a><br>Lundi au vendredi, 9h-18h</p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <div class="info-content">
                    <h3>Email</h3>
                    <p><a href="mailto:contact@roseetbouchon.com">contact@roseetbouchon.com</a><br>Réponse sous 24h</p>
                </div>
            </div>
            
            <div class="info-item">
                <div class="info-icon">
                    <i class="fas fa-share-alt"></i>
                </div>
                <div class="info-content">
                    <h3>Réseaux sociaux</h3>
                    <p>Suivez-nous pour nos conseils œnologiques et nouveautés</p>
                    <div class="social-links">
                        <a href="https://www.instagram.com/rose.et.bouchon/" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.facebook.com/rose.et.bouchon#" class="social-link"><i class="fab fa-instagram"></i></a>

                    </div>
                </div>
            </div>
        </aside>
    </div>
        @include('layouts.footer') 
</body>
</html>