<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Toevoegen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <body class="bg-gray-100">
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
            <a href="{{ route('pizzas.index') }}"><h1 class="text-3xl font-bold">Stonks Pizza</h1></a>

            <nav class="flex items-center gap-4">
                <a href="/winkelwagen" class="text-lg">Winkelwagen 🛒</a>

                @guest
                    <a href="{{ route('login') }}" class="text-lg">Inloggen</a>
                    <a href="{{ route('register') }}" class="text-lg">Registreren</a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}" class="text-lg">Mijn Account</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-lg">Uitloggen</button>
                    </form>
                @endauth
            </nav>
    </header>

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
            <label for="afbeelding" class="block text-gray-700 font-bold mb-2">Afbeelding URL</label>
            <input type="text" name="afbeelding" id="afbeelding" value="{{ $pizza->afbeelding }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
        </div>

        <label for="ingredients" class="block text-gray-700 font-bold mb-2">Ingrediënten:</label>
        <select name="ingredients[]" id="ingredients" required multiple class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
            @foreach($ingredients as $ingredient)
                <option value="{{ $ingredient->id }}"> {{ $ingredient->naam }} - € {{ $ingredient->prijs }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Toevoegen
        </button>
    </form>
</div>

</body>
</html>
