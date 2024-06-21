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
        @php
            $images = json_decode(file_get_contents(resource_path('intro.json')), true);
            $sectionImage = $images['inschrijven_intro'] ?? 'default_intro.jpg';
        @endphp

        <section class="intro" style="background-image: url('{{ asset('storage/introImages/' . $sectionImage) }}');">
            <h1><strong>{!! nl2br(__("inschrijven-titel")) !!}</strong></h1>

            @auth
                <a href="javascript:void(0)" onclick="toggleUploadForm()" class="button green-button">Achtergrondafbeelding aanpassen</a>
                <form id="imageUploadForm" class="no-blur" action="{{ route('uploadImage') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <input type="hidden" name="section" value="inschrijven_intro">
                    <input type="file" name="image" class="form-control">
                    <button type="submit" class="button green-button">Upload</button>
                </form>
            @endauth

            <p>{!! nl2br(__("inschrijven-intro")) !!}</p>

            @auth
                <a href="{{ route('text.index') }}" class="button green-button">Tekst bewerken</a>
            @endauth
        </section>

        <script>
            function toggleUploadForm() {
                var form = document.getElementById('imageUploadForm');
                if (form.style.display === "none") {
                    form.style.display = "block";
                } else {
                    form.style.display = "none";
                }
            }
        </script>
        <div class="container">

            @if (session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
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
                    <label for="name">Naam: <b>*</b></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="email">Email: <b>*</b></label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="phoneNumber">Telefoonnummer:</label>
                    <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber') }}"
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="postalCode">Postcode: <b>*</b></label>
                    <input type="text" id="postalCode" name="postalCode" value="{{ old('postalCode') }}" required
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="houseNumber">Huisnummer: <b>*</b></label>
                    <input type="text" id="houseNumber" name="houseNumber" value="{{ old('houseNumber') }}" required
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="street">Straat: <b>*</b></label>
                    <input type="text" id="street" name="street" value="{{ old('street') }}" required
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="city">Plaats: <b>*</b></label>
                    <input type="text" id="city" name="city" value="{{ old('city') }}" required
                        class="form-control">
                </div>

                <div class="form-group">
                    <label for="pay">Ik wil nu betalen:</label>
                    <input type="checkbox" id="pay" name="pay" class="form-control">
                </div>

                <div class="form-group">
                    <label for="accept">Ik ga akkoord met de <a href="/algemene_voorwaarden">algemene
                            voorwaarden </a>. <b>*</b></label>
                    <input type="checkbox" id="accept" name="accept" required class="form-control">
                </div>
                <label><b>*</b> Verplicht veld</label>

                <button type="submit" class="button green-button">Inschrijven</button>
            </form>
        </div>
    </div>

</body>

</html>
