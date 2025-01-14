@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Bestelling Afronden 🛒</h1>

    @if(count($cart) > 0)
    <form action="{{ route('order.place') }}" method="POST">
        @csrf

        <!-- Klantgegevens -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold mb-4">Klantgegevens</h2>
            <div class="flex space-x-6">
                <div class="flex-1">
                    <label for="naam" class="block text-sm font-medium">Naam</label>
                    <input type="text" name="naam" id="naam" value="{{ old('naam') }}" class="mt-1 w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="flex-1">
                    <label for="email" class="block text-sm font-medium">E-mailadres</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 w-full px-4 py-2 border rounded-md" required>
                </div>
            </div>
            <div class="flex space-x-6 mt-4">
                <div class="flex-1">
                    <label for="telefoonnummer" class="block text-sm font-medium">Telefoonnummer</label>
                    <input type="text" name="telefoonnummer" id="telefoonnummer" value="{{ old('telefoonnummer') }}" class="mt-1 w-full px-4 py-2 border rounded-md" required>
                </div>
                <div class="flex-1">
                    <label for="adres" class="block text-sm font-medium">Adres</label>
                    <input type="text" name="adres" id="adres" value="{{ old('adres') }}" class="mt-1 w-full px-4 py-2 border rounded-md" required>
                </div>
            </div>
            <div class="flex space-x-6 mt-4">
                <div class="flex-1">
                    <label for="woonplaats" class="block text-sm font-medium">Woonplaats</label>
                    <input type="text" name="woonplaats" id="woonplaats" value="{{ old('woonplaats') }}" class="mt-1 w-full px-4 py-2 border rounded-md" required>
                </div>
            </div>
        </div>

        <!-- Bestelling Overzicht -->
        <div class="overflow-x-auto bg-white rounded-lg shadow-lg mb-6">
            <table class="table-auto w-full">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="py-3 px-4 text-left">Naam</th>
                        <th class="py-3 px-4 text-left">Aantal</th>
                        <th class="py-3 px-4 text-left">Prijs per stuk</th>
                        <th class="py-3 px-4 text-left">Totaal</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $item)
                        @if(isset($item['pizza']))
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $item['pizza']->naam }}</td>
                            <td class="py-3 px-4">{{ $item['quantity'] }}</td>
                            <td class="py-3 px-4">€{{ number_format($item['pizza']->prijs, 2) }}</td>
                            <td class="py-3 px-4">€{{ number_format($item['pizza']->prijs * $item['quantity'], 2) }}</td>
                        </tr>
                        @php $total += $item['pizza']->prijs * $item['quantity']; @endphp
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="flex justify-end mt-4">
            <p class="text-xl font-semibold">Totaal: €{{ number_format($total, 2) }}</p>
        </div>

        <!-- Bestelling Plaatsen -->
        <div class="mt-6 text-center">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">
                Bestelling Plaatsen
            </button>
        </div>
    </form>
    @else
        <p class="text-center text-gray-500">Je winkelwagen is leeg. Voeg pizza's toe aan je winkelwagen!</p>
    @endif
</div>
@endsection
