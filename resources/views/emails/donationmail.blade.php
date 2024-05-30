<!DOCTYPE html>
<html>
<head>
    <title>{{ $data['subject'] }}</title>
</head>
<body>
    <h1>{{ $data['name'] }}</h1>
    <p>Email: {{ $data['email'] }}</p>
    <p>{{ $data['user_message'] }}</p>
    <p>Type Donatie: {{ $data['type'] }}</p>
    @if ($data['type'] != 'doneren')
        <p>Tot wanneer mag het goed gebruikt worden: {{ $data['date'] }}</p>
    @endif
    <p>Staat van het goed: {{ $data['state'] }}</p>
    <p>Foto van het goed is als bijlage toegevoegd</p>

    @if ($data['image'])
        <img src="{{ $data['image'] }}" alt="Donated Item">
    @endif
</body>
</html>
