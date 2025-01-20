@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold">Welkom op je dashboard!</h1>
    <p>Hier kun je je accountinstellingen beheren.</p>
    <a href="{{ route('pizzas.index') }}" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out">
        Ga hier terug naar de site
    </a>
    @role('admin|superadmin')
    <a href="{{ route('pizzamedewerker.index') }}" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out">
        Bewerk Hier de Pizza's
    </a>
    @endrole
    @role('superadmin')
    <a href="{{ route('admin.index') }}" class="inline-block bg-blue-500 text-white font-bold py-2 px-4 rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 ease-in-out">
        Bewerk Hier de Accounts
    </a>
    @endrole

</div>
@endsection
