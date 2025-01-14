<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return view('pizzas.index');
});

// In web.php
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/', [PizzaController::class, 'index'])->name('pizzas.index');
Route::get('/winkelwagen', [PizzaController::class, 'index'])->name('PizzaBestel.Winkelwagen');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
require __DIR__.'/auth.php';

Route::get('/', [PizzaController::class, 'index'])->name('pizzas.index');

Route::get('/winkelwagen', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/winkelwagen/toevoegen', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/winkelwagen/update', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('/winkelwagen/verwijderen', [CartController::class, 'removeFromCart'])->name('cart.remove');



Route::get('/test-cart', function () {
    $pizza = (object) ['id' => 1, 'naam' => 'Margherita', 'prijs' => 7.50];
    $cart = [
        ['pizza' => $pizza, 'quantity' => 2],
    ];

    session()->put('cart', $cart);
    return redirect()->route('cart.view');
});

Route::resource('pizzas', PizzaController::class);

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckoutController;

Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Voeg deze regel toe aan je web.php bestand
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

use App\Http\Controllers\OrderController;

Route::get('/checkout', [OrderController::class, 'showCheckout'])->name('checkout')->middleware('auth');

Route::post('/checkout', [OrderController::class, 'processCheckout'])->name('checkout.process')->middleware('auth');

Route::get('/order/complete', function () {
    return view('order.complete');
})->name('order.complete');