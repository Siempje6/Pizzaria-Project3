<!-- resources/views/order/confirmation.blade.php -->
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Bevestiging</title>
</head>
<body>
    <h1>Bestelling Bevestigd!</h1>
    <p>Bedankt voor je bestelling! Hieronder zie je de details:</p>

    <h2>Bestelling #{{ $bestelling->id }}</h2>
    <p>Datum: {{ $bestelling->datum }}</p>
    <p>Status: {{ $bestelling->status }}</p>
    <p>Totaalprijs: €{{ number_format($bestelling->totaalprijs, 2) }}</p>

    <h3>Bestelde Pizza's:</h3>
    <ul>
        @foreach ($bestelling->bestelregels as $regel)
            <li>
                {{ $regel->pizza->naam }} ({{ $regel->afmeting }} cm) x {{ $regel->aantal }} - €{{ number_format($regel->regelprijs, 2) }}
            </li>
        @endforeach
    </ul>
</body>
</html>
