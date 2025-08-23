<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan du site - Rose & Bouchon</title>
    <link rel="stylesheet" href="{{ asset('assets/css/plan.css') }}">
  
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    @include('layouts.header')

    <div class="container">
        <h1>Plan du site</h1>
        
        <div class="sitemap-grid">
            <div class="sitemap-section">
                <h2>Navigation</h2>
                <ul class="sitemap-list">
                    <li><a href="/">Accueil</a></li>
                    <li><a href="/boutique">Boutique</a>
                        <ul class="sub-list">
                            <li><a href="/boutique?categories[]=1">Cave à vin</a></li>
                            <li><a href="/boutique?categories[]=2">Accessoires</a></li>
                            <li><a href="/boutique?categories[]=3">Décantation</a></li>
                            <li><a href="/boutique?categories[]=4">Cadeaux</a></li>
                        </ul>
                    </li>
                    <li><a href="/a-propos">À propos</a></li>
                    <li><a href="/contact">Contact</a></li>
                    <li><a href="/blog">Blog & Conseils</a></li>
                </ul>
            </div>
            
            <div class="sitemap-section">
                <h2>Compte</h2>
                <ul class="sitemap-list">
                    <li><a href="/connexion">Connexion</a></li>
                    <li><a href="/inscription">Inscription</a></li>
                    <li><a href="/mon-compte">Mon compte</a>
                        <ul class="sub-list">
                            <li><a href="/mon-compte/commandes">Commandes</a></li>
                            <li><a href="/mon-compte/adresses">Adresses</a></li>
                            <li><a href="/mon-compte/infos">Informations</a></li>
                        </ul>
                    </li>
                    <li><a href="/mot-de-passe-oublie">Mot de passe oublié</a></li>
                </ul>
            </div>
            
            <div class="sitemap-section">
                <h2>Informations</h2>
                <ul class="sitemap-list">
                    <li><a href="/conditions-generales">CGV</a></li>
                    <li><a href="/politique-confidentialite">Confidentialité</a></li>
                    <li><a href="/mentions-legales">Mentions légales</a></li>
                    <li><a href="/retours-remboursements">Retours</a></li>
                    <li><a href="/livraison">Livraison</a></li>
                    <li><a href="/paiement-securise">Paiement</a></li>
                    <li><a href="/faq">FAQ</a></li>
                </ul>
            </div>
            
            <div class="sitemap-section">
                <h2>Produits</h2>
                <ul class="sitemap-list">
                    <li><a href="/produits/cave-thermo-electrique">Cave thermo-électrique</a></li>
                    <li><a href="/produits/souffleur-verres">Souffleur à verres</a></li>
                    <li><a href="/produits/thermometre-vin">Thermomètre vin</a></li>
                    <li><a href="/produits/coffret-degustation">Coffret dégustation</a></li>
                    <li><a href="/produits/coupe-champagne">Coupe champagne</a></li>
                </ul>
            </div>
        </div>
    </div>

    @include('layouts.footer')
</body>
</html>