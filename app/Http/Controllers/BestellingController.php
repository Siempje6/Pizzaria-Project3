<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bestelling;
use App\Models\Klant;

class BestellingController extends Controller
{
    public function index()
    {
        $bestellingen = Bestelling::with('klant')->get(); 
        $statuses = ['Initieel', 'Betaald', 'Bereiden', 'InOven', 'Onderweg', 'Bezorgd']; 

        return view('PizzaBestel.Bestel', compact('bestellingen', 'statuses'));
    }
    

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|max:255',
        ]);

        $bestelling = Bestelling::findOrFail($id); 
        $bestelling->update(['status' => $request->status]); 

        return redirect()->route('bestellingen.index')->with('success', 'Status bijgewerkt!');
    }
}