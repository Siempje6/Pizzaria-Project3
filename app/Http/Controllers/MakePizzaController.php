<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use App\Models\PizzaSize;
use App\Models\Ingrediënt;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use IntlChar;

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
        $pizzas = Pizza::all(); 
        $ingredients = Ingrediënt::all();
        return view('MedewerkerPizza.PizzaAdd', compact('pizzas' , 'ingredients'));
    }

    /**
     * Store a newly created pizza in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'afbeelding' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', 
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'exists:ingrediënts,id',
        ]);

        if ($request->hasFile('afbeelding')) {
            $request->file('afbeelding')->store('images', 'public'); 
        }

        $pizza = Pizza::create([
            'naam' => $request->naam,
            'prijs' => $request->prijs,
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

        return view('MedewerkerPizza.PizzaEdit', compact('pizza', 'ingredients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'prijs' => 'required|numeric',
            'afbeelding' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
            'ingredients' => 'nullable|array',
            'ingredients.*' => 'exists:ingrediënts,id',
        ]);

        $pizza = Pizza::findOrFail($id);

        if ($request->hasFile('afbeelding')) {
            $data['afbeelding'] = $request->file('afbeelding')->store('images', 'public');
            $pizza->afbeelding = $data;
            $pizza->save();
        }

        $pizza->update([
            'naam' => $request->naam,
            'prijs' => $request->prijs,
        ]);

        if ($request->has('ingredients')) {
            $pizza->ingredients()->sync($request->ingredients);
        } else {
            $pizza->ingredients()->detach();
        }

        return redirect()->route('pizzamedewerker.index')->with('success', 'Pizza succesvol bijgewerkt!');
    }


    /**
     * Remove the specified pizza from storage.
     */
    public function destroy($id)
    {
        PizzaSize::where('pizza_id', $id)->delete();
        $pizza = Pizza::findOrFail($id);
        $pizza->delete();

        return redirect()->route('pizzamedewerker.index')->with('success', 'Pizza succesvol verwijderd!');
    }
    public function destroyIngredient($pizzaId, $ingredientId)
    {
        $pizza = Pizza::findOrFail($pizzaId);
        $pizza->ingredients()->detach($ingredientId);

        return redirect()->route('pizzamedewerker.index')->with('success', 'Ingrediënt verwijderd!');
    }
}
