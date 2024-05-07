<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Kaart</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <h1>
        {{-- Titel van voorstelling --}}
        {{ $title }} 
    </h1>
    <p>
        {{-- Naam van klant --}}
        {{ $name }}
    </p>
    <p>
        {{-- Kaartcode --}}
        {{ $code }}
    </p>
    <p>
        {{-- Prijs van kaart --}}
        {{ $price }}
    </p>
    <p>
        {{-- Datum van voorstelling --}}
        {{ $date }}
    </p>
    <p>
        {{-- Hoeveelheid kaartjes --}}
        {{ $quantity }}
    </p>
</body>
</html>
