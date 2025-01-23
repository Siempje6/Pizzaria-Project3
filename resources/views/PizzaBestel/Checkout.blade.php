@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Afrekenen</h1>

    <!-- Als er nog geen klantgegevens zijn, laat dan het formulier zien -->
    @if(!$klant)
    <form action="{{ route('checkout.createCustomer') }}" method="POST" class="bg-white shadow-md rounded-lg p-6 mb-6">
        @csrf
        <h2 class="text-2xl font-bold mb-4">Klantgegevens</h2>
        <div class="mb-4">
            <label for="naam" class="block text-gray-700 font-bold mb-2">Naam</label>
            <input type="text" name="naam" id="naam" required
                class="w-full p-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <label for="emailadres" class="block text-gray-700 font-bold mb-2">Emailadres</label>
            <input type="email" name="emailadres" id="emailadres" value="{{ Auth::user()->email }}" readonly
                class="w-full p-2 border rounded-lg bg-gray-100">
        </div>
        <div class="mb-4">
            <label for="adres" class="block text-gray-700 font-bold mb-2">Adres</label>
            <input type="text" name="adres" id="adres" required
                class="w-full p-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <label for="woonplaats" class="block text-gray-700 font-bold mb-2">Woonplaats</label>
            <input type="text" name="woonplaats" id="woonplaats" required
                class="w-full p-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <label for="telefoonnummer" class="block text-gray-700 font-bold mb-2">Telefoonnummer</label>
            <input type="text" name="telefoonnummer" id="telefoonnummer"
                class="w-full p-2 border rounded-lg">
        </div>
        <div class="mb-4">
            <button type="submit" 
                class="px-4 py-2 bg-blue-600 text-black font-bold rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Opslaan
            </button>
        </div>
    </form>
    @else
    <!-- Klantgegevens Weergave -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4">Klantgegevens</h2>
        <p><strong>Naam:</strong> {{ $klant->naam }}</p>
        <p><strong>Email:</strong> {{ $klant->emailadres }}</p>
        <p><strong>Adres:</strong> {{ $klant->adres }}, {{ $klant->woonplaats }}</p>
        <p><strong>Telefoon:</strong> {{ $klant->telefoonnummer }}</p>
    </div>

    <!-- Besteloverzicht -->
    <div class="bg-white shadow-md rounded-lg p-6 mb-6">
        <h2 class="text-2xl font-bold mb-4">Besteloverzicht</h2>
        <table class="table-auto w-full">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4">Pizza</th>
                    <th class="py-3 px-4">Formaat</th>
                    <th class="py-3 px-4">Aantal</th>
                    <th class="py-3 px-4">Prijs</th>
                    <th class="py-3 px-4">Totaal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                <tr>
                    <td class="py-3 px-4">{{ $item['pizza']->naam }}</td>
                    <td class="py-3 px-4">{{ ucfirst($item['size']) }}</td>
                    <td class="py-3 px-4">{{ $item['quantity'] }}</td>
                    <td class="py-3 px-4">€{{ number_format($item['price'], 2) }}</td>
                    <td class="py-3 px-4">€{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-200">
                    <td colspan="4" class="py-3 px-4 text-right font-semibold">Totaal:</td>
                    <td class="py-3 px-4 font-semibold">€{{ number_format($totalPrice, 2) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <!-- Bestelling Plaatsen -->
    <form action="{{ route('checkout.process') }}" method="POST" class="text-center">
        @csrf
        <input type="hidden" name="totalPrice" value="{{ $totalPrice }}">
        <button class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">Bestelling Plaatsen</button>
    </form>
    @endif
</div>
@endsection
