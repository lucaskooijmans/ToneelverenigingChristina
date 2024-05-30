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

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('member.store') }}">
            @csrf

            <label for="name">Naam:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>
            <br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            <br>

            <label for="phoneNumber">Telefoonnummer:</label>
            <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}">
            <br>

            <hr/>

            <label for="postalCode">Postcode:</label>
            <input type="text" id="postalCode" name="postalCode" value="{{ old('postalCode') }}" required>
            <br>

            <label for="houseNumber">Huisnummer:</label>
            <input type="text" id="houseNumber" name="houseNumber" value="{{ old('houseNumber') }}" required>
            <br>

            <label for="street">Straat:</label>
            <input type="text" id="street" name="street" value="{{ old('street') }}" required>
            <br>

            <label for="city">Plaats:</label>
            <input type="text" id="city" name="city" value="{{ old('city') }}" required>
            <br>

            <hr/>

            <label for="pay">Ik wil nu betalen:</label>
            <input type="checkbox" id="pay" name="pay">
            <br>

            <hr/>

            <input type="checkbox" id="accept" name="accept" required>
            <label for="accept">Ik ga akkoord met de <a href="/algemene_voorwaarden">algemene voorwaarden</a>.</label>
            <br>

            <button type="submit">Inschrijven</button>
        </form>
    </div>
</body>

</html>
