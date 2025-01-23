@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6 max-w-4xl">
    <div class="bg-white shadow-lg rounded-lg p-8">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-6">Mijn Profiel</h1>
        <p class="text-gray-600 mb-4">Beheer je persoonlijke gegevens en houd ze up-to-date.</p>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <title>Close</title>
                        <path d="M14.348 14.849a1 1 0 01-1.415 0L10 11.415l-2.934 2.934a1 1 0 01-1.415-1.415l2.934-2.934-2.934-2.934a1 1 0 011.415-1.415L10 8.585l2.934-2.934a1 1 0 111.415 1.415L11.415 10l2.934 2.934a1 1 0 010 1.415z"/>
                    </svg>
                </span>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Naam</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">E-mailadres</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between">
                <button type="submit" class="bg-indigo-500 text-white py-2 px-6 rounded-lg hover:bg-indigo-600 transition duration-300">
                    Profiel Bijwerken
                </button>
                <a href="{{ route('dashboard') }}" class="text-indigo-500 hover:text-indigo-700 transition duration-300">
                    Terug naar Dashboard
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
