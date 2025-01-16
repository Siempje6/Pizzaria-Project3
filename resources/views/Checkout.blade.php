@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>
    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <!-- Klantgegevens Formulier -->
        <div class="form-group">
            <label for="naam">Naam</label>
            <input type="text" name="naam" id="naam" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="adres">Adres</label>
            <input type="text" name="adres" id="adres" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="woonplaats">Woonplaats</label>
            <input type="text" name="woonplaats" id="woonplaats" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telefoonnummer">Telefoonnummer</label>
            <input type="text" name="telefoonnummer" id="telefoonnummer" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="emailadres">E-mailadres</label>
            <input type="email" name="emailadres" id="emailadres" class="form-control" required>
        </div>

        <!-- Winkelwagen Informatie -->
        <table class="table">
            <thead>
                <tr>
                    <th>Pizza</th>
                    <th>Aantal</th>
                    <th>Afmeting</th>
                    <th>Prijs</th>
                    <th>Totaal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cart as $item)
                    <tr>
                        <td>{{ $item['pizza']->naam }}</td>
                        <td>{{ $item['quantity'] }}</td>
                        <td>{{ $item['afmeting'] }}</td>
                        <td>{{ $item['pizza']->prijs }}€</td>
                        <td>{{ $item['pizza']->prijs * $item['quantity'] }}€</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="text-right">
            <h4>Totaalprijs: {{ $cart->sum(fn($item) => $item['pizza']->prijs * $item['quantity']) }}€</h4>
            <button type="submit" class="btn btn-success">Bestelling plaatsen</button>
        </div>
    </form>
</div>
@endsection
