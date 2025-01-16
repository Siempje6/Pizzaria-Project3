<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MakePizzaController;
use App\Http\Controllers\MakeIngredientController;


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

Route::prefix('pizzamedewerker')->middleware('auth')->group(function () {
    Route::get('/', [MakePizzaController::class, 'index'])->name('pizzamedewerker.index');
    Route::get('/add', [MakePizzaController::class, 'create'])->name('pizzamedewerker.add');
    Route::post('/', [MakePizzaController::class, 'store'])->name('pizzamedewerker.store');
    Route::get('/edit/{id}', [MakePizzaController::class, 'edit'])->name('pizzamedewerker.edit');
    Route::put('/{id}', [MakePizzaController::class, 'update'])->name('pizzamedewerker.update');
    Route::delete('/{id}', [MakePizzaController::class, 'destroy'])->name('pizzamedewerker.destroy');
});

Route::prefix('ingredienten')->middleware('auth')->group(function (){
    Route::get('/', [MakeIngredientController::class, 'index'])->name('ingredienten.index');
    Route::get('/add', [MakeIngredientController::class, 'create'])->name('ingredienten.add');
    Route::post('/', [MakeIngredientController::class, 'store'])->name('ingredienten.store');
    Route::get('/edit/{id}', [MakeIngredientController::class, 'edit'])->name('ingredienten.edit');
    Route::put('/{id}', [MakeIngredientController::class, 'update'])->name('ingredienten.update');
    Route::delete('/{id}', [MakeIngredientController::class, 'destroy'])->name('ingredienten.destroy');
});


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

Route::middleware('auth')->group(function() {
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
});
