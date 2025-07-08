<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Cave & Cellier</title>
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
        
        .register-container {
            width: 100%;
            max-width: 480px;
            background-color: var(--ivory);
            padding: 2rem 1.75rem;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            border-top: 4px solid var(--navy);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(0, 0, 117, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .register-container:hover {
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        }
        
        .register-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(90deg, var(--burgundy), var(--navy));
            z-index: 2;
        }
        
        .register-container::after {
            content: '🍾';
            position: absolute;
            bottom: -30px;
            right: -30px;
            font-size: 180px;
            opacity: 0.03;
            z-index: 0;
            transform: rotate(-15deg);
        }
        
        .logo {
            text-align: center;
            margin-bottom: 2rem;
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
        
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
            z-index: 1;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--dark);
            font-size: 0.95rem;
            font-weight: 500;
        }
        
        .form-group input {
            width: 100%;
            padding: 14px 16px;
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
        
        .name-fields {
            display: flex;
            gap: 1rem;
        }
        
        .name-fields .form-group {
            flex: 1;
            margin-bottom: 1rem;
        }
        
        .btn {
            width: 100%;
            padding: 16px;
            background-color: var(--navy);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.05rem;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            letter-spacing: 0.5px;
            font-weight: 500;
            font-family: 'Cormorant Garamond', serif;
            position: relative;
            overflow: hidden;
            z-index: 1;
            margin-top: 0.5rem;
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
            background-color: #00005c;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 117, 0.2);
        }
        
        .btn:active {
            transform: translateY(0);
        }
        
        .links {
            margin-top: 1.5rem;
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
            background-color: var(--gold);
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
        
        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: var(--dark);
            font-size: 0.85rem;
            opacity: 0.7;
            position: relative;
            z-index: 1;
        }
        
        .divider::before, .divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid rgba(0, 0, 117, 0.1);
        }
        
        .divider::before {
            margin-right: 1.5rem;
        }
        
        .divider::after {
            margin-left: 1.5rem;
        }
        
        /* Mobile-specific enhancements */
        @media (max-width: 480px) {
            body {
                padding: 15px;
                background-image: linear-gradient(rgba(254, 254, 250, 0.96), rgba(254, 254, 250, 0.98)), 
                                  url('https://images.unsplash.com/photo-1510812431401-41e2f9c2c0b4?q=80&w=1200');
            }
            
            .register-container {
                padding: 1.75rem 1.25rem;
                border-radius: 10px;
                max-width: 100%;
            }
            
            .logo h1 {
                font-size: 1.8rem;
            }
            
            .form-group input {
                padding: 13px 15px;
            }
            
            .btn {
                padding: 15px;
            }
            
            .register-container::after {
                font-size: 140px;
                bottom: -20px;
                right: -20px;
            }
            
            .name-fields {
                flex-direction: column;
                gap: 0;
            }
            
            .name-fields .form-group {
                margin-bottom: 1.5rem;
            }
        }
        
        /* Animation for subtle interactivity */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .register-container {
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .form-group, .btn, .links, .divider {
            opacity: 0;
            animation: fadeIn 0.6s ease-out forwards;
        }
        
        .form-group { animation-delay: 0.1s; }
        .btn { animation-delay: 0.2s; }
        .links { animation-delay: 0.3s; }
        .divider { animation-delay: 0.4s; }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="register-container">
        <div class="logo">
            <h1>Rose & Bouchon</h1>
            <p>Rejoignez notre communauté œnophile</p>
        </div>
        
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="name-fields">
                <div class="form-group">
                    <label for="firstname">Prénom</label>
                    <input type="text" name="prenom" id="firstname" placeholder="Votre prénom" value="{{ old('prenom') }}" required>
                </div>

                <div class="form-group">
                    <label for="lastname">Nom</label>
                    <input type="text" name="nom" id="lastname" placeholder="Votre nom" value="{{ old('nom') }}" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" placeholder="votre@email.com" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="••••••••" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="confirm-password" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn">S'inscrire</button>

            <div class="divider">Déjà membre ?</div>
            <div class="links">
                <a href="/login">Se connecter</a>
                <a href="/reset-password">Mot de passe oublié ?</a>
            </div>
        </form>
    </div>
</body>
</html>