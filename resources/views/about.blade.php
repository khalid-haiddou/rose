<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>À Propos - Rose & Bouchon</title>
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
        
        .about-header {
            width: 100%;
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .about-header h1 {
            color: var(--navy);
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 2.8rem;
            margin-bottom: 0.5rem;
            font-variant: small-caps;
        }
        
        .about-header p {
            color: var(--burgundy);
            font-style: italic;
            font-size: 1.2rem;
            letter-spacing: 0.3px;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .about-section {
            background-color: var(--ivory);
            padding: 3rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--burgundy);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(150, 0, 24, 0.1);
            margin-bottom: 3rem;
        }
        
        .about-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--navy), var(--burgundy));
            z-index: 2;
        }
        
        .about-section::after {
            content: '🍷';
            position: absolute;
            bottom: -30px;
            right: -30px;
            font-size: 180px;
            opacity: 0.03;
            z-index: 0;
            transform: rotate(15deg);
        }
        
        .about-section h2 {
            color: var(--navy);
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 117, 0.1);
            font-weight: 600;
            letter-spacing: 0.3px;
            position: relative;
        }
        
        .about-section h2::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100px;
            height: 2px;
            background: var(--burgundy);
        }
        
        .about-section p {
            line-height: 1.8;
            margin-bottom: 1.5rem;
            font-size: 1.1rem;
        }
        
        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }
        
        .about-card {
            background-color: rgba(255, 255, 255, 0.7);
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(150, 0, 24, 0.1);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            border-color: rgba(150, 0, 24, 0.2);
        }
        
        .about-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(to bottom, var(--navy), var(--burgundy));
        }
        
        .about-card h3 {
            color: var(--navy);
            font-size: 1.4rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        
        .about-card h3 i {
            margin-right: 0.75rem;
            color: var(--burgundy);
        }
        
        .about-card p {
            font-size: 1rem;
            line-height: 1.6;
            color: var(--dark);
        }
        
        .image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin: 3rem 0;
        }
        
        .gallery-item {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            height: 300px;
            position: relative;
        }
        
        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.05);
        }
        
        .gallery-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 1rem;
            background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
            color: white;
            font-style: italic;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .gallery-item:hover .gallery-caption {
            opacity: 1;
        }
        
        .social-section {
            text-align: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .social-section h3 {
            color: var(--navy);
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .social-section p {
            color: var(--dark);
            max-width: 600px;
            margin: 0 auto 2rem;
            font-size: 1.05rem;
            line-height: 1.6;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 1.2rem;
            flex-wrap: wrap;
        }
        
        .social-link {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--ivory);
            font-size: 1.1rem;
            transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            text-decoration: none;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(150, 0, 24, 0.3);
            background-color: var(--burgundy);
            box-shadow: 0 3px 10px rgba(150, 0, 24, 0.1);
        }
        
        .social-link:hover {
            transform: translateY(-3px) scale(1.05);
            box-shadow: 0 6px 16px rgba(150, 0, 24, 0.2);
            color: var(--ivory);
        }
        
        .social-link i {
            position: relative;
            z-index: 2;
            transition: transform 0.3s ease;
        }
        
        .social-link:hover i {
            transform: scale(1.1);
        }
        
        .social-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--navy), var(--burgundy));
            opacity: 0;
            transition: opacity 0.4s ease;
        }
        
        .social-link:hover::before {
            opacity: 1;
        }
        
        .social-link.instagram { background-color: #E1306C; border-color: #E1306C; }
        .social-link.facebook { background-color: #1877F2; border-color: #1877F2; }
        .social-link.pinterest { background-color: #E60023; border-color: #E60023; }
        .social-link.youtube { background-color: #FF0000; border-color: #FF0000; }
        .social-link.tiktok { background-color: #000000; border-color: #000000; }
        
        /* Mobile-specific enhancements */
        @media (max-width: 768px) {
            body {
                padding: 15px;
                background-image: linear-gradient(rgba(254, 254, 250, 0.96), rgba(254, 254, 250, 0.98)), 
                                  url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=1200');
            }
            
            .about-header h1 {
                font-size: 2.2rem;
            }
            
            .about-header p {
                font-size: 1rem;
            }
            
            .about-section {
                padding: 2rem 1.5rem;
            }
            
            .about-section h2 {
                font-size: 1.5rem;
            }
            
            .about-section::after {
                font-size: 140px;
                bottom: -20px;
                right: -20px;
            }
            
            .image-gallery {
                grid-template-columns: 1fr;
            }
            
            .social-links {
                gap: 1rem;
            }
            
            .social-link {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }
        }
        
        /* Animation for subtle interactivity */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .about-header {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .about-section {
            opacity: 0;
            animation: fadeIn 0.6s ease-out 0.2s forwards;
        }
        
        .about-card, .gallery-item {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .about-card:nth-child(1) { animation-delay: 0.3s; }
        .about-card:nth-child(2) { animation-delay: 0.4s; }
        .about-card:nth-child(3) { animation-delay: 0.5s; }
        .gallery-item:nth-child(1) { animation-delay: 0.3s; }
        .gallery-item:nth-child(2) { animation-delay: 0.4s; }
        .gallery-item:nth-child(3) { animation-delay: 0.5s; }
        .gallery-item:nth-child(4) { animation-delay: 0.6s; }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <div class="container">
        <header class="about-header">
            <h1>Notre Histoire</h1>
            <p>Depuis 2010, Rose & Bouchon sublime l'art de la dégustation du vin à travers des accessoires d'exception</p>
        </header>
        
        <section class="about-section">
            <h2>L'élégance au service du vin</h2>
            <p>Fondée par deux passionnés d'œnologie, Rose & Bouchon est née de l'envie de partager notre amour du vin à travers des accessoires qui allient esthétique et fonctionnalité. Notre boutique en ligne est le reflet de cet engagement : chaque produit est soigneusement sélectionné pour son design raffiné et sa capacité à enrichir votre expérience de dégustation.</p>
            
            <p>Nous croyons que le vin se vit comme un art, et nos accessoires sont les pinceaux qui vous permettent de peindre votre propre chef-d'œuvre œnologique. De la cave à la table, chaque détail compte pour transformer un simple verre en un moment d'exception.</p>
            
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
                    <img src="https://images.unsplash.com/photo-1558160074-4d7d8bdf4256?q=80&w=1000" alt="Cave à vin élégante">
                    <div class="gallery-caption">Notre sélection de caves à vin</div>
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1608270586620-248524c67de9?q=80&w=1000" alt="Verres à vin">
                    <div class="gallery-caption">Verres de dégustation premium</div>
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1568219656418-15c329312bf1?q=80&w=1000" alt="Accessoires en bois">
                    <div class="gallery-caption">Accessoires en bois massif</div>
                </div>
                <div class="gallery-item">
                    <img src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?q=80&w=1000" alt="Dégustation de vin">
                    <div class="gallery-caption">L'art de la dégustation</div>
                </div>
            </div>
            
            <div class="social-section">
                <h3>Rejoignez notre communauté œnophile</h3>
                <p>Suivez-nous pour découvrir nos nouveautés, conseils de dégustation et moments de partage autour du vin.</p>
                
                <div class="social-links">
                    <a href="#" class="social-link instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-link facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-link pinterest">
                        <i class="fab fa-pinterest-p"></i>
                    </a>
                    <a href="#" class="social-link youtube">
                        <i class="fab fa-youtube"></i>
                    </a>
                    <a href="#" class="social-link tiktok">
                        <i class="fab fa-tiktok"></i>
                    </a>
                </div>
            </div>
        </section>
    </div>
</body>
</html>