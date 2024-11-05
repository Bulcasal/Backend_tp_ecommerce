<?php

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware('api')->get('/test', function () {
   return response()->json(['message' => 'API is working!']);
});

// Routes pour les produits
Route::group(['prefix' => 'admin', 'middleware' => ['api']], function () {
   Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
   Route::post('/products', [ProductController::class, 'store'])->name('admin.products.store');
   Route::get('/products/{product}', [ProductController::class, 'show'])->name('admin.products.show');
   Route::put('/products/{product}', [ProductController::class, 'update'])->name('admin.products.update');
   Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
});

// Routes pour le panier
Route::group(['prefix' => 'cart', 'middleware' => ['api']], function () {
   Route::get('/products', [CartController::class, 'listProducts'])->name('cart.listProducts');
   Route::get('/', [CartController::class, 'index'])->name('cart.index');
   Route::post('/', [CartController::class, 'store'])->name('cart.store');
   Route::put('/{productId}', [CartController::class, 'update'])->name('cart.update');
   Route::delete('/{productId}', [CartController::class, 'deleteProduct'])->name('cart.deleteProduct');
   Route::delete('/', [CartController::class, 'clearCart'])->name('cart.clear');
});