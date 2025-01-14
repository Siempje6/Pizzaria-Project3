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

    <!-- Knop verplaatst naar rechts -->
    <div class="flex justify-end mb-4">
        <a href="{{ route('pizzamedewerker.add') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-6 py-2 rounded">Nieuwe Pizza Toevoegen</a>
    </div>

    <h2 class="text-2xl font-bold mb-4">Beschikbare Pizza's</h2>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($pizzas as $pizza)
            <div class="bg-white rounded-lg shadow-lg p-4">
               
                <h3 class="text-xl font-bold text-center mb-2">{{ $pizza->naam }}</h3>

                <div class="flex justify-center mb-4">
                    <img src="{{ $pizza->afbeelding }}" alt="{{ $pizza->naam }}" class="w-32 h-32 object-cover rounded-full">
                </div>

                <p class="text-center text-lg font-semibold mb-4">€{{ number_format($pizza->prijs, 2) }}</p>


                <div class="flex justify-around">
                    <a href="{{ route('pizzamedewerker.edit', $pizza->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white px-4 py-2 rounded">Bewerken</a>
                    <form action="{{ route('pizzamedewerker.destroy', $pizza->id) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded" onclick="return confirm('Weet je zeker dat je deze pizza wilt verwijderen?')">Verwijderen</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

</body>
</html>
