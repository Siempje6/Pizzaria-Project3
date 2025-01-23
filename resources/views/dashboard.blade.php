@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 bg-gray-100 min-h-screen rounded-lg shadow-md">
    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 p-6 rounded-lg shadow-lg text-white text-center">
        <h1 class="text-4xl font-extrabold mb-2">Dashboard</h1>
        <p class="text-lg font-medium">Welkom! Beheer hier je accountinstellingen en toegang tot verschillende delen van de applicatie.</p>
    </div>

    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow-lg p-6 text-center transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
            <div class="flex justify-center items-center mb-4 text-blue-500">
                <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h11M9 21v-4a4 4 0 00-4-4H3m6-6h11M15 3v4a4 4 0 004 4h1" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Bekijk de site</h2>
            <a href="{{ route('pizzas.index') }}" 
                class="bg-blue-500 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:bg-blue-700 transition">
                Naar de site
            </a>
        </div>

        @role('admin|superadmin')
        <div class="bg-white rounded-lg shadow-lg p-6 text-center transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
            <div class="flex justify-center items-center mb-4 text-green-500">
                <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7V3m0 0a4 4 0 00-8 0v4m8 0a4 4 0 00-8 0m6 10H10m4 0h-4m0 0V9m0 8h4m0-8v8" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Pizza's beheren</h2>
            <a href="{{ route('pizzamedewerker.index') }}" 
                class="bg-green-500 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:bg-green-700 transition">
                Pizza's bewerken
            </a>
        </div>
        @endrole
        @role('superadmin')
        <div class="bg-white rounded-lg shadow-lg p-6 text-center transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
            <div class="flex justify-center items-center mb-4 text-red-500">
                <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 12.75L12 15m0 0l2.25-2.25m-2.25 2.25V9m4.5 7.5v1.875c0 1.5-1.5 3-3 3H9.75c-1.5 0-3-1.5-3-3V16.5m0 0v-1.875c0-1.5 1.5-3 3-3h4.5c1.5 0 3 1.5 3 3V16.5z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Accounts beheren</h2>
            <a href="{{ route('admin.index') }}" 
                class="bg-red-500 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:bg-red-700 transition">
                Accounts bewerken
            </a>
        </div>
        @endrole

        @role('admin|superadmin')
        <div class="bg-white rounded-lg shadow-lg p-6 text-center transform transition duration-300 hover:-translate-y-2 hover:shadow-2xl">
            <div class="flex justify-center items-center mb-4 text-yellow-500">
                <svg class="w-12 h-12" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Bestellingen bekijken</h2>
            <a href="{{ route('bestellingen.index') }}" 
                class="bg-yellow-500 text-white font-bold py-3 px-6 rounded-lg shadow-md hover:bg-yellow-700 transition">
                Naar bestellingen
            </a>
        </div>
        @endrole
    </div>
</div>
@endsection
