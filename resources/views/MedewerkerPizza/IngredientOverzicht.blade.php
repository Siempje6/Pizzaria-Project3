<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingrediënten Overzicht</title>
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
    <h1 class="text-3xl font-bold mb-6 text-center">Ingrediënten Overzicht</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('ingredienten.add') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">
        Nieuw Ingrediënt Toevoegen
    </a>

    <table class="min-w-full bg-white rounded shadow-md">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Naam</th>
                <th class="py-2 px-4 border-b">Prijs</th>
                <th class="py-2 px-4 border-b">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingredients as $ingredient)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $ingredient->naam }}</td>
                    <td class="py-2 px-4 border-b">€{{ number_format($ingredient->prijs, 2) }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('ingredienten.edit', $ingredient->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white px-4 py-2 rounded">
                            Bewerken
                        </a>
                        <form action="{{ route('ingredienten.destroy', $ingredient->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded" onclick="return confirm('Weet je zeker dat je dit ingrediënt wilt verwijderen?')">
                                Verwijderen
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
