<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;

class CartController extends Controller
{
    public function viewCart()
    {
        // Haal de cart op uit de sessie
        $cart = session()->get('cart', []);

        // Zorg dat de cart correct is gestructureerd
        foreach ($cart as &$item) {
            if (!isset($item['pizza'])) {
                $item['pizza'] = null; // Default waarde indien 'pizza' ontbreekt
            }
        }

        return view('PizzaBestel.Winkelwagen', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $pizzaId = $request->input('pizza_id');
        $quantity = $request->input('quantity', 1);

        $pizza = Pizza::findOrFail($pizzaId);

        $cart = session()->get('cart', []);

        if (isset($cart[$pizzaId])) {
            $cart[$pizzaId]['quantity'] += $quantity;
        } else {
            $cart[$pizzaId] = [
                'pizza' => $pizza,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Pizza toegevoegd aan winkelwagen!');
    }

    public function removeFromCart(Request $request)
{
    $cart = session()->get('cart', []);

    // Verwijder het item
    foreach ($cart as $key => $item) {
        if ($item['pizza']->id == $request->pizza_id) {
            unset($cart[$key]);
            break;
        }
    }

    // Sla de geüpdatete cart op
    session()->put('cart', $cart);

    return redirect()->route('cart.view');
}
}
