<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingrediënten Overzicht</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
        /* Header en infobalk als één blok */
        header {
            background-color: #2d3748;
            color: white;
        }

        .header-content {
            padding: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Infobalk */
        .info-bar {
            background: #4a5568;
            padding: 8px 0;
            text-align: center;
            font-size: 16px;
            letter-spacing: 1px;
        }

        .info-bar p {
            white-space: nowrap;
            animation: move-text 20s linear infinite;
            margin: 0;
            color: #edf2f7;
        }

        @keyframes move-text {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }

        /* Visueel element tussen de header en pizza's */
        .visual-divider {
            background-color: #edf2f7;
            height: 2px;
            margin-top: 30px;
            margin-bottom: 30px;
            animation: expand 2s ease-in-out infinite;
        }

        @keyframes expand {
            0% { width: 0%; }
            50% { width: 60%; }
            100% { width: 100%; }
        }

        /* Pizza card styling */
        .pizza-card {
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
        }

        .pizza-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .pizza-img {
            width: 80%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
        }

        .pizza-card .p-4 {
            padding: 16px;
            text-align: center;
        }

        .pizza-card .text-xl {
            font-weight: bold;
            color: #2d3748;
        }

        .pizza-card .text-gray-500 {
            color: #4a5568;
        }

        .pizza-card .bg-blue-500 {
            background-color: #3182ce;
        }

        .pizza-card .bg-blue-500:hover {
            background-color: #2b6cb0;
        }

        .pizza-card .text-white {
            color: white;
        }

        /* Ruimte boven de inhoud */
        .container {
            margin-top: 0;
        }

        /* Verplaats de pizza kaarten dichter bij de bovenkant */
        .pizza-card-container {
            margin-top: 10px;
        }

        /* Popup styling */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .modal-content {
            background-color: #fff;
            padding: 40px;
            border-radius: 16px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: slideIn 0.6s ease-out;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
        }

        @keyframes slideIn {
            0% { transform: translateY(-50px); opacity: 0; }
            100% { transform: translateY(0); opacity: 1; }
        }

        .modal h2 {
            font-size: 2.5rem;
            font-weight: bold;
            color: #3182ce;
            margin-bottom: 20px;
        }

        .modal p {
            font-size: 1.25rem;
            color: #4a5568;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .modal button {
            background-color: #3182ce;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
            width: 200px;
            align-self: center;
        }

        .modal button:hover {
            background-color: #2b6cb0;
        }

        .modal button:focus {
            outline: none;
        }

        /* Styling voor de icoontjes en tekst in de navigatie */
        .nav-icons {
            display: flex;
            gap: 16px;
            color: white;
        }

        .nav-icons a {
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            color: white;
            font-size: 18px;
        }

        .nav-icons a:hover {
            color: #3182ce;
        }

        .nav-icons i {
            margin-right: 8px;
        }
    </style>
<body class="bg-gray-100">
<header>
        <div class="header-content">
            <a href="{{ route('pizzas.index') }}"><h1 class="text-3xl font-bold">Stonks Pizza</h1></a>

        <nav class="flex items-center gap-4">
            <a href="/winkelwagen" class="text-lg">Winkelwagen 🛒</a>

                @guest
                    <a href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt"></i><span>Login</span>
                    </a>
                    <a href="{{ route('register') }}">
                        <i class="fas fa-user-plus"></i><span>Registreren</span>
                    </a>
                @endguest

                @auth
                    <a href="{{ route('dashboard') }}">
                        <i class="fas fa-user-circle"></i><span>Account</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-lg">
                            <i class="fas fa-sign-out-alt"></i><span>Uitloggen</span>
                        </button>
                    </form>
                @endauth
            </nav>
        </div>

        <div class="info-bar">
            <p>🔥 Nieuwe pizza's in de aanbieding! Koop nu 2 pizza's en krijg de derde gratis! 🌟 Actie geldig tot eind deze maand. 📦 Gratis verzending bij bestellingen boven de €25!</p>
        </div>
    </header>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-center">Ingrediënten Overzicht</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('ingredienten.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded mb-4 inline-block">
        Nieuw Ingrediënt Toevoegen
    </a>

    <table class="min-w-full bg-white rounded shadow-md">
        <thead>
            <tr>
                <th class="py-2 px-4 border-b">Naam</th>
                <th class="py-2 px-4 border-b">Prijs</th>
                <th class="py-2 px-4 border-b">Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ingredients as $ingredient)
                <tr>
                    <td class="py-2 px-4 border-b">{{ $ingredient->naam }}</td>
                    <td class="py-2 px-4 border-b">€{{ number_format($ingredient->prijs, 2) }}</td>
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('ingredienten.edit', $ingredient->id) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white px-4 py-2 rounded">
                            Bewerken
                        </a>
                        <form action="{{ route('ingredienten.destroy', $ingredient->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded" onclick="return confirm('Weet je zeker dat je dit ingrediënt wilt verwijderen?')">
                                Verwijderen
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
