<?php
// app/Http/Controllers/OrderController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderLine;
use App\Models\Pizza;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Toon de checkout-pagina
    public function showCheckout()
    {
        // Haal de bestelling van de ingelogde gebruiker op (bijvoorbeeld de laatste bestelling)
        $order = Order::where('klant_id', Auth::id())->where('status', 'in_progress')->first();

        // Als er geen actieve bestelling is, maak er dan een nieuwe aan
        if (!$order) {
            $order = Order::create([
                'klant_id' => Auth::id(),
                'status' => 'in_progress',
                'totaalprijs' => 0,
            ]);
        }

        // Haal de bijbehorende bestelregels op
        $orderLines = OrderLine::where('bestelling_id', $order->id)->get();

        // Bereken de totaalprijs
        $totalPrice = 0;
        foreach ($orderLines as $line) {
            $totalPrice += $line->regelprijs * $line->aantal;
        }

        // Update de totaalprijs in de bestelling
        $order->totaalprijs = $totalPrice;
        $order->save();

        // Retourneer de checkout view met de bestelling en bestelregels
        return view('checkout', ['order' => $order, 'orderLines' => $orderLines]);
    }

    // Verwerk de checkout (bestelling afronden)
    public function processCheckout(Request $request)
    {
        // Haal de bestelling op
        $order = Order::where('klant_id', Auth::id())->where('status', 'in_progress')->first();

        // Update de status van de bestelling naar 'completed'
        $order->status = 'completed';
        $order->save();

        // Eventueel kunnen we hier verdere logica toevoegen voor betaling en verzending

        return redirect()->route('order.complete');
    }
}
