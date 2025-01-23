<?php
namespace App\Http\Controllers;

use App\Models\Ingrediënt;
use App\Models\Pizza;
use App\Models\PizzaSize;
use Illuminate\Http\Request;

class PizzaController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::with('sizes')->get();

        $ingredients = Ingrediënt::all();

        return view('index', compact('pizzas', 'ingredients'));
    }

    public function addToCart(Request $request)
    {
        $pizzaId = $request->input('pizza_id');
        $quantity = 1; 
        $pizza = Pizza::findOrFail($pizzaId);

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

