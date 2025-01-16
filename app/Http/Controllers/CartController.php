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

        // Voeg prijzen toe aan de items in de winkelwagen
        foreach ($cart as &$item) {
            $item['price'] = $this->calculatePrice($item['pizza'], $item['size']);
        }

        return view('PizzaBestel.Winkelwagen', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $pizzaId = $request->input('pizza_id');
        $quantity = $request->input('quantity', 1);
        $size = $request->input('size', 'medium'); // Standaard formaat is medium

        $pizza = Pizza::findOrFail($pizzaId);

        $cart = session()->get('cart', []);

        if (isset($cart[$pizzaId]) && $cart[$pizzaId]['size'] == $size) {
            $cart[$pizzaId]['quantity'] += $quantity;
        } else {
            $cart[$pizzaId] = [
                'pizza' => $pizza,
                'quantity' => $quantity,
                'size' => $size,
                'price' => $this->calculatePrice($pizza, $size),
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Pizza toegevoegd aan winkelwagen!');
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $key => $item) {
            if ($item['pizza']->id == $request->pizza_id) {
                unset($cart[$key]);
                break;
            }
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.view');
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $key => &$item) {
            $action = $request->input("action_{$item['pizza']->id}");

            if ($action == 'increase') {
                $item['quantity'] += 1;
            } elseif ($action == 'decrease' && $item['quantity'] > 1) {
                $item['quantity'] -= 1;
            } elseif ($request->has("quantity_{$item['pizza']->id}")) {
                $newQuantity = $request->input("quantity_{$item['pizza']->id}");
                if ($newQuantity && $newQuantity > 0) {
                    $item['quantity'] = $newQuantity;
                }
            }

            if ($request->has("size_{$item['pizza']->id}")) {
                $newSize = $request->input("size_{$item['pizza']->id}");
                if (in_array($newSize, ['small', 'medium', 'large'])) {
                    $item['size'] = $newSize;
                }
            }

            // Werk de prijs bij op basis van de grootte
            $item['price'] = $this->calculatePrice($item['pizza'], $item['size']);
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Winkelwagen bijgewerkt!');
    }

    private function calculatePrice($pizza, $size)
    {
        // Voorbeeld: prijzen voor Pizza Hawaii
        $prices = [
            'Hawaii' => [
                'small' => 10.99,
                'medium' => 11.99,
                'large' => 12.99,
            ],
        ];

        // Haal de juiste prijs op voor de pizza en grootte
        if (isset($prices[$pizza->name][$size])) {
            return $prices[$pizza->name][$size];
        }

        // Default prijs indien niet gedefinieerd
        return 0;
    }
}
