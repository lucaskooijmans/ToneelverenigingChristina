<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Kaart</title>
    <link rel="stylesheet" href="/style.css">
    <style>
        .kaart {
            font-family: Arial, sans-serif;
            margin: 20px;
            border: #333 1px solid;
            padding: 20px;
        }

        h1 {
            color: #333;
            font-size: 40px;
        }

        p {
            color: #666;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="kaart">

        <h1>
            {{-- Titel van voorstelling --}}
            {{ $title }}
        </h1>
        <p>
            Besteld door
            {{-- Naam van klant --}}
            {{ $name }}
        </p>
        <p>
            Code:
            {{-- Kaartcode --}}
            {{ $code }}
        </p>
        <p>
            Besteld voor €
            {{-- Prijs van kaart --}}
            {{ $price }}
        </p>
        <p>
            Geldig op
            {{-- Datum van voorstelling --}}
            {{ $date }}
        </p>
        <p>
            Voor
            {{-- Hoeveelheid kaartjes --}}
            {{ $quantity }}
            personen
        </p>

    </div>
</body>

</html>
