<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Rose & Bouchon</title>
    <link rel="stylesheet" href="{{ asset('assets/css/faq.css') }}">
</head>
<body>
        @include('layouts.header') 

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

        @include('layouts.footer') 

</body>
</html>