<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bestelling;
use App\Models\Bestelregel;
use App\Models\Klant;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    // Toon de checkout-pagina
    public function showCheckout()
    {
        $cart = session()->get('cart', []);  // Haal winkelwagen op uit de sessie
        return view('checkout', compact('cart'));
    }

    // Verwerk de checkout en sla de klant- en bestellinggegevens op
    public function processCheckout(Request $request)
    {
        // Haal winkelwagen op uit de sessie
        $cart = session()->get('cart', []);
        $totaalPrijs = 0;

        // Bereken de totaalprijs van de bestelling
        foreach ($cart as $item) {
            $totaalPrijs += $item['pizza']->prijs * $item['quantity'];
        }

        // Maak de klant aan en sla deze op
        $klant = Klant::create([
            'naam' => $request->naam,
            'adres' => $request->adres,
            'woonplaats' => $request->woonplaats,
            'telefoonnummer' => $request->telefoonnummer,
            'emailadres' => $request->emailadres,
        ]);

        // Maak de bestelling aan en koppel deze aan de klant
        $bestelling = Bestelling::create([
            'klant_id' => $klant->id,
            'datum' => now(),
            'status' => 'Initieel',
            'totaalprijs' => $totaalPrijs,
        ]);

        // Voeg bestelregels toe voor elke pizza in de winkelwagen
        foreach ($cart as $item) {
            Bestelregel::create([
                'bestelling_id' => $bestelling->id,
                'pizza_id' => $item['pizza']->id,
                'aantal' => $item['quantity'],
                'afmeting' => $item['afmeting'],  // Verondersteld dat afmeting aanwezig is
                'regelprijs' => $item['pizza']->prijs * $item['quantity'],
            ]);
        }

        // Leeg de winkelwagen na het plaatsen van de bestelling
        session()->forget('cart');

        // Stuur de gebruiker naar een succespagina
        return redirect()->route('order.success')->with('success', 'Bestelling succesvol geplaatst!');
    }
}
