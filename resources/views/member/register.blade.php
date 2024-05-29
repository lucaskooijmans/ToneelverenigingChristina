<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inschrijven</title>
</head>

<body>
    <x-navbar/>

    <div class="register-form">
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

            <label for="phoneNumber">Telefoonnummer:</label>
            <input type="text" id="phoneNumber" name="phoneNumber">
            <br>

            <label for="password">Wachtwoord:</label>
            <input type="password" id="password" name="password" required>
            <br>

            <hr/>

            <label for="postalCode">Postcode:</label>
            <input type="text" id="postalCode" name="postalCode" required>
            <br>

            <label for="houseNumber">Huisnummer:</label>
            <input type="text" id="houseNumber" name="houseNumber" required>
            <br>

            <label for="street">Straat:</label>
            <input type="text" id="street" name="street" required>
            <br>

            <label for="city">Plaats:</label>
            <input type="text" id="city" name="city" required>
            <br>

            <button type="submit">Inschrijven</button>
        </form>
    </div>

</body>

</html>
