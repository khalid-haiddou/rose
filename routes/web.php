<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommandeController;
Route::get('/', function () {
    return view('index');
});

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

//dashboard
Route::get('/dashboard/categories', [CategoryController::class, 'index'])->name('categories.index');

Route::get('/dashboard/produits', [ProductController::class, 'index'])->name('products.index');
Route::post('produits', [ProductController::class, 'store'])->name('products.store');
Route::get('/dashboard/produits/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/dashboard/produits/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/dashboard/produits/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

//pages for the commande routes
Route::get('/boutique', [ProductController::class, 'shop'])->name('shop');
Route::get('/produits/{product:slug}', [ProductController::class, 'show'])->name('products.show');
Route::post('/produits/{product}/avis', [ReviewController::class, 'store'])->name('reviews.store');

//cart routes
Route::post('/panier/ajouter/{product}', [CartController::class, 'add'])->name('cart.add');
Route::get('/panier', [CartController::class, 'index'])->name('cart.index');
Route::post('/panier/mettre-a-jour/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('/panier/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/ajax-update/{id}', [CartController::class, 'ajaxUpdate'])->name('cart.ajax.update');

//checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
Route::get('/checkout', [CheckoutController::class, 'show'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::view('/merci', 'merci')->name('merci');

//admin commandes route 
Route::get('/dashboard/commandes', [CommandeController::class, 'index'])->name('dashboard.commandes');
Route::put('/dashboard/commandes/{id}', [CommandeController::class, 'update'])->name('dashboard.commandes.update');
