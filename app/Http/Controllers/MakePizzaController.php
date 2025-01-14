<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\Ingrediënt;
use Illuminate\Http\Request;

class MakePizzaController extends Controller
{
    /**
     * Display a listing of the pizzas.
     */
    public function index()
    {
        $ingredients = Ingrediënt::all();
        $pizzas = Pizza::all(); 
        return view('MedewerkerPizza.PizzaOverzicht', compact('pizzas', 'ingredients')); 
    }

    /**
     * Show the form for creating a new pizza.
     */
    public function create()
    {
        $ingredients = Ingrediënt::all();
        return view('MedewerkerPizza.PizzaAdd', compact('ingredients'));
    }

    /**
     * Store a newly created pizza in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'afbeelding' => 'nullable|string|max:255',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'exists:ingrediënts,id', 
        ]);

        $pizza = Pizza::create([
            'naam' => $request->naam,
            'prijs' => $request->prijs,
            'afbeelding' => $request->afbeelding,
        ]);

        if ($request->has('ingredients')) {
            $pizza->ingredients()->attach($request->ingredients);
        }

        return redirect()->route('pizzamedewerker.index')->with('success', 'Pizza toegevoegd!');
    }

    /**
     * Show the form for editing the specified pizza.
     */
    public function edit($id)
    {
        $pizza = Pizza::with('ingredients')->findOrFail($id);

        $ingredients = Ingrediënt::all();

        return view('MedewerkerPizza.edit', compact('pizza', 'ingredients'));
    }

    /**
     * Update the specified pizza in storage.
     */
    public function update(Request $request, $id)
{
    $request->validate([
        'naam' => 'required|string|max:255',
        'prijs' => 'required|numeric|min:0',
        'afbeelding' => 'nullable|string|url',
    ]);

    $pizza = Pizza::findOrFail($id);

    $pizza->update([
        'naam' => $request->naam,
        'prijs' => $request->prijs,
        'afbeelding' => $request->afbeelding,
    ]);

    return redirect()->route('pizzamedewerker.index')->with('success', 'Pizza succesvol bijgewerkt!');
}


    /**
     * Remove the specified pizza from storage.
     */
    public function destroy($id)
    {
        $pizza = Pizza::findOrFail($id);
        $pizza->delete();

        return redirect()->route('pizzas.index')->with('success', 'Pizza succesvol verwijderd!');
    }
    public function destroyIngredient($pizzaId, $ingredientId)
    {
        $pizza = Pizza::findOrFail($pizzaId);
        $pizza->ingredients()->detach($ingredientId);

        return redirect()->route('pizzamedewerker.index')->with('success', 'Ingrediënt verwijderd!');
    }
}
