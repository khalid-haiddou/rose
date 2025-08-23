        document.addEventListener('DOMContentLoaded', function() {
            // Sample data - in a real app, this would come from an API
            const allArticles = [

                {
                    id: 1,
                    title: "Notre sélection de tire-bouchons design",
                    excerpt: "Alliant esthétique et fonctionnalité, ces pièces d'exception sublimeront vos moments de dégustation.",
                    category: "accessoires",
                    date: "5 février 2023",
                    image: "https://images.unsplash.com/photo-1608270586620-248524c67de9?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                },
                {
                    id: 2,
                    title: "Les innovations 2023 en matière de conservation",
                    excerpt: "Découvrez les dernières technologies pour préserver vos vins dans des conditions optimales.",
                    category: "nouveautes",
                    date: "22 janvier 2023",
                    image: "https://images.unsplash.com/photo-1600788886242-5c96aabe3757?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                },
                {
                    id: 3,
                    title: "Température idéale pour chaque type de vin",
                    excerpt: "Guide complet pour servir vos vins à la température parfaite et en révéler tous les arômes.",
                    category: "savoir-faire",
                    date: "18 janvier 2023",
                    image: "https://images.unsplash.com/photo-1563227812-0ea4c22e6cc8?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                },
                {
                    id: 4,
                    title: "Comment aménager sa cave à vin à la maison",
                    excerpt: "Découvrez nos conseils pour créer un espace de conservation optimal pour vos précieux flacons, même dans un petit espace.",
                    category: "conservation",
                    date: "15 mars 2023",
                    image: "https://images.unsplash.com/photo-1558160074-4d7d8bdf4256?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                },
                {
                    id: 5,
                    title: "Les 5 accessoires indispensables pour une dégustation parfaite",
                    excerpt: "Notre sélection d'objets qui feront de chaque dégustation un moment d'exception.",
                    category: "degustation",
                    date: "28 février 2023",
                    image: "https://images.unsplash.com/photo-1568219656418-15c329312bf1?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                },
                {
                    id: 6,
                    title: "L'art français de servir le vin : les règles d'or",
                    excerpt: "Température, verrerie, ordre de service... Maîtrisez les codes de l'art de la table à la française.",
                    category: "savoir-faire",
                    date: "10 février 2023",
                    image: "https://images.unsplash.com/photo-1606787366850-de6330128bfc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                },
                
                {
                    id: 7,
                    title: "Nos caves à vin préférées pour 2023",
                    excerpt: "Sélection des meilleures caves à vin pour tous les budgets et espaces disponibles.",
                    category: "conservation",
                    date: "12 janvier 2023",
                    image: "https://images.unsplash.com/photo-1561361513-2d000a50f0dc?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                },
                {
                    id: 8,
                    title: "Comment organiser une dégustation à l'aveugle",
                    excerpt: "Tous nos conseils pour réussir une dégustation à l'aveugle entre amis ou en famille.",
                    category: "degustation",
                    date: "5 janvier 2023",
                    image: "https://images.unsplash.com/photo-1470337458703-46ad1756a187?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                },
                {
                    id: 9,
                    title: "Les essentiels pour une cave à vin parfaite",
                    excerpt: "Les accessoires indispensables pour optimiser la conservation de vos bouteilles.",
                    category: "accessoires",
                    date: "28 décembre 2022",
                    image: "https://images.unsplash.com/photo-1571115764595-644a1f56a55c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80"
                }
            ];

            // DOM Elements
            const tabs = document.querySelectorAll('.category-tab');
            const articlesGrid = document.getElementById('articlesGrid');
            const paginationList = document.getElementById('paginationList');
            const loadingOverlay = document.getElementById('loadingOverlay');
            
            // Configuration
            const articlesPerPage = 6;
            let currentPage = 1;
            let currentCategory = 'all';
            let filteredArticles = [...allArticles];

            // Initialize
            function init() {
                renderArticles();
                renderPagination();
                setupEventListeners();
            }

            // Render articles based on current filters
            function renderArticles() {
                showLoading();
                
                // Simulate API delay
                setTimeout(() => {
                    const startIndex = (currentPage - 1) * articlesPerPage;
                    const endIndex = startIndex + articlesPerPage;
                    const articlesToShow = filteredArticles.slice(startIndex, endIndex);
                    
                    articlesGrid.innerHTML = '';
                    
                    if (articlesToShow.length === 0) {
                        articlesGrid.innerHTML = `
                            <div class="no-results">
                                <div class="no-results-icon">🍷</div>
                                <h3>Aucun article dans cette catégorie</h3>
                                <p>Revenez bientôt pour découvrir nos prochains conseils</p>
                            </div>
                        `;
                    } else {
                        articlesToShow.forEach((article, index) => {
                            const articleEl = document.createElement('article');
                            articleEl.className = 'article-card';
                            articleEl.style.animationDelay = `${index * 0.1}s`;
                            articleEl.innerHTML = `
                                <div class="article-image" style="background-image: url('${article.image}')">
                                    <span class="article-category">${formatCategory(article.category)}</span>
                                </div>
                                <div class="article-content">
                                    <div class="article-date">${article.date}</div>
                                    <h2 class="article-title">${article.title}</h2>
                                    <p class="article-excerpt">${article.excerpt}</p>
                                    <a href="#" class="read-more">Lire l'article</a>
                                </div>
                            `;
                            articlesGrid.appendChild(articleEl);
                        });
                    }
                    
                    hideLoading();
                }, 500);
            }

            // Render pagination controls
            function renderPagination() {
                const totalPages = Math.ceil(filteredArticles.length / articlesPerPage);
                
                paginationList.innerHTML = '';
                
                // Previous button
                const prevLi = document.createElement('li');
                prevLi.className = 'pagination-item';
                prevLi.innerHTML = `
                    <a href="#" class="pagination-link ${currentPage === 1 ? 'disabled' : ''}" data-page="${currentPage - 1}">
                        &laquo;
                    </a>
                `;
                paginationList.appendChild(prevLi);
                
                // Page numbers
                const maxVisiblePages = 5;
                let startPage = Math.max(1, currentPage - Math.floor(maxVisiblePages / 2));
                let endPage = Math.min(totalPages, startPage + maxVisiblePages - 1);
                
                if (endPage - startPage + 1 < maxVisiblePages) {
                    startPage = Math.max(1, endPage - maxVisiblePages + 1);
                }
                
                if (startPage > 1) {
                    const firstLi = document.createElement('li');
                    firstLi.className = 'pagination-item';
                    firstLi.innerHTML = `
                        <a href="#" class="pagination-link" data-page="1">1</a>
                    `;
                    paginationList.appendChild(firstLi);
                    
                    if (startPage > 2) {
                        const ellipsisLi = document.createElement('li');
                        ellipsisLi.className = 'pagination-item';
                        ellipsisLi.innerHTML = '<span class="pagination-ellipsis">...</span>';
                        paginationList.appendChild(ellipsisLi);
                    }
                }
                
                for (let i = startPage; i <= endPage; i++) {
                    const pageLi = document.createElement('li');
                    pageLi.className = 'pagination-item';
                    pageLi.innerHTML = `
                        <a href="#" class="pagination-link ${i === currentPage ? 'active' : ''}" data-page="${i}">
                            ${i}
                        </a>
                    `;
                    paginationList.appendChild(pageLi);
                }
                
                if (endPage < totalPages) {
                    if (endPage < totalPages - 1) {
                        const ellipsisLi = document.createElement('li');
                        ellipsisLi.className = 'pagination-item';
                        ellipsisLi.innerHTML = '<span class="pagination-ellipsis">...</span>';
                        paginationList.appendChild(ellipsisLi);
                    }
                    
                    const lastLi = document.createElement('li');
                    lastLi.className = 'pagination-item';
                    lastLi.innerHTML = `
                        <a href="#" class="pagination-link" data-page="${totalPages}">
                            ${totalPages}
                        </a>
                    `;
                    paginationList.appendChild(lastLi);
                }
                
                // Next button
                const nextLi = document.createElement('li');
                nextLi.className = 'pagination-item';
                nextLi.innerHTML = `
                    <a href="#" class="pagination-link ${currentPage === totalPages ? 'disabled' : ''}" data-page="${currentPage + 1}">
                        &raquo;
                    </a>
                `;
                paginationList.appendChild(nextLi);
            }

            // Set up event listeners
            function setupEventListeners() {
                // Category tabs
                tabs.forEach(tab => {
                    tab.addEventListener('click', function(e) {
                        e.preventDefault();
                        
                        if (this.classList.contains('active')) return;
                        
                        tabs.forEach(t => t.classList.remove('active'));
                        this.classList.add('active');
                        
                        currentCategory = this.dataset.category;
                        currentPage = 1;
                        
                        // Filter articles
                        if (currentCategory === 'all') {
                            filteredArticles = [...allArticles];
                        } else {
                            filteredArticles = allArticles.filter(article => article.category === currentCategory);
                        }
                        
                        renderArticles();
                        renderPagination();
                    });
                });
                
                // Pagination
                paginationList.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    if (e.target.classList.contains('pagination-link') && !e.target.classList.contains('disabled') && !e.target.classList.contains('active')) {
                        const page = parseInt(e.target.dataset.page);
                        if (!isNaN(page)) {
                            currentPage = page;
                            renderArticles();
                            renderPagination();
                            window.scrollTo({ top: articlesGrid.offsetTop - 100, behavior: 'smooth' });
                        }
                    }
                });
            }

            // Helper functions
            function formatCategory(category) {
                const categories = {
                    'conservation': 'Conservation',
                    'degustation': 'Dégustation',
                    'accessoires': 'Accessoires',
                    'savoir-faire': 'Savoir-faire',
                    'nouveautes': 'Nouveautés'
                };
                return categories[category] || category;
            }

            function showLoading() {
                loadingOverlay.classList.add('active');
            }

            function hideLoading() {
                loadingOverlay.classList.remove('active');
            }

            // Initialize the app
            init();
        });
