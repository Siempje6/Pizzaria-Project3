@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Winkelwagen 🛒</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cart) > 0)
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <table class="table-auto w-full">
            <thead class="bg-gray-800 text-white">
                <tr>
                    <th class="py-3 px-4 text-left">Naam</th>
                    <th class="py-3 px-4 text-left">Aantal</th>
                    <th class="py-3 px-4 text-left">Prijs per stuk</th>
                    <th class="py-3 px-4 text-left">Totaal</th>
                    <th class="py-3 px-4 text-left">Acties</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($cart as $item)
                    @if(isset($item['pizza']))
                    <tr class="border-b">
                        <td class="py-3 px-4">{{ $item['pizza']->naam }}</td>
                        <td class="py-3 px-4">
                            <form action="{{ route('cart.update') }}" method="POST">
                                @csrf
                                <input type="hidden" name="pizza_id" value="{{ $item['pizza']->id }}">
                                <div class="flex items-center space-x-2">
                                    <button type="submit" name="action_{{ $item['pizza']->id }}" value="decrease" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">-</button>
                                    <span class="px-4 py-2">{{ $item['quantity'] }}</span>
                                    <button type="submit" name="action_{{ $item['pizza']->id }}" value="increase" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">+</button>
                                </div>
                            </form>
                        </td>
                        <td class="py-3 px-4">€{{ number_format($item['pizza']->prijs, 2) }}</td>
                        <td class="py-3 px-4">€{{ number_format($item['pizza']->prijs * $item['quantity'], 2) }}</td>
                        <td class="py-3 px-4">
                            <form action="{{ route('cart.remove') }}" method="POST">
                                @csrf
                                <input type="hidden" name="pizza_id" value="{{ $item['pizza']->id }}">
                                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Verwijder</button>
                            </form>
                        </td>
                    </tr>
                    @php $total += $item['pizza']->prijs * $item['quantity']; @endphp
                    @endif
                @endforeach
            </tbody>
            <tfoot>
                <tr class="bg-gray-200">
                    <td colspan="3" class="py-3 px-4 text-right font-semibold">Totaal:</td>
                    <td class="py-3 px-4 font-semibold">€{{ number_format($total, 2) }}</td>
                    <td class="py-3 px-4"></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="mt-6 text-center">
        <a href="{{ route('checkout') }}" class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">
            Naar de kassa
        </a>
    </div>
    @else
        <p class="text-center text-gray-500">Je winkelwagen is leeg. Voeg pizza's toe aan je winkelwagen!</p>
    @endif
</div>
@endsection
