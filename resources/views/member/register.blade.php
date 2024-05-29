<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inschrijven</title>
</head>

<body>
    <h1>Inschrijven bij Toneelvereniging Christina</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ route('member.store') }}">
        @csrf
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" required>
        <br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        <br>

        <label for="password">Wachtwoord:</label>
        <input type="password" id="password" name="password" required>
        <br>

        <button type="submit">Inschrijven</button>
    </form>
</body>

</html>
