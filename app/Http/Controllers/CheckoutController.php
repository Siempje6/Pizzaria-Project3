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
        $user = Auth::user(); 

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Je winkelwagen is leeg.');
        }

        $klant = Klant::where('emailadres', $user->email)->first();

        // Bereken de totaalprijs van de items in de winkelwagen
        $totalPrice = array_reduce($cart, fn($total, $item) => $total + ($item['quantity'] * $item['price']), 0);

        // Geef de checkoutpagina weer met de winkelwagenitems, klantinformatie en totaalprijs
        return view('PizzaBestel.Checkout', compact('cart', 'klant', 'totalPrice'));
    }

    public function createCustomer(Request $request)
    {
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'emailadres' => 'required|email|unique:klants,emailadres',
            'adres' => 'required|string|max:255',
            'woonplaats' => 'required|string|max:255',
            'telefoonnummer' => 'nullable|string|max:15', 
        ]);

        Klant::create($validatedData);

        return redirect()->route('checkout')->with('success', 'Klant succesvol toegevoegd.');
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
            'status' => 'Bereiden', 
        ]);

        foreach ($cart as $item) {
            Bestelregel::create([
                'bestelling_id' => $bestelling->id,
                'pizza_id' => $item['pizza']->id, // Haal pizza ID uit het winkelwagentje
                'aantal' => $item['quantity'], // Aantal van de pizza
                'afmeting' => $this->getAfmetingEnumValue($item['size']), // Haal enum waarde voor grootte
                'regelprijs' => $item['quantity'] * $item['price'], // Totaalprijs per regel
            ]);
        }

        session()->forget('cart');

        return redirect()->route('order.confirmation', ['orderId' => $bestelling->id]);
    }

    public function confirmation($orderId)
    {
        $bestelling = Bestelling::with('bestelregels.pizza')->findOrFail($orderId);

        return view('order.confirmation', compact('bestelling'));
    }

    private function getAfmetingEnumValue($size)
    {
        switch (strtolower($size)) {
            case 'klein':
                return 'Klein';
            case 'normaal':
                return 'Normaal';
            case 'groot':
                return 'Groot';
            default:
                return null; // Of een andere fallback, afhankelijk van je businesslogica
        }
    }
}
