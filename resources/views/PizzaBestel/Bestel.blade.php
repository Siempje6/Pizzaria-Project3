@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Overzicht Bestellingen</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-6">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">Bestelling ID</th>
                <th class="border border-gray-300 px-4 py-2">Klant Naam</th>
                <th class="border border-gray-300 px-4 py-2">Datum</th>
                <th class="border border-gray-300 px-4 py-2">Totaalprijs</th>
                <th class="border border-gray-300 px-4 py-2">Status</th>
                <th class="border border-gray-300 px-4 py-2">Actie</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bestellingen as $bestelling)
                <tr>
                    <td class="border border-gray-300 px-4 py-2">{{ $bestelling->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $bestelling->klant->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $bestelling->datum }}</td>
                    <td class="border border-gray-300 px-4 py-2">€{{ number_format($bestelling->totaalprijs, 2) }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <form action="{{ route('bestellingen.update', $bestelling->id) }}" method="POST">
                            @csrf
                            <select name="status" class="border rounded px-2 py-1" onchange="this.form.submit()">
                                @foreach($statuses as $status)
                                    <option value="{{ $status }}" {{ $bestelling->status === $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <button class="bg-red-500 text-white px-4 py-2 rounded" onclick="confirm('Weet je zeker dat je deze bestelling wilt verwijderen?')">
                            Verwijder
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
