@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Afrekenen</h1>

    <!-- Klantgegevens Formulier -->
    <form method="POST" class="bg-white shadow-md rounded-lg p-6 mb-6">
    @csrf

    <h2 class="text-2xl font-bold mb-4">Klantgegevens</h2>

    <div class="mb-4">
        <label for="naam" class="block text-sm font-medium text-gray-700">Naam</label>
        <input type="text" id="naam" name="naam" value="{{ Auth::user()->name }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div class="mb-4">
        <label for="emailadres" class="block text-sm font-medium text-gray-700">Email</label>
        <input type="email" id="emailadres" name="emailadres" value="{{ Auth::user()->email }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div class="mb-4">
        <label for="adres" class="block text-sm font-medium text-gray-700">Adres</label>
        <input type="text" id="adres" name="adres" value="" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div class="mb-4">
        <label for="woonplaats" class="block text-sm font-medium text-gray-700">Woonplaats</label>
        <input type="text" id="woonplaats" name="woonplaats" value="" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div class="mb-4">
        <label for="telefoonnummer" class="block text-sm font-medium text-gray-700">Telefoon</label>
        <input type="tel" id="telefoonnummer" name="telefoonnummer" value="" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
    </div>

    <div class="flex justify-end">
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Opslaan</button>
    </div>
    </form>

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
</div>
@endsection
