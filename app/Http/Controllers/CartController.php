<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pizza;
use App\Models\PizzaSize; 

class CartController extends Controller
{
    public function viewCart()
    {
        $cart = session()->get('cart', []);

        foreach ($cart as &$item) {
            $item['price'] = $this->calculatePrice($item['pizza'], $item['size']);
        }

        return view('PizzaBestel.Winkelwagen', compact('cart'));
    }

    public function addToCart(Request $request)
    {
        $pizzaId = $request->input('pizza_id');
        $quantity = $request->input('quantity', 1);
        $size = $request->input('size', 'medium');

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

            $item['price'] = $this->calculatePrice($item['pizza'], $item['size']);
        }

        session()->put('cart', $cart);

        return redirect()->route('cart.view')->with('success', 'Winkelwagen bijgewerkt!');
    }

    private function calculatePrice($pizza, $size)
    {
        $pizzaSize = PizzaSize::where('pizza_id', $pizza->id)
            ->where('size', $size)
            ->first();

        return $pizzaSize ? $pizzaSize->price : 0;
    }
}
