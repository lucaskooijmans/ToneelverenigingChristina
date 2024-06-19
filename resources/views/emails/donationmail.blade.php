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
    @if ($data['image'])
    <p>Foto:</p>
        <img src="{{ $message->embed(public_path('storage/' . $data['image'])) }}" alt="Donated Item">
    @endif
</body>
</html>
