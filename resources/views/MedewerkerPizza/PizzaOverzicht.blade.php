<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza Overzicht</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Pizza Overzicht</h1>

    <!-- Toevoegen Formulier -->
    <form action="{{ route('pizzas.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-6">
        @csrf
        <h2 class="text-xl font-bold mb-4">Nieuwe Pizza Toevoegen</h2>
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
            <input type="text" name="afbeelding" id="afbeelding" placeholder="Afbeelding URL" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight">
        </div>
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Toevoegen
        </button>
    </form>

    <!-- Pizza Overzicht -->
    <h2 class="text-2xl font-bold mb-4">Pizza Lijst</h2>
    <table class="min-w-full bg-white shadow-md rounded">
        <thead>
            <tr>
                <th class="py-2 px-4 bg-gray-200">ID</th>
                <th class="py-2 px-4 bg-gray-200">Naam</th>
                <th class="py-2 px-4 bg-gray-200">Prijs</th>
                <th class="py-2 px-4 bg-gray-200">Afbeelding</th>
                <th class="py-2 px-4 bg-gray-200">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pizzas as $pizza)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $pizza->id }}</td>
                    <td class="py-2 px-4 border-b">{{ $pizza->naam }}</td>
                    <td class="py-2 px-4 border-b">€{{ number_format($pizza->prijs, 2) }}</td>
                    <td class="py-2 px-4 border-b">
                        @if ($pizza->afbeelding)
                            <img src="{{ $pizza->afbeelding }}" alt="{{ $pizza->naam }}" class="w-16 h-16 object-cover">
                        @else
                            Geen afbeelding
                        @endif
                    </td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('pizzas.edit', $pizza->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white px-4 py-2 rounded">Bewerken</a>
                        <form action="{{ route('pizzas.destroy', $pizza->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded" onclick="return confirm('Weet je zeker dat je deze pizza wilt verwijderen?')">Verwijderen</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>
