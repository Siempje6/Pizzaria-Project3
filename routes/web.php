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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// alle ingelogde gebruikers, ongeacht rol
Route::middleware('auth', 'role:admin|superadmin')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/winkelwagen', [PizzaController::class, 'index'])->name('PizzaBestel.Winkelwagen');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('/winkelwagen', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/winkelwagen/toevoegen', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/winkelwagen/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/winkelwagen/verwijderen', [CartController::class, 'removeFromCart'])->name('cart.remove');
});

// alle superadmin urls
Route::middleware('role:superadmin')->group(function () {
    Route::resource('admin', AdminController::class)->only(['show', 'edit', 'update', 'create', 'store', 'destroy']);
});


// alle admin rollen
Route::middleware('role:admin|superadmin')->group(function () {
    Route::resource('pizzamedewerker', MakePizzaController::class)->only(['show', 'edit', 'update', 'create', 'store', 'destroy']);
    Route::resource('ingredienten', MakeIngredientController::class)->only(['show', 'edit', 'update', 'create', 'store', 'destroy']);
});

// voor gasten en rest
Route::resource('/' , PizzaController::class)->only(['index', 'show']);
Route::resource('pizzas', PizzaController::class)->only(['index', 'show']);
Route::resource('pizzamedewerker', MakePizzaController::class)->only(['index']);
Route::resource('ingredienten', MakeIngredientController::class)->only(['index']);
Route::resource('admin', AdminController::class)->only(['index']);


Route::get('/test-cart', function () {
    $pizza = (object) ['id' => 1, 'naam' => 'Margherita', 'prijs' => 7.50];
    $cart = [
        ['pizza' => $pizza, 'quantity' => 2],
    ];

    session()->put('cart', $cart);
    return redirect()->route('cart.view');
});

Route::resource('pizzas', PizzaController::class);


Route::middleware(['auth'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::middleware('auth')->group(function() {
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
});
