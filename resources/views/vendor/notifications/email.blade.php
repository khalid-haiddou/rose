<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation de mot de passe - Rose & Bouchon</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --navy: #000075;
            --burgundy: #960018;
            --dark: #121212;
            --ivory: #FEFEFA;
            --gold: #C4A267;
        }
        
        body {
            font-family: 'Cormorant Garamond', serif;
            background-color: #f9f9f7;
            color: var(--dark);
            line-height: 1.6;
            margin: 0;
            padding: 0;
        }
        
        .email-container {
            max-width: 580px;
            margin: 40px auto;
            padding: 0;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }
        
        .email-header {
            background: var(--navy);
            padding: 30px 20px;
            text-align: center;
            color: white;
        }
        
        .email-header h1 {
            font-weight: 600;
            font-size: 28px;
            margin: 0;
            letter-spacing: 0.5px;
        }
        
        .email-header p {
            font-style: italic;
            font-size: 16px;
            opacity: 0.9;
            margin-top: 8px;
            color: rgba(255, 255, 255, 0.9);
        }
        
        .email-content {
            padding: 40px;
            text-align: center;
        }
        
        .email-content h2 {
            color: var(--navy);
            font-size: 22px;
            margin-top: 0;
            margin-bottom: 25px;
        }
        
        .email-content p {
            margin-bottom: 25px;
            font-size: 16px;
            color: #444;
        }
        
        .btn-reset {
            display: inline-block;
            padding: 14px 32px;
            background-color: var(--navy);
            color: white;
            text-decoration: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: 500;
            margin: 20px 0;
            transition: all 0.2s ease;
            border: none;
            cursor: pointer;
        }
        
        .btn-reset:hover {
            background-color: #0000a0;
            box-shadow: 0 4px 12px rgba(0, 0, 117, 0.2);
        }
        
        .link-alternative {
            font-size: 14px;
            color: #666;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            word-break: break-all;
        }
        
        .signature {
            margin-top: 30px;
            font-style: italic;
            color: var(--burgundy);
        }
        
        .email-footer {
            background: #f5f5f3;
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #777;
        }
        
        .email-footer a {
            color: var(--burgundy);
            text-decoration: none;
        }
        
        @media (max-width: 600px) {
            .email-container {
                margin: 20px;
                width: auto;
            }
            
            .email-content {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Rose & Bouchon</h1>
            <p>L'élégance de la conservation du vin</p>
        </div>
        
        <div class="email-content">
            <h2>Réinitialisation de mot de passe</h2>
            
            <p>Bonjour,</p>
            
            <p>Vous avez demandé à réinitialiser votre mot de passe. Cliquez sur le bouton ci-dessous pour procéder :</p>
            
            <a href="{{ $actionUrl }}" class="btn-reset">Choisir un nouveau mot de passe</a>
            
            <p class="link-alternative">
                Si vous ne pouvez pas cliquer sur le bouton, copiez ce lien dans votre navigateur :<br>
                <span>{{ $displayableActionUrl }}</span>
            </p>
            
            <p>Ce lien expirera dans 60 minutes.</p>
            
            <p class="signature">L'équipe Rose & Bouchon</p>
        </div>
        
        <div class="email-footer">
            <p>© {{ date('Y') }} Rose & Bouchon. Tous droits réservés.</p>
            <p><a href="{{ url('/') }}">Visiter notre site</a> | <a href="{{ url('/contact') }}">Nous contacter</a></p>
        </div>
    </div>
</body>
</html>