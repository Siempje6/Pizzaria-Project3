<?php
namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\PizzaSize;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
    {
        // Haal de pizzas op met hun groottes
        $pizzas = Pizza::with('sizes')->get();  
        
        return view('index', compact('pizzas'));
    }

    public function addToCart(Request $request)
    {
        $pizzaId = $request->input('pizza_id');
        $quantity = 1; // standaard aantal
        $pizza = Pizza::findOrFail($pizzaId);

        // Haal de pizza-grootte op
        $size = $request->input('size');
        $pizzaSize = PizzaSize::where('pizza_id', $pizzaId)->where('size', $size)->first();

        $cart = session()->get('cart', []);

        if (isset($cart[$pizzaId])) {
            $cart[$pizzaId]['quantity'] += $quantity;
        } else {
            $cart[$pizzaId] = [
                'pizza' => $pizza,
                'quantity' => $quantity,
                'size' => $pizzaSize->size,
                'price' => $pizzaSize->price,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('pizzas.index')->with('success', 'Pizza toegevoegd aan winkelwagen!');
    }
}

