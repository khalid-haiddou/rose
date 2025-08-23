<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    CategoryController,
    ProductController,
    ReviewController,
    CartController,
    CheckoutController,
    CommandeController,
    StockController,
    DeliveryController,
    AccountController,
    StatistiqueController,
    MarketingController,
    ForgotPasswordController,
    ContactController,
    EventController,
    HomeController
};
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/a-propos', fn() => view('about'))->name('about');
Route::get('/plan-site', fn() => view('plan-site'))->name('plan-site');
Route::get('/cgv', fn() => view('cgv'))->name('cgv');
Route::get('/blog', fn() => view('blog'))->name('blog');
Route::get('/blog/single-article', fn() => view('blogs.single-article'))->name('blog.single-article');
Route::get('/mention-legale', fn() => view('mention-legale'))->name('mention-legale');
Route::get('/faq', fn() => view('faq'))->name('faq');

/*
|--------------------------------------------------------------------------
| Auth Routes
|--------------------------------------------------------------------------
*/
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', function () {
    auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');

/*
|--------------------------------------------------------------------------
| Password Reset
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/forgot-password', [ForgotPasswordController::class, 'showRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLink'])->name('password.email');
    Route::get('/reset-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [ForgotPasswordController::class, 'reset'])->name('password.update');
});

/*
|--------------------------------------------------------------------------
| Product Pages (Shop)
|--------------------------------------------------------------------------
*/
Route::get('/boutique', [ProductController::class, 'shop'])->name('shop');
Route::get('/produits/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/search-products', [ProductController::class, 'ajaxSearch'])->name('products.ajaxSearch');
Route::post('/produits/{product}/avis', [ReviewController::class, 'store'])->name('reviews.store');

/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
*/
Route::prefix('panier')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/ajouter/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/mettre-a-jour/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/ajax-update/{id}', [CartController::class, 'ajaxUpdate'])->name('cart.ajax.update');
});

/*
|--------------------------------------------------------------------------
| Checkout
|--------------------------------------------------------------------------
*/
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::view('/merci', 'merci')->name('merci');

/*
|--------------------------------------------------------------------------
| Authenticated User Account
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/mon-compte', [AccountController::class, 'index'])->name('account');
    Route::get('/mon-compte/fidelisation', [AccountController::class, 'fidelisation'])->name('account.fidelisation');
    Route::get('/mon-compte/commandes', [AccountController::class, 'mesCommandes'])->name('account.commandes.index');
    Route::get('/mon-compte/commandes/{id}', [AccountController::class, 'showCommande'])->name('account.commandes.show');
});

/*
|--------------------------------------------------------------------------
| Contact Form (Public)
|--------------------------------------------------------------------------
*/
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

/*
|--------------------------------------------------------------------------
| Event Participation (Public)
|--------------------------------------------------------------------------
*/
Route::get('/evenements', [EventController::class, 'showForm'])->name('events.form');
Route::post('/evenements', [EventController::class, 'store'])->name('events.submit');

/*
|--------------------------------------------------------------------------
| Dashboard/Admin Area
|--------------------------------------------------------------------------
*/
Route::prefix('dashboard')->middleware(['auth', AdminMiddleware::class])->group(function () {
    Route::get('/', [CommandeController::class, 'dashboard'])->name('dashboard');

    // Commandes
    Route::get('/commandes', [CommandeController::class, 'index'])->name('dashboard.commandes');
    Route::put('/commandes/{id}', [CommandeController::class, 'update'])->name('dashboard.commandes.update');
    Route::delete('/commandes/{id}', [CommandeController::class, 'destroy'])->name('dashboard.commandes.destroy');

    // Produits
    Route::get('/produits', [ProductController::class, 'index'])->name('products.index');
    Route::post('/produits', [ProductController::class, 'store'])->name('products.store');
    Route::get('/produits/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/produits/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/produits/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Catégories
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

    // Marketing
    Route::get('/marketing', [MarketingController::class, 'index'])->name('marketing.index');
    Route::post('/marketing/send', [MarketingController::class, 'send'])->name('marketing.send');

    // Statistiques
    Route::get('/statistique', [StatistiqueController::class, 'index'])->name('dashboard.stats');

    // Stock
    Route::get('/stock', [StockController::class, 'index'])->name('stock.index');
    Route::put('/stock/{id}', [StockController::class, 'update'])->name('stock.update');

    // Livraison
    Route::get('/livraisons', [DeliveryController::class, 'index'])->name('livraisons.index');
    Route::put('/livraison/{commande}/update-delivery-number', [DeliveryController::class, 'updateDeliveryNumber'])->name('livraison.updateDeliveryNumber');

    // Contacts
    Route::get('/contacts', [ContactController::class, 'index'])->name('dashboard.contacts');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('dashboard.contacts.destroy');
    Route::patch('/contacts/{id}/status', [ContactController::class, 'updateStatus'])->name('dashboard.contacts.updateStatus');

    // Events
    Route::get('/events', [EventController::class, 'index'])->name('dashboard.events');
    Route::patch('/events/{id}/status', [EventController::class, 'updateStatus'])->name('dashboard.events.updateStatus');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('dashboard.events.destroy');
});

/*
|--------------------------------------------------------------------------
| Sitemap (Optional)
|--------------------------------------------------------------------------
*/
Route::get('/sitemap-generate', function () {
    Sitemap::create()
        ->add(Url::create('/'))
        ->add(Url::create('/about'))
        ->add(Url::create('/contact'))
        ->writeToFile(public_path('sitemap.xml'));

    return 'Sitemap généré avec succès';
});


//  --------------------- payment cmi -----------
Route::post('/api/payment/cmi/callback', [CMIPaymentController::class, 'callback'])
    ->name('payment.cmi.callback')
    ->withoutMiddleware([VerifyCsrfToken::class]);

// Payment result pages
Route::post('/payment/success', [CMIPaymentController::class, 'paymentSuccess'])
    ->name('payment.success')
    ->withoutMiddleware([VerifyCsrfToken::class]);
Route::post('/payment/failure', [CMIPaymentController::class, 'paymentFailure'])
    ->name('payment.failure')
    ->withoutMiddleware([VerifyCsrfToken::class]);