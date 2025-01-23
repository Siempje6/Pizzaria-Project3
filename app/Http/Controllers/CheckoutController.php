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
        $cart = session()->get('cart', []); // Haal winkelwagentje op uit sessie
        $user = Auth::user(); // Haal ingelogde gebruiker op

        // Als het winkelwagentje leeg is, stuur door naar winkelwagenpagina
        if (empty($cart)) {
            return redirect()->route('cart.view')->with('error', 'Je winkelwagen is leeg.');
        }

        // Haal klantgegevens op op basis van emailadres van de ingelogde gebruiker
        $klant = Klant::where('emailadres', $user->email)->first();

        // Bereken de totaalprijs van de items in de winkelwagen
        $totalPrice = array_reduce($cart, fn($total, $item) => $total + ($item['quantity'] * $item['price']), 0);

        // Geef de checkoutpagina weer met de winkelwagenitems, klantinformatie en totaalprijs
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
                'regelprijs' => $item['quantity'] * $item['price'], // Totaalprijs per regel
            ]);
        }

        // Verwijder het winkelwagentje uit de sessie na de bestelling
        session()->forget('cart');

    }
    public function confirmation($orderId)
{
    // Haal de bestelling op op basis van het orderID
    $bestelling = Bestelling::with('bestelregels.pizza')->findOrFail($orderId);

    // Geef de bevestigingspagina weer met de bestelling
    return view('order.confirmation', compact('bestelling'));
}


    /**
     * Haal de juiste enum waarde voor de afmeting
     */
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
