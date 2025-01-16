<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingrediënt Toevoegen</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
<header class="bg-gray-800 text-white p-4 flex justify-between items-center">
                <a href="{{ route('pizzas.index') }}"><h1 class="text-3xl font-bold">Stonks Pizza</h1></a>

                <nav class="flex items-center gap-4">
                    <a href="/winkelwagen" class="text-lg">Winkelwagen 🛒</a>

                    <a href="{{ route('pizzamedewerker.index') }}" class="text-lg px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-md">Pizza's Bewerken</a>
                    <a href="{{ route('ingredienten.index') }}" class="text-lg px-4 py-2 bg-gray-700 hover:bg-gray-600 rounded-md">Ingrediënten Bewerken</a>

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
    <h1 class="text-3xl font-bold mb-6 text-center">Nieuw Ingrediënt Toevoegen</h1>

    @if ($errors->any())
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('ingredienten.store') }}" method="POST" class="bg-white p-6 rounded shadow-md">
        @csrf
        <div class="mb-4">
            <label for="naam" class="block text-gray-700 font-bold mb-2">Naam</label>
            <input type="text" name="naam" id="naam" class="w-full p-2 border rounded" placeholder="Naam van ingrediënt" required>
        </div>

        <div class="mb-4">
            <label for="prijs" class="block text-gray-700 font-bold mb-2">Prijs</label>
            <input type="number" name="prijs" id="prijs" step="0.01" class="w-full p-2 border rounded" placeholder="Prijs van ingrediënt" required>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Toevoegen
        </button>
    </form>
</div>
</body>
</html>