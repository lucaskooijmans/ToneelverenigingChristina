<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inschrijven</title>
</head>

<body>
    <x-navbar />
    <div class="sponsors">

        <div class="container">
            <h1>Inschrijven bij Toneelvereniging Christina</h1>

            @if (session('success'))
                <p>{{ session('success') }}</p>
            @endif

            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('member.store') }}" class="post-form">
                @csrf

                <div class="form-group">
                    <label for="name">Naam:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="phoneNumber">Telefoonnummer:</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}"
                        class="form-control">
                </div>

                <hr>

                <div class="form-group">
                    <label for="postalCode">Postcode:</label>
                    <input type="text" id="postalCode" name="postalCode" value="{{ old('postalCode') }}" required
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="houseNumber">Huisnummer:</label>
                    <input type="text" id="houseNumber" name="houseNumber" value="{{ old('houseNumber') }}" required
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="street">Straat:</label>
                    <input type="text" id="street" name="street" value="{{ old('street') }}" required
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="city">Plaats:</label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}" required
                        class="form-control">
                </div>

                <hr />

                <div class="form-group">
                    <label for="pay">Ik wil nu betalen:</label>
                    <input type="checkbox" id="pay" name="pay" class="form-control">
                </div>

                <hr />

                <div class="form-group">
                    <label for="accept">Ik ga akkoord met de <a href="/algemene_voorwaarden">algemene
                            voorwaarden</a>.</label>
                    <input type="checkbox" id="accept" name="accept" required>
                </div>

                <button type="submit">Inschrijven</button>
            </form>
        </div>
    </div>

</body>

</html>
