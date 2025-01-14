<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Toevoegen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Nieuwe Pizza Toevoegen</h1>

    <form action="{{ route('pizzamedewerker.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
        @csrf
        <div class="mb-4">
            <label for="naam" class="block text-gray-700 font-bold mb-2">Naam</label>
            <input type="text" name="naam" id="naam" placeholder="Pizza Naam" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
        </div>
        <div class="mb-4">
            <label for="prijs" class="block text-gray-700 font-bold mb-2">Prijs (€)</label>
            <input type="number" name="prijs" id="prijs" step="0.01" placeholder="Prijs" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
        </div>

        <div class="mb-4">
            <label for="afbeelding" class="block text-gray-700 font-bold mb-2">Afbeelding (pad naar afbeelding)</label>
            <input type="text" name="afbeelding" placeholder="bijv. images/foto.png" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight" required>
        </div>

        <div class="mb-4">
            <label for="ingredients">Ingrediënten</label>
            <select name="ingredients[]" multiple>
                @foreach($ingredients as $ingredient)
                    <option value="{{ $ingredients->id }}" 
                        @if($pizza->ingredients->contains($ingredient->id)) selected @endif>
                        {{ $ingredient->naam }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Toevoegen
        </button>
    </form>
</div>

</body>
</html>
