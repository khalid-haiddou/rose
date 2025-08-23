<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements - Rose & Bouchon</title>
    <link rel="stylesheet" href="{{ asset('assets/css/events.css') }}">

  
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="">
</head>
<body>
        @include('layouts.header') 
    <div class="container">
        <header class="events-header">
            <h1>Nos Événements</h1>
            <p>Découvrez nos ateliers et dégustations exclusives autour du vin</p>
        </header>
        
       
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<form class="participation-form" id="register" method="POST" action="{{ route('events.submit') }}">
    @csrf
    <h2>Participer à un événement</h2>
    
    <div class="form-row">
        <div class="form-group">
            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>
        <div class="form-group">
            <label for="lastname">Nom</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>
    </div>
    
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
    </div>
    
    <div class="form-group">
        <label for="phone">Téléphone</label>
        <input type="tel" id="phone" name="phone" required>
    </div>
    
    <div class="form-group">
        <label for="comments">Commentaires (allergies, préférences...)</label>
        <textarea id="comments" name="comments"></textarea>
    </div>
    
    <button type="submit" class="btn submit-btn">Confirmer ma participation</button>
</form>


        <div class="event-container">
            <div class="event-card">
                <img src="{{ asset('assets/images/ameublement.jpg') }}" alt="Ameublement" class="event-image">
                <div class="event-content">
                    <h3 class="event-title">Ameublement </h3>
                    <p class="event-description">Apprenez à déguster comme un sommelier lors de cet atelier interactif. Nous explorerons les arômes, les textures et les accords mets-vins avec une sélection de grands crus.</p>
                </div>
            </div>
            
            <div class="event-card">
                <img src="{{ asset('assets/images/jardin.jpg') }}" alt="Soirée vins rares" class="event-image">
                <div class="event-content">
                    <h3 class="event-title">Jardin</h3>
                    <p class="event-description">Une occasion unique de déguster des vins rares et vieillis provenant de caves privées. Chaque bouteille raconte une histoire que nos experts partageront avec vous.</p>
                </div>
            </div>
        </div>

    </div>
        @include('layouts.footer') 
</body>
</html>