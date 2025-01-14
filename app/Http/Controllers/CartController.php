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
    
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $key => &$item) {
            // Haal de actie (increase of decrease) op
            $action = $request->input("action_{$item['pizza']->id}");

            // Verhoog of verlaag de hoeveelheid op basis van de actie
            if ($action == 'increase') {
                $item['quantity'] += 1; // Verhoog de hoeveelheid met 1
            } elseif ($action == 'decrease' && $item['quantity'] > 1) {
                $item['quantity'] -= 1; // Verlaag de hoeveelheid met 1, maar niet onder 1
            } elseif ($request->has("quantity_{$item['pizza']->id}")) {
                // Als de gebruiker een specifieke hoeveelheid heeft ingevoerd, werk die bij
                $newQuantity = $request->input("quantity_{$item['pizza']->id}");

                if ($newQuantity && $newQuantity > 0) {
                    $item['quantity'] = $newQuantity; // Werk de hoeveelheid bij
                }
            }
        }

        // Sla de geüpdatete winkelwagen op
        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Winkelwagen bijgewerkt!');
    }
}
