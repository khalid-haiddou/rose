<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'art de la dégustation | Blog Rose & Bouchon</title>
    <style>
        :root {
            --burgundy: #7D1A1A;
            --gold: #D4AF37;
            --navy: #1E1E2C;
            --ivory: #F8F4E9;
            --taupe: #C8B6A6;
            --rose: #E8C4C4;
        }

        body {
            font-family: 'Cormorant Garamond', serif;
            background-color: var(--ivory);
            color: var(--navy);
            line-height: 1.8;
            margin: 0;
            padding: 0;
        }

        /* Header */
        .article-hero {
            /*height: 80vh;*/
            background: linear-gradient(rgba(30, 30, 44, 0.7), rgba(30, 30, 44, 0.7)), 
                        url('https://images.unsplash.com/photo-1470337458703-46ad1756a187?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80') center/cover;
            display: flex;
            align-items: flex-end;
            position: relative;
        }

        .hero-content {
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
            padding: 4rem 2rem;
            position: relative;
            z-index: 2;
            color: var(--ivory);
        }

        .article-category {
            display: inline-block;
            background: var(--gold);
            color: var(--navy);
            padding: 0.5rem 1.5rem;
            border-radius: 20px;
            font-size: 0.9rem;
            letter-spacing: 1px;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            font-weight: 600;
        }

        .article-title {
            font-family: 'Playfair Display', serif;
            font-size: 4rem;
            margin: 0 0 1rem 0;
            color: var(--ivory);
            line-height: 1.2;
            font-weight: 700;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.3);
        }

        .article-meta {
            display: flex;
            align-items: center;
            color: var(--taupe);
            font-size: 1rem;
        }

        .article-date {
            margin-right: 2rem;
            display: flex;
            align-items: center;
        }

        .article-date i {
            margin-right: 0.5rem;
            color: var(--rose);
        }

        .article-author {
            display: flex;
            align-items: center;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 0.8rem;
            object-fit: cover;
            border: 2px solid var(--gold);
        }

        /* Main Content */
        .article-container {
            max-width: 1100px;
            margin: -2rem auto 0;
            padding: 0 2rem;
            position: relative;
            z-index: 3;
        }

        .article-featured-image {
            width: 100%;
            height: 500px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 3rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            border: 8px solid white;
        }

        .article-body {
            background: white;
            padding: 4rem;
            border-radius: 4px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.03);
            margin-bottom: 4rem;
            position: relative;
        }

        .article-body:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--gold), var(--burgundy));
        }

        .article-intro {
            font-size: 1.3rem;
            color: var(--navy);
            margin-bottom: 3rem;
            font-weight: 500;
            line-height: 1.9;
            position: relative;
            padding-left: 2rem;
            border-left: 3px solid var(--gold);
        }

        .article-content {
            font-size: 1.1rem;
            line-height: 1.9;
        }

        .article-content p {
            margin-bottom: 2rem;
        }

        .article-content h2 {
            font-size: 2rem;
            color: var(--burgundy);
            margin: 3.5rem 0 1.5rem 0;
            font-weight: 600;
            font-family: 'Playfair Display', serif;
            position: relative;
            padding-bottom: 0.8rem;
        }

        .article-content h2:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 2px;
            background: var(--gold);
        }

        .article-content h3 {
            font-size: 1.5rem;
            color: var(--navy);
            margin: 2.5rem 0 1.5rem 0;
            font-weight: 500;
            font-family: 'Playfair Display', serif;
        }

        .article-content blockquote {
            border-left: 3px solid var(--gold);
            padding: 1.5rem 2rem;
            margin: 3rem 0;
            font-style: italic;
            color: var(--navy);
            font-size: 1.3rem;
            line-height: 1.7;
            background: var(--ivory);
            position: relative;
        }

        .article-content blockquote:before {
            content: '"';
            position: absolute;
            top: 0;
            left: 1rem;
            font-size: 4rem;
            color: rgba(125, 26, 26, 0.1);
            font-family: 'Playfair Display', serif;
            line-height: 1;
        }

        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin: 2.5rem 0;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .wine-tip {
            background: var(--ivory);
            border-left: 4px solid var(--gold);
            padding: 1.5rem;
            margin: 2rem 0;
            position: relative;
            border-radius: 0 4px 4px 0;
        }

        .tip-title {
            color: var(--burgundy);
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            font-family: 'Playfair Display', serif;
        }

        .tip-title i {
            margin-right: 0.8rem;
            color: var(--gold);
        }

        /* Social Sharing */
        .social-sharing {
            display: flex;
            justify-content: center;
            margin: 3rem 0;
        }

        .share-button {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--ivory);
            color: var(--navy);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
            border: 1px solid var(--taupe);
        }

        .share-button:hover {
            background: var(--burgundy);
            color: white;
            transform: translateY(-3px);
        }

        /* Related Articles */
        .related-articles {
            background: white;
            padding: 5rem 2rem;
            position: relative;
            overflow: hidden;
        }

        .related-articles:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=2000') center/cover;
            opacity: 0.03;
            z-index: 0;
        }

        .related-container {
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--burgundy);
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }

        .section-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gold), transparent);
        }

        .articles-slider {
            display: flex;
            gap: 2rem;
            overflow-x: auto;
            padding: 1rem 0;
            scroll-snap-type: x mandatory;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE/Edge */
        }

        .articles-slider::-webkit-scrollbar {
            display: none; /* Chrome/Safari */
        }

        .article-card {
            background: white;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            min-width: 300px;
            scroll-snap-align: start;
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .article-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .card-image {
            height: 200px;
            width: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .article-card:hover .card-image {
            transform: scale(1.05);
        }

        .card-content {
            padding: 1.5rem;
        }

        .card-category {
            color: var(--gold);
            font-size: 0.8rem;
            letter-spacing: 1px;
            margin-bottom: 0.5rem;
            display: block;
            text-transform: uppercase;
            font-weight: 600;
        }

        .card-title {
            font-size: 1.3rem;
            margin: 0.5rem 0 1rem 0;
            font-weight: 600;
            line-height: 1.4;
            font-family: 'Playfair Display', serif;
        }

        .card-excerpt {
            font-size: 0.95rem;
            color: var(--navy);
            margin-bottom: 1.5rem;
            opacity: 0.8;
        }

        .read-more {
            color: var(--burgundy);
            text-decoration: none;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }

        .read-more:after {
            content: '→';
            margin-left: 0.5rem;
            transition: all 0.3s ease;
        }

        .read-more:hover {
            color: var(--gold);
        }

        .read-more:hover:after {
            transform: translateX(3px);
        }

        /* Newsletter */
        .newsletter {
            background: var(--navy);
            color: var(--ivory);
            padding: 5rem 2rem;
            text-align: center;
            position: relative;
        }

        .newsletter:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=2000') center/cover;
            opacity: 0.05;
            z-index: 0;
        }

        .newsletter-container {
            max-width: 600px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .newsletter-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--gold);
            margin-bottom: 1.5rem;
        }

        .newsletter-subtitle {
            font-size: 1.1rem;
            color: var(--taupe);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 2rem auto 0;
        }

        .newsletter-input {
            flex: 1;
            padding: 1rem;
            border: none;
            border-radius: 4px 0 0 4px;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            background: rgba(255, 255, 255, 0.9);
        }

        .newsletter-button {
            background: var(--gold);
            color: var(--navy);
            border: none;
            padding: 0 2rem;
            border-radius: 0 4px 4px 0;
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .newsletter-button:hover {
            background: var(--rose);
        }

        /* Responsive */
        @media (max-width: 992px) {
            .article-title {
                font-size: 3rem;
            }
            
            .article-featured-image {
                height: 400px;
            }
        }

        @media (max-width: 768px) {
            /*.article-hero {
                height: 70vh;
            }*/
            
            .article-title {
                font-size: 2.2rem;
            }
            
            .article-body {
                padding: 3rem 1.5rem;
            }
            
            .article-featured-image {
                height: 350px;
                margin-bottom: 2rem;
            }
            
            .article-intro {
                font-size: 1.2rem;
                padding-left: 1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .articles-slider {
                gap: 1.5rem;
            }
            
            .article-card {
                min-width: 350px;
            }
            
            .newsletter-form {
                flex-direction: column;
            }
            
            .newsletter-input {
                border-radius: 4px;
                margin-bottom: 1rem;
            }
            
            .newsletter-button {
                border-radius: 4px;
                padding: 1rem;
            }
        }

        @media (max-width: 576px) {
            .article-title {
                font-size: 1.8rem;
            }
            
            .article-meta {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .article-date {
                margin-right: 0;
                margin-bottom: 1rem;
            }
            
            .hero-content {
                padding: 3rem 1rem;
            }
            
            .article-content h2 {
                font-size: 1.6rem;
            }
            
            .article-content h3 {
                font-size: 1.3rem;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    @include('layouts.header') 

    <!-- Hero Section -->
    <header class="article-hero">
        <div class="hero-content">
            <span class="article-category">Dégustation</span>
            <h1 class="article-title">L'art subtil de la dégustation du vin rouge</h1>
            <div class="article-meta">
                <span class="article-date"><i class="far fa-calendar-alt"></i> 15 mars 2023</span>
                <span class="article-author">
                    <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sophie Laurent" class="author-avatar">
                    Par Sophie Laurent
                </span>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="article-container">
        <img src="https://images.unsplash.com/photo-1568219656418-15c329312bf1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Verres de vin rouge" class="article-featured-image">
        
        <article class="article-body">
            <p class="article-intro">La dégustation du vin est un art qui engage tous les sens. Ce guide complet vous révèle les techniques des sommeliers pour apprécier pleinement chaque nuance d'un grand vin rouge, de l'examen visuel à la longueur en bouche.</p>
            
            <div class="article-content">
                <h2>La préparation : cadre et matériel</h2>
                <p>Avant même de déboucher la bouteille, préparez votre environnement. La température idéale se situe entre 18-20°C, sans odeurs parasites. Utilisez des verres à vin appropriés :</p>
                
                <ul>
                    <li>Verre à bourgogne pour les vins subtils et aromatiques</li>
                    <li>Verre à bordeaux pour les vins plus tanniques</li>
                    <li>Cristal transparent pour bien apprécier la robe</li>
                </ul>
                
                <div class="wine-tip">
                    <div class="tip-title"><i class="fas fa-lightbulb"></i> Astuce de pro</div>
                    <p>Rincez vos verres à l'eau claire sans détergent et essuyez-les avec un linge propre sans peluches pour éviter toute interférence avec les arômes.</p>
                </div>
                
                <h2>L'examen visuel : lire la robe</h2>
                <p>Inclinez votre verre à 45° devant une surface blanche. Observez :</p>
                
                <img src="https://images.unsplash.com/photo-1563227812-0ea4c22e6cc8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Examen visuel du vin">
                
                <blockquote>
                    "La robe d'un vin raconte son histoire - un jeune vin arbore des reflets violets, tandis qu'un vin mature prend des teintes tuilées. Les larmes qui coulent le long du verre révèlent sa richesse alcoolique."
                </blockquote>
                
                <h3>Ce que la couleur vous dit :</h3>
                <p><strong>Pourpre profond</strong> : Jeunesse, potentiel de garde<br>
                <strong>Rubis</strong> : Maturité naissante (3-5 ans)<br>
                <strong>Tuilé</strong> : Pleine maturité (8-10 ans+)</p>
                
                <h2>L'analyse olfactive : le bouquet</h2>
                <p>Faites tourner doucement le vin pour libérer ses arômes, puis plongez votre nez dans le verre. Identifiez trois niveaux :</p>
                
                <div class="wine-tip">
                    <div class="tip-title"><i class="fas fa-wine-glass-alt"></i> Technique professionnelle</div>
                    <p>Pour développer votre nez, entraînez-vous avec des "nez aromatiques" - des petits flacons contenant des arômes typiques (fruits rouges, épices, notes boisées...).</p>
                </div>
                
                <h3>Les familles aromatiques :</h3>
                <p><strong>Primaires</strong> : Fruits (cassis, cerise), fleurs (violette)<br>
                <strong>Secondaires</strong> : Fermentation (pain grillé, levure)<br>
                <strong>Tertiaires</strong> : Élevage (vanille, tabac, cuir)</p>
                
                <h2>La dégustation en bouche</h2>
                <p>Prenez une petite gorgée (environ 15ml) et faites circuler le vin dans votre bouche pendant 8-10 secondes. Évaluez :</p>
                
                <img src="https://images.unsplash.com/photo-1470337458703-46ad1756a187?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Dégustation de vin">
                
                <ul>
                    <li><strong>Attaque</strong> : Première impression (acidité, sucre)</li>
                    <li><strong>Milieu de bouche</strong> : Développement des arômes</li>
                    <li><strong>Finale</strong> : Persistance après déglutition</li>
                </ul>
                
                <h3>L'équilibre idéal :</h3>
                <p>Un grand vin équilibre alcool, acidité, tanins et fruité. Les tanins doivent être présents mais soyeux, l'acidité suffisante pour rafraîchir sans être agressive.</p>
            </div>
            
            <div class="social-sharing">
                <a href="#" class="share-button"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="share-button"><i class="fab fa-twitter"></i></a>
                <a href="#" class="share-button"><i class="fab fa-pinterest-p"></i></a>
                <a href="#" class="share-button"><i class="fas fa-envelope"></i></a>
            </div>
        </article>
    </main>

    <!-- Related Articles -->
    <section class="related-articles">
        <div class="related-container">
            <h2 class="section-title">À découvrir ensuite</h2>
            <div class="articles-slider">
                <article class="article-card">
                    <img src="https://images.unsplash.com/photo-1558160074-4d7d8bdf4256?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Cave à vin" class="card-image">
                    <div class="card-content">
                        <span class="card-category">Conservation</span>
                        <h3 class="card-title">Aménager sa cave à vin : guide complet</h3>
                        <p class="card-excerpt">Tout ce que vous devez savoir pour créer l'environnement parfait pour votre collection.</p>
                        <a href="#" class="read-more">Lire l'article</a>
                    </div>
                </article>
                
                <article class="article-card">
                    <img src="https://images.unsplash.com/photo-1608270586620-248524c67de9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Tire-bouchon" class="card-image">
                    <div class="card-content">
                        <span class="card-category">Accessoires</span>
                        <h3 class="card-title">Les essentiels du parfait œnophile</h3>
                        <p class="card-excerpt">Notre sélection des accessoires indispensables pour déguster comme un pro.</p>
                        <a href="#" class="read-more">Lire l'article</a>
                    </div>
                </article>
                
                <article class="article-card">
                    <img src="https://images.unsplash.com/photo-1600788886242-5c96aabe3757?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Cave moderne" class="card-image">
                    <div class="card-content">
                        <span class="card-category">Technologie</span>
                        <h3 class="card-title">Les caves connectées nouvelle génération</h3>
                        <p class="card-excerpt">Comment la technologie révolutionne la conservation du vin.</p>
                        <a href="#" class="read-more">Lire l'article</a>
                    </div>
                </article>

                <article class="article-card">
                    <img src="https://images.unsplash.com/photo-1514944288352-fffac99f0bdf?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Accords mets-vins" class="card-image">
                    <div class="card-content">
                        <span class="card-category">Accords</span>
                        <h3 class="card-title">Les accords parfaits mets & vins</h3>
                        <p class="card-excerpt">Découvrez comment marier vos plats avec les vins idéaux.</p>
                        <a href="#" class="read-more">Lire l'article</a>
                    </div>
                </article>

                <article class="article-card">
                    <img src="https://images.unsplash.com/photo-1608848461950-0fe51dfc41cb?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Vignoble" class="card-image">
                    <div class="card-content">
                        <span class="card-category">Terroir</span>
                        <h3 class="card-title">Les grands crus bordelais à découvrir</h3>
                        <p class="card-excerpt">Parcourez les vignobles emblématiques de Bordeaux et leurs vins d'exception.</p>
                        <a href="#" class="read-more">Lire l'article</a>
                    </div>
                </article>
            </div>
        </div>
    </section>


    @include('layouts.footer') 
</body>
</html>