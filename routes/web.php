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
use App\Http\Controllers\BestellingController;

require __DIR__.'/auth.php';

Route::resource('bestellingen', BestellingController::class)->only(['index', 'update']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/winkelwagen', [CartController::class, 'viewCart'])->name('cart.view');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::post('/winkelwagen/toevoegen', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/winkelwagen/update', [CartController::class, 'updateCart'])->name('cart.update');
    Route::post('/winkelwagen/verwijderen', [CartController::class, 'removeFromCart'])->name('cart.remove');
});

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');

    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    
    Route::post('/checkout/customer', [CheckoutController::class, 'createCustomer'])->name('checkout.createCustomer');

    Route::get('/order/confirmation/{orderId}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');

});


Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::resource('admin', AdminController::class)->only(['index', 'show', 'edit', 'update', 'create', 'store', 'destroy']);
});

Route::middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::resource('pizzamedewerker', MakePizzaController::class)->only(['index', 'show', 'edit', 'update', 'create', 'store', 'destroy']);
    Route::resource('ingredienten', MakeIngredientController::class)->only(['index', 'show', 'edit', 'update', 'create', 'store', 'destroy']);
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('pizzas', PizzaController::class)->only(['index', 'show']);


Route::get('/test-cart', function () {
    $pizza = (object) ['id' => 1, 'naam' => 'Margherita', 'prijs' => 7.50];
    $cart = [
        ['pizza' => $pizza, 'quantity' => 2],
    ];

    session()->put('cart', $cart);
    return redirect()->route('cart.view');
});

Route::get('/', function () {
    return view('index');  
})->name('home');


