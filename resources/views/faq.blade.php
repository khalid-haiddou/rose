<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Rose & Bouchon</title>
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
            max-width: 1000px;
            margin: 0 auto;
            width: 100%;
        }
        
        .faq-header {
            width: 100%;
            text-align: center;
            margin-bottom: 3rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .faq-header h1 {
            color: var(--navy);
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 2.8rem;
            margin-bottom: 0.5rem;
            font-variant: small-caps;
        }
        
        .faq-header p {
            color: var(--burgundy);
            font-style: italic;
            font-size: 1.2rem;
            letter-spacing: 0.3px;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .faq-container {
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
        
        .faq-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--navy), var(--burgundy));
            z-index: 2;
        }
        
        .faq-container::after {
            content: '🍷';
            position: absolute;
            bottom: -30px;
            right: -30px;
            font-size: 180px;
            opacity: 0.03;
            z-index: 0;
            transform: rotate(15deg);
        }
        
        .faq-category {
            margin-bottom: 3rem;
        }
        
        .faq-category h2 {
            color: var(--navy);
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid rgba(0, 0, 117, 0.1);
            font-weight: 600;
            letter-spacing: 0.3px;
            position: relative;
        }
        
        .faq-category h2::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100px;
            height: 2px;
            background: var(--burgundy);
        }
        
        .faq-item {
            margin-bottom: 1.5rem;
            border-bottom: 1px solid rgba(150, 0, 24, 0.1);
            padding-bottom: 1.5rem;
        }
        
        .faq-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }
        
        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            padding: 1rem 0;
            transition: all 0.3s ease;
        }
        
        .faq-question:hover {
            color: var(--burgundy);
        }
        
        .faq-question h3 {
            font-size: 1.2rem;
            font-weight: 500;
            margin-right: 1rem;
        }
        
        .faq-question .icon {
            width: 24px;
            height: 24px;
            position: relative;
            flex-shrink: 0;
        }
        
        .faq-question .icon::before,
        .faq-question .icon::after {
            content: '';
            position: absolute;
            background-color: var(--burgundy);
            transition: all 0.3s ease;
        }
        
        .faq-question .icon::before {
            width: 100%;
            height: 2px;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .faq-question .icon::after {
            width: 2px;
            height: 100%;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .faq-question.active .icon::after {
            transform: translateX(-50%) rotate(90deg);
            opacity: 0;
        }
        
        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            padding-left: 1.5rem;
            border-left: 2px solid rgba(150, 0, 24, 0.1);
        }
        
        .faq-answer p {
            line-height: 1.8;
            padding: 1rem 0;
            font-size: 1.05rem;
        }
        
        .faq-answer.active {
            max-height: 500px;
        }
        
        .contact-prompt {
            text-align: center;
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(150, 0, 24, 0.1);
        }
        
        .contact-prompt h3 {
            color: var(--navy);
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .contact-prompt p {
            color: var(--dark);
            max-width: 600px;
            margin: 0 auto 1.5rem;
            font-size: 1.05rem;
            line-height: 1.6;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
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
            text-decoration: none;
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
        
        /* Mobile-specific enhancements */
        @media (max-width: 768px) {
            body {
                padding: 15px;
                background-image: linear-gradient(rgba(254, 254, 250, 0.96), rgba(254, 254, 250, 0.98)), 
                                  url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=1200');
            }
            
            .faq-header h1 {
                font-size: 2.2rem;
            }
            
            .faq-header p {
                font-size: 1rem;
            }
            
            .faq-container {
                padding: 2rem 1.5rem;
            }
            
            .faq-category h2 {
                font-size: 1.5rem;
            }
            
            .faq-container::after {
                font-size: 140px;
                bottom: -20px;
                right: -20px;
            }
            
            .faq-question h3 {
                font-size: 1.1rem;
            }
        }
        
        /* Animation for subtle interactivity */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .faq-header {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .faq-container {
            opacity: 0;
            animation: fadeIn 0.6s ease-out 0.2s forwards;
        }
        
        .faq-category {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .faq-category:nth-child(1) { animation-delay: 0.3s; }
        .faq-category:nth-child(2) { animation-delay: 0.4s; }
        .faq-category:nth-child(3) { animation-delay: 0.5s; }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <header class="faq-header">
            <h1>Questions Fréquentes</h1>
            <p>Trouvez les réponses à vos questions sur nos produits et services</p>
        </header>
        
        <div class="faq-container">
            <div class="faq-category">
                <h2>Commandes & Livraison</h2>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Quels sont les délais de livraison ?</h3>
                        <div class="icon"></div>
                    </div>
                    <div class="faq-answer">
                        <p>Nos délais de livraison standard sont de 2 à 4 jours ouvrés en France métropolitaine. Pour les commandes passées avant 12h, nous expédions le jour même. Les livraisons en Europe prennent généralement 5 à 7 jours ouvrés. Vous recevrez un email de confirmation avec un numéro de suivi dès l'expédition de votre colis.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Quels sont les frais de livraison ?</h3>
                        <div class="icon"></div>
                    </div>
                    <div class="faq-answer">
                        <p>Les frais de livraison standard sont de 40 Dhs pour la France métropolitaine. Nous offrons la livraison gratuite pour toutes les commandes supérieures à 300 Dhs. Pour les livraisons en Europe, les frais sont calculés en fonction du pays de destination et apparaîtront au moment de la validation de votre panier.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Puis-je modifier ou annuler ma commande ?</h3>
                        <div class="icon"></div>
                    </div>
                    <div class="faq-answer">
                        <p>Vous pouvez modifier ou annuler votre commande dans un délai de 1 heure après la passation en nous contactant par email à contact@roseetbouchon.com. Passé ce délai, la commande sera en préparation et ne pourra plus être modifiée. Pour les annulations, le remboursement sera effectué sous 3 à 5 jours ouvrés.</p>
                    </div>
                </div>
            </div>
            
            <div class="faq-category">
                <h2>Paiements & Sécurité</h2>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Quels modes de paiement acceptez-vous ?</h3>
                        <div class="icon"></div>
                    </div>
                    <div class="faq-answer">
                        <p>Nous acceptons les paiements par carte bancaire (Visa, Mastercard, CB) via notre plateforme sécurisée CMI, PayPal, ainsi que le paiement à la livraison (uniquement en France métropolitaine). Toutes les transactions sont cryptées et sécurisées pour garantir la protection de vos données.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Est-ce que mes informations de paiement sont sécurisées ?</h3>
                        <div class="icon"></div>
                    </div>
                    <div class="faq-answer">
                        <p>Absolument. Nous utilisons la technologie de cryptage SSL et ne stockons jamais vos informations de paiement sur nos serveurs. Les transactions sont traitées directement par notre partenaire de paiement certifié PCI-DSS, garantissant le plus haut niveau de sécurité pour vos achats en ligne.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Proposez-vous des options de paiement en plusieurs fois ?</h3>
                        <div class="icon"></div>
                    </div>
                    <div class="faq-answer">
                        <p>Oui, nous proposons le paiement en 3 ou 4 fois sans frais via notre partenaire CMI pour les commandes supérieures à 150 Dhs. Cette option est disponible au moment du paiement pour les cartes bancaires françaises. Le premier prélèvement est effectué au moment de la commande, les suivants à 30 et 60 jours (pour 3 fois) ou 30, 60 et 90 jours (pour 4 fois).</p>
                    </div>
                </div>
            </div>
            
            <div class="faq-category">
                <h2>Produits & Garanties</h2>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Quelle est votre politique de retour ?</h3>
                        <div class="icon"></div>
                    </div>
                    <div class="faq-answer">
                        <p>Nous acceptons les retours sous 14 jours suivant la réception de votre commande. Les articles doivent être dans leur état d'origine, non utilisés et dans leur emballage d'origine. Pour initier un retour, veuillez nous contacter à returns@roseetbouchon.com. Les frais de retour sont à votre charge, sauf en cas d'erreur de notre part ou d'article défectueux.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Quelle garantie offrez-vous sur vos produits ?</h3>
                        <div class="faq-answer">
                        <p>Tous nos produits bénéficient d'une garantie constructeur minimale de 2 ans. Pour les accessoires électriques (comme les thermomètres à vin), la garantie est de 2 ans. Les produits en bois (comme les présentoirs à bouteilles) sont garantis 5 ans contre tout défaut de fabrication. En cas de problème, contactez-nous à garantie@roseetbouchon.com avec votre numéro de commande et des photos du produit.</p>
                    </div>
                </div>
                
                <div class="faq-item">
                    <div class="faq-question">
                        <h3>Proposez-vous des conseils pour l'entretien des produits ?</h3>
                        <div class="icon"></div>
                    </div>
                    <div class="faq-answer">
                        <p>Oui, chaque produit est livré avec une notice d'entretien. Nous proposons également des guides détaillés sur notre blog. Pour les accessoires en bois, nous recommandons un nettoyage à sec avec un chiffon doux et l'application occasionnelle d'huile pour bois (une fois par an). Les accessoires en métal doivent être essuyés après chaque utilisation pour préserver leur éclat.</p>
                    </div>
                </div>
            </div>
            
            <div class="contact-prompt">
                <h3>Vous ne trouvez pas réponse à votre question ?</h3>
                <p>Notre équipe clientèle est à votre disposition pour tout renseignement complémentaire.</p>
                <a href="contact.html" class="btn">Nous contacter</a>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const questions = document.querySelectorAll('.faq-question');
            
            questions.forEach(question => {
                question.addEventListener('click', () => {
                    const answer = question.nextElementSibling;
                    const isActive = question.classList.contains('active');
                    
                    // Close all other open answers
                    document.querySelectorAll('.faq-question.active').forEach(activeQuestion => {
                        if (activeQuestion !== question) {
                            activeQuestion.classList.remove('active');
                            activeQuestion.nextElementSibling.classList.remove('active');
                        }
                    });
                    
                    // Toggle current question
                    question.classList.toggle('active');
                    answer.classList.toggle('active');
                });
            });
        });
    </script>
</body>
</html>