<?php

use Illuminate\Support\Facades\Route;
use Modules\Ecommerce\Http\Controllers\OnlineStoreController;
use Modules\Ecommerce\Http\Controllers\OnlineOrdersController;

/*
|--------------------------------------------------------------------------
| Public Store Routes — subdomain-based (production)
| Pattern: {subdomain}.simplexgestion.tn
|--------------------------------------------------------------------------
*/
Route::domain('{subdomain}.'.config('ecommerce.domain', 'simplexgestion.tn'))
    ->name('ecom.store.')
    ->group(function () {
        Route::get('/', [OnlineStoreController::class, 'index'])->name('index');
        Route::get('/produit/{id}', [OnlineStoreController::class, 'show'])->name('show');
        Route::get('/panier', [OnlineStoreController::class, 'cart'])->name('cart');
        Route::post('/panier/ajouter', [OnlineStoreController::class, 'addToCart'])->name('addToCart');
        Route::post('/panier/supprimer', [OnlineStoreController::class, 'removeFromCart'])->name('removeFromCart');
        Route::post('/panier/update', [OnlineStoreController::class, 'updateCart'])->name('updateCart');
        Route::get('/commande', [OnlineStoreController::class, 'checkout'])->name('checkout');
        Route::post('/commande', [OnlineStoreController::class, 'placeOrder'])->name('placeOrder');
        Route::get('/confirmation/{ref}', [OnlineStoreController::class, 'success'])->name('success');
    });

/*
|--------------------------------------------------------------------------
| Development fallback: path-based (Replit / local dev)
| /ecom-store/{subdomain}/...
|--------------------------------------------------------------------------
*/
Route::prefix('ecom-store/{subdomain}')
    ->name('ecom.dev.')
    ->group(function () {
        Route::get('/', [OnlineStoreController::class, 'index'])->name('index');
        Route::get('/produit/{id}', [OnlineStoreController::class, 'show'])->name('show');
        Route::get('/panier', [OnlineStoreController::class, 'cart'])->name('cart');
        Route::post('/panier/ajouter', [OnlineStoreController::class, 'addToCart'])->name('addToCart');
        Route::post('/panier/supprimer', [OnlineStoreController::class, 'removeFromCart'])->name('removeFromCart');
        Route::post('/panier/update', [OnlineStoreController::class, 'updateCart'])->name('updateCart');
        Route::get('/commande', [OnlineStoreController::class, 'checkout'])->name('checkout');
        Route::post('/commande', [OnlineStoreController::class, 'placeOrder'])->name('placeOrder');
        Route::get('/confirmation/{ref}', [OnlineStoreController::class, 'success'])->name('success');
    });

/*
|--------------------------------------------------------------------------
| Admin — Online Orders (requires auth)
|--------------------------------------------------------------------------
*/
Route::middleware(['web', 'auth', 'SetSessionData', 'language', 'AdminSidebarMenu', 'CheckUserLogin'])
    ->prefix('online-orders')
    ->name('ecom.orders.')
    ->group(function () {
        Route::get('/', [OnlineOrdersController::class, 'index'])->name('index');
        Route::get('/{id}', [OnlineOrdersController::class, 'show'])->name('show');
        Route::post('/{id}/finalize', [OnlineOrdersController::class, 'finalize'])->name('finalize');
    });
