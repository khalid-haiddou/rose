<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos - Rose & Bouchon</title>

    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/about.css') }}">

</head>
<body>
       @include('layouts.header') 
    <div class="container">
<header class="about-header">
    <div class="vintage-border"></div>       
    <h1>L'excellence des accessoires de dégustation du vin</h1>
    <p class="subtitle">DRose & Bouchon – L’élégance du vin, depuis 2010</p>
    <div class="wine-divider">
        <div class="grape"></div>
        <div class="vine"></div>
        <div class="grape"></div>
    </div>
</header>
        
        <section class="about-section">
                       <h2>Rose & Bouchon – L’élégance au service des amateurs de vin</h2>
            <p>Née de la passion sincère de ses fondateurs pour l’œnologie, Rose & Bouchon a été créée avec une ambition claire : offrir aux amoureux du vin les meilleurs accessoires de conservation et de dégustation, sélectionnés avec exigence et testés avec rigueur.</p>           
            <p>Notre équipe, passionnée et experte, a exploré les meilleurs fournisseurs de caves à vin, tire-bouchons, aérateurs, décanteurs et accessoires de service, afin de vous proposer le juste équilibre entre qualité, durabilité et prix.</p>
            <p>Mais Rose & Bouchon, c’est bien plus qu’une boutique : c’est un partenaire de confiance pour vous accompagner, vous conseiller et enrichir votre plaisir de dégustation — de la cave à la table.</p>
  
            <div class="about-grid">
                <div class="about-card">
                    <h3><i class="fas fa-medal"></i> Notre Engagement</h3>
                    <p>Qualité artisanale, matériaux nobles et finitions impeccables. Chaque produit Rose & Bouchon est conçu pour durer et s'améliorer avec le temps, comme un grand cru.</p>
                </div>
                
                <div class="about-card">
                    <h3><i class="fas fa-leaf"></i> Éco-responsabilité</h3>
                    <p>Nous privilégions les matériaux durables et les producteurs locaux. Nos emballages sont 100% recyclables et nos processus de fabrication respectent l'environnement.</p>
                </div>
                
                <div class="about-card">
                    <h3><i class="fas fa-star"></i> Expertise</h3>
                    <p>Notre équipe d'œnologues vous guide dans vos choix à travers des conseils personnalisés et des articles éducatifs pour approfondir votre connaissance du vin.</p>
                </div>
            </div>
            
            <div class="image-gallery">
                <div class="gallery-item">
                    <img src="{{ asset('assets/images/vin3.png') }}" alt="Cave à vin élégante">
                    <div class="gallery-caption">Notre sélection de caves à vin</div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/images/vin2.JPG') }}" alt="Verres à vin">
                    <div class="gallery-caption">Verres de dégustation premium</div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/images/vin3.png') }}" alt="Accessoires en bois">
                    <div class="gallery-caption">Accessoires en bois massif</div>
                </div>
                <div class="gallery-item">
                    <img src="{{ asset('assets/images/vin4.JPG ') }}" alt="Dégustation de vin">
                    <div class="gallery-caption">L'art de la dégustation</div>
                </div>
            </div>
            
            
        </section>
    </div>
       @include('layouts.footer') 
<script>
    // Animation des cartes au scroll
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animated');
        }
    });
}, {threshold: 0.1});

document.querySelectorAll('.about-card, .gallery-item').forEach(card => {
    observer.observe(card);
});
</script>
</body>
</html>