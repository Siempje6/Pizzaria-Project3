<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MakePizzaController;
use App\Http\Controllers\MakeIngredientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CheckoutController;

// Zorg ervoor dat authenticatie-routes zijn geregistreerd (bijvoorbeeld via Laravel Breeze of Laravel UI).
require __DIR__.'/auth.php';

// Dashboard route voor ingelogde gebruikers
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profielbeheer
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Winkelwagen routes
    Route::get('/winkelwagen', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::post('/winkelwagen/toevoegen', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/winkelwagen/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/winkelwagen/verwijderen', [CartController::class, 'removeFromCart'])->name('cart.remove');

    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
});

// Routes voor superadmins
Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('admin', AdminController::class)->only(['show', 'edit', 'update', 'create', 'store', 'destroy']);
});

// Routes voor admins en superadmins
Route::middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::resource('pizzamedewerker', MakePizzaController::class)->only(['show', 'edit', 'update', 'create', 'store', 'destroy']);
    Route::resource('ingredienten', MakeIngredientController::class)->only(['show', 'edit', 'update', 'create', 'store', 'destroy']);
});

// Publieke routes
Route::resource('/', PizzaController::class)->only(['index', 'show']);
Route::resource('pizzas', PizzaController::class)->only(['index', 'show']);
Route::resource('pizzamedewerker', MakePizzaController::class)->only(['index']);
Route::resource('ingredienten', MakeIngredientController::class)->only(['index']);
Route::resource('admin', AdminController::class)->only(['index']);

// Testroute voor winkelwagen (voor ontwikkelingsdoeleinden)
Route::get('/test-cart', function () {
    $pizza = (object) ['id' => 1, 'naam' => 'Margherita', 'prijs' => 7.50];
    $cart = [
        ['pizza' => $pizza, 'quantity' => 2],
    ];

    session()->put('cart', $cart);
    return redirect()->route('cart.view');
});

Route::get('/', function () {
    return view('index');  // Dit kan de view zijn die je wilt tonen bij het bezoeken van de homepagina
})->name('home');
