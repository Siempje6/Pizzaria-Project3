@extends('layouts.app')

@section('content')
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-r from-indigo-50 to-indigo-100">
        <div class="bg-white p-12 rounded-3xl shadow-lg w-full sm:w-96 flex flex-col justify-center items-center border-t-8 border-indigo-600">
            <h1 class="text-5xl font-extrabold text-center text-gray-900 mb-6">Bestelling Bevestigd!</h1>
            <p class="text-center text-xl text-gray-700 mb-8">Bedankt voor je bestelling! Hieronder zie je de details:</p>

            <h2 class="text-4xl font-semibold text-gray-900 mb-4">Bestelling #{{ $bestelling->id }}</h2>
            <p class="text-lg text-gray-800 mb-2">Datum: <span class="font-medium text-gray-600">{{ $bestelling->datum }}</span></p>
            <p class="text-lg text-gray-800 mb-6">Status: <span class="font-medium text-green-500">{{ $bestelling->status }}</span></p>
            <p class="text-2xl font-bold text-gray-900 mb-6">Totaalprijs: <span class="text-green-600">€{{ number_format($bestelling->totaalprijs, 2) }}</span></p>

            <h3 class="text-2xl font-semibold text-gray-900 mb-4">Bestelde Pizza's:</h3>
            <ul class="list-disc pl-6 space-y-3">
                @foreach ($bestelling->bestelregels as $regel)
                    <li class="text-lg text-gray-700">
                        {{ $regel->pizza->naam }} x {{ $regel->aantal }} - <span class="font-medium text-gray-600">€{{ number_format($regel->regelprijs, 2) }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
