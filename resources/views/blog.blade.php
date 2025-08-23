<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catégories - Blog Rose & Bouchon</title>
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
</head>
<body>
        @include('layouts.header') 

    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="wine-loader">
            <div class="tasting-glass">
                <div class="liquid"></div>
            </div>
            <p class="loading-text">Chargement en cours...</p>
        </div>
    </div>

 <header class="category-header">
        <div class="category-header-content">
            <h1 class="category-title">Nos Blog</h1>
            <p>Explorez nos conseils par catégorie</p>
        </div>
    </header>

    <nav class="category-nav">
        <div class="category-container">
            <div class="category-tabs">
                <a href="#" class="category-tab active" data-category="all">Tous les articles</a>
                <a href="#" class="category-tab" data-category="conservation">Conservation</a>
                <a href="#" class="category-tab" data-category="degustation">Dégustation</a>
                <a href="#" class="category-tab" data-category="accessoires">Accessoires</a>
                <a href="#" class="category-tab" data-category="savoir-faire">Savoir-faire</a>
                <a href="#" class="category-tab" data-category="nouveautes">Nouveautés</a>
            </div>
        </div>
    </nav>

    <div class="articles-container">
        <div class="articles-grid" id="articlesGrid">
            <!-- Articles will be loaded here dynamically -->
        </div>

        <!-- Pagination -->
        <div class="pagination">
            <ul class="pagination-list" id="paginationList">
                <!-- Pagination will be generated here -->
            </ul>
        </div>
    </div>

    <script src="{{ asset('assets/js/blog.js') }}"></script>
            @include('layouts.footer') 

</body>
</html>