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
    /**
     * Toon de checkout-pagina
     */
    public function showCheckout()
    {
        $cart = session()->get('cart', []); 
        $user = Auth::user(); 

        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Je winkelwagen is leeg.');
        }

        $klant = Klant::where('emailadres', $user->email)->first();
        $totalPrice = array_reduce($cart, fn($total, $item) => $total + ($item['quantity'] * $item['price']), 0);
        return view('PizzaBestel.Checkout', compact('cart', 'klant', 'totalPrice'));
    }

    /**
     * Maak een nieuwe klant aan
     */
    public function createCustomer(Request $request)
    {
        // Valideer de klantgegevens
        $validatedData = $request->validate([
            'naam' => 'required|string|max:255',
            'emailadres' => 'required|email|unique:klants,emailadres', // Unieke email
            'adres' => 'required|string|max:255',
            'woonplaats' => 'required|string|max:255',
            'telefoonnummer' => 'nullable|string|max:15', // Telefoonnummer is optioneel
        ]);

        // Sla de klant op in de database
        Klant::create($validatedData);

        // Redirect naar de checkoutpagina met een succesbericht
        return redirect()->route('checkout')->with('success', 'Klant succesvol toegevoegd.');
    }

    /**
     * Verwerk de checkout en sla de bestelling op
     */
    public function processCheckout(Request $request)
    {
        // Haal winkelwagentje op uit sessie
        $cart = session()->get('cart', []);
        
        // Als winkelwagentje leeg is, stuur door naar winkelwagenpagina
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Je winkelwagen is leeg.');
        }

        $user = Auth::user(); 
        
        $klant = Klant::where('emailadres', $user->email)->first();

        // Maak een nieuwe bestelling aan in de database
        $bestelling = Bestelling::create([
            'klant_id' => $klant->id,
            'datum' => now(),
            'totaalprijs' => $request->input('totalPrice'), // Totaalprijs uit formulier
            'status' => 'Bereiden', 
        ]);

        // Loop door alle items in het winkelwagentje en voeg ze toe aan de bestelregels
        foreach ($cart as $item) {
            Bestelregel::create([
                'bestelling_id' => $bestelling->id,
                'pizza_id' => $item['pizza']->id, // Haal pizza ID uit het winkelwagentje
                'aantal' => $item['quantity'], // Aantal van de pizza
                'afmeting' => $this->getAfmetingEnumValue($item['size']), // Haal enum waarde voor grootte
                'regelprijs' => $item['quantity'] * $item['price'], 
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
                return null;
        }
    }
}
