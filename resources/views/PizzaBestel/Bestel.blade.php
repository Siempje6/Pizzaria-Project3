@extends('layouts.app')

<script>
    function submitForm(){
        document.getElementById('statusform').submit();
    }
</script>
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
                    <form id="statusform" action="{{ route('bestellingen.update', $bestelling) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <select name="status" class="border rounded px-2 py-1" onchange="submitForm()">
                            @foreach($statuses as $status)
                            <option value="{{ $status }}" {{ $bestelling->status === $status ? 'selected' : '' }}>
                                {{ $status }}
                            </option>
                            @endforeach
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection