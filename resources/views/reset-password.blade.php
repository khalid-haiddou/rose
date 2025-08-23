<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récupération de mot de passe - Cave & Cellier</title>
    <link rel="stylesheet" href="{{ asset('assets/css/password.css') }}">
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
        
        <form id="recoveryForm" method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" name="email" id="email" placeholder="votre@email.com" required>
            </div>

            <button type="submit" class="btn">Envoyer le lien de réinitialisation</button>

            <div class="links">
                <a href="{{ route('login') }}">Retour à la page de connexion</a>
                <a href="#">Vous n'avez pas reçu d'email ?</a>
            </div>
        </form>
    </div>

    @if(session('success'))
    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const success = document.querySelector('.success-message');
            success.style.display = 'block';
            success.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    </script>
@endif
</body>
</html>