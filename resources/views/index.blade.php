<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pizza's</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">

    <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <h1 class="text-3xl font-bold">Stonks Pizza</h1>
        <a href="/winkelwagen" class="text-lg">Winkelwagen 🛒</a>
    </header>

    <div class="container mx-auto p-6">
        <h2 class="text-2xl font-semibold mb-4 text-center">Onze Pizzas</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($pizzas as $pizza)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ $pizza->afbeelding }}" alt="{{ $pizza->naam }}" class="w-64 h-64 object-cover">
                    
                    <div class="p-4 text-center">
                        <h3 class="text-xl font-semibold">{{ $pizza->naam }}</h3>
                        <p class="text-lg text-gray-500">&euro;{{ number_format($pizza->prijs, 2) }}</p>
                    </div>

                    <form action="/add-to-cart" method="POST" class="p-4 w-full flex items-center justify-center gap-4">
                        @csrf
                        <input type="hidden" name="pizza_id" value="{{ $pizza->id }}">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Voeg toe aan winkelwagen</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>

</body>
</html>
