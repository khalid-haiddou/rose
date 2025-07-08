<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récupération de mot de passe - Cave & Cellier</title>
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
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-image: linear-gradient(rgba(254, 254, 250, 0.92), rgba(254, 254, 250, 0.94)), 
                              url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=2000');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            padding: 20px;
        }
        
        .recovery-container {
            width: 100%;
            max-width: 440px;
            background-color: var(--ivory);
            padding: 2.5rem 2rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--gold);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(196, 162, 103, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            text-align: center;
        }
        
        .recovery-container:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }
        
        .recovery-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--burgundy), var(--gold));
            z-index: 2;
        }
        
        .recovery-container::after {
            content: '🔑';
            position: absolute;
            bottom: -30px;
            right: -30px;
            font-size: 160px;
            opacity: 0.04;
            z-index: 0;
            transform: rotate(10deg);
        }
        
        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }
        
        .logo h1 {
            color: var(--navy);
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 2rem;
            margin-bottom: 0.25rem;
            font-variant: small-caps;
        }
        
        .logo p {
            color: var(--burgundy);
            font-style: italic;
            margin-top: 0;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }
        
        .instructions {
            color: var(--dark);
            margin-bottom: 2rem;
            line-height: 1.6;
            font-size: 1rem;
            opacity: 0.9;
        }
        
        .form-group {
            margin-bottom: 2rem;
            position: relative;
            z-index: 1;
            text-align: left;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.75rem;
            color: var(--dark);
            font-size: 0.95rem;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 15px 18px;
            border: 1px solid rgba(0, 0, 117, 0.15);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            background-color: rgba(255, 255, 255, 0.7);
            font-family: 'Cormorant Garamond', serif;
        }
        
        .form-group input:focus {
            border-color: var(--navy);
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 0, 117, 0.1);
            background-color: white;
        }
        
        .form-group input::placeholder {
            color: rgba(18, 18, 18, 0.4);
            font-style: italic;
        }
        
        .btn {
            width: 100%;
            padding: 16px;
            background-color: var(--gold);
            color: var(--dark);
            border: none;
            border-radius: 8px;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            letter-spacing: 0.5px;
            font-weight: 600;
            font-family: 'Cormorant Garamond', serif;
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
            background: linear-gradient(rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.1));
            z-index: -1;
        }
        
        .btn:hover {
            background-color: #b08c55;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(196, 162, 103, 0.3);
            color: white;
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .links {
            margin-top: 2rem;
            text-align: center;
            font-size: 0.95rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }
        
        .links a {
            color: var(--navy);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            display: inline-block;
            padding: 0 5px;
        }
        
        .links a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 5px;
            width: calc(100% - 10px);
            height: 1px;
            background-color: var(--burgundy);
            transform: scaleX(0);
            transform-origin: right;
            transition: transform 0.3s ease;
        }
        
        .links a:hover {
            color: var(--burgundy);
        }
        
        .links a:hover::after {
            transform: scaleX(1);
            transform-origin: left;
        }
        
        .success-message {
            display: none;
            color: var(--navy);
            background-color: rgba(196, 162, 103, 0.1);
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            border-left: 4px solid var(--gold);
            text-align: left;
        }
        
        /* Mobile-specific enhancements */
        @media (max-width: 480px) {
            body {
                padding: 15px;
                background-image: linear-gradient(rgba(254, 254, 250, 0.96), rgba(254, 254, 250, 0.98)), 
                                  url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=1200');
            }
            
            .recovery-container {
                padding: 2rem 1.5rem;
                border-radius: 10px;
            }
            
            .logo h1 {
                font-size: 1.8rem;
            }
            
            .form-group input {
                padding: 14px 16px;
            }
            
            .btn {
                padding: 15px;
            }
            
            .recovery-container::after {
                font-size: 120px;
                bottom: -20px;
                right: -20px;
            }
            
            .instructions {
                font-size: 0.95rem;
                margin-bottom: 1.75rem;
            }
        }
        
        /* Animation for subtle interactivity */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .recovery-container {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .instructions, .form-group, .btn, .links {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .instructions { animation-delay: 0.1s; }
        .form-group { animation-delay: 0.2s; }
        .btn { animation-delay: 0.3s; }
        .links { animation-delay: 0.4s; }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="recovery-container">
        <div class="logo">
            <h1>Rose & Bouchon</h1>
            <p>Récupération de votre compte</p>
        </div>
        
        <p class="instructions">Entrez l'adresse email associée à votre compte. Nous vous enverrons un lien pour réinitialiser votre mot de passe.</p>
        
        <div class="success-message">
            <p><strong>Email envoyé !</strong> Vérifiez votre boîte de réception pour le lien de réinitialisation.</p>
        </div>
        
        <form id="recoveryForm">
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" id="email" placeholder="votre@email.com" required>
            </div>
            
            <button type="submit" class="btn">Envoyer le lien de réinitialisation</button>
            
            <div class="links">
                <a href="#">Retour à la page de connexion</a>
                <a href="#">Vous n'avez pas reçu d'email ?</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('recoveryForm').addEventListener('submit', function(e) {
            e.preventDefault();
            document.querySelector('.success-message').style.display = 'block';
            document.getElementById('recoveryForm').reset();
            
            // Scroll to show the success message
            document.querySelector('.success-message').scrollIntoView({ 
                behavior: 'smooth', 
                block: 'center'
            });
        });
    </script>
</body>
</html>