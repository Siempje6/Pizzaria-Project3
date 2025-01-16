<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Pizza;
use App\Models\Ingrediënt;

class MakeIngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingrediënt::all();
        return view('MedewerkerPizza.IngredientOverzicht', compact('ingredients')); 
    }

    public function create()
    { 
        $ingredients = Ingrediënt::all();
        return view('MedewerkerPizza.IngredientAdd', compact('ingredients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
        ]);

        $ingredients = Ingrediënt::create([
            'naam' => $request->naam,
            'prijs' => $request->prijs,
        ]);

        return redirect()->route('ingredienten.index')->with('success', 'Ingredient toegevoegd!');
    }

    public function edit($id)
    {
        $ingredient = Ingrediënt::findOrFail($id);

        return view('MedewerkerPizza.IngredientEdit', compact('ingredient'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
        ]);

        $ingredient = Ingrediënt::findOrFail($id);

        $ingredient->update($request->all());

        return redirect()->route('ingredienten.index')->with('success', 'Ingredient succesvol bijgewerkt!');
    }

    public function destroy($id)
    {
        $ingredient = Ingrediënt::findOrFail($id);
        $ingredient->delete();

        return redirect()->route('ingredienten.index')->with('success', 'Ingredient succesvol verwijderd!');
    }
}
