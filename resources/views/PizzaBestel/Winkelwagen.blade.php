@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Winkelwagen</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if(count($cart) > 0)
    <table class="table">
    <thead>
        <tr>
            <th>Naam</th>
            <th>Aantal</th>
            <th>Prijs per stuk</th>
            <th>Totaal</th>
            <th>Acties</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp
        @foreach($cart as $item)
            @if(isset($item['pizza']))
                <tr>
                    <td>{{ $item['pizza']->naam }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>€{{ number_format($item['pizza']->prijs, 2) }}</td>
                    <td>€{{ number_format($item['pizza']->prijs * $item['quantity'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove') }}" method="POST">
                            @csrf
                            <input type="hidden" name="pizza_id" value="{{ $item['pizza']->id }}">
                            <button class="btn btn-danger">Verwijder</button>
                        </form>
                    </td>
                </tr>
                @php $total += $item['pizza']->prijs * $item['quantity']; @endphp
            @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3"><strong>Totaal:</strong></td>
            <td>€{{ number_format($total, 2) }}</td>
        </tr>
    </tfoot>
</table>

    @else
        <p>Je winkelwagen is leeg.</p>
    @endif
</div>
@endsection
