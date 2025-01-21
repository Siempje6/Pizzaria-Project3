<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pizza;
use App\Models\Bestelling;
use App\Models\Bestelregel;
use App\Models\Klant;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Je winkelwagen is leeg.');
        }

        $user = Auth::user(); 
        $klant = Klant::where('emailadres', $user->email)->first(); 

        $totalPrice = array_reduce($cart, function ($total, $item) {
            return $total + ($item['quantity'] * $item['price']);
        }, 0);

        return view('PizzaBestel.Checkout', compact('user', 'cart', 'klant', 'totalPrice'));
    }

    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Je winkelwagen is leeg.');
        }

        $user = Auth::user();
        $klant = Klant::where('emailadres', $user->email)->first();

        $bestelling = Bestelling::create([
            'klant_id' => $klant->id,
            'datum' => now(),
            'totaalprijs' => $request->input('totalPrice'),
            'status' => 'In behandeling',
        ]);

        foreach ($cart as $item) {
            Bestelregel::create([
                'bestelling_id' => $bestelling->id,
                'pizza_id' => $item['pizza']->id,
                'aantal' => $item['quantity'],
                'afmeting' => $item['size'],
                'regelprijs' => $item['quantity'] * $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('order.confirmation', ['order' => $bestelling->id])
            ->with('success', 'Je bestelling is succesvol geplaatst!');
    }
}
