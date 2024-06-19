<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</head>

<body>
    <x-navbar />

    <div class="contact">

        <div class="container">

            <h1>
                Contact
            </h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="contact-split">

                <form method="POST" action="{{ route('contact.submit') }}" class="contact-form">
                    @csrf
                    <div class="form-group">
                        <label for="name">Naam: <b>*</b></label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Uw e-mailadres: <b>*</b></label>
                        <input type="email" id="email" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Onderwerp:</label>
                        <input type="text" id="subject" name="subject" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="message">Bericht:</label>
                        <textarea id="message" name="message" class="form-control"></textarea>
                    </div>
                    <div class="cf-turnstile" data-sitekey="{{ env('CLOUDFLARE_PUBLIC', '') }}"></div>
                    <div class="form-group">
                        <button type="submit" class="button green-button">Verstuur</button>
                    </div>
                    <label><b>*</b> Verplicht veld</label>
                </form>

                <div class="contact-info">

                    <div>
                        <h1>Contactgegevens</h1></br>
                        <label>Email</label></br>
                        <label>toneelverenigingchristina@gmail.com</label>
                    </div>
                    <div>
                        <label>Telefoonnummer<label></br>
                                <label>06-36176711<label>
                    </div>

                    <div class="FAQ">
                        <h1>FAQ</h1>
                        {!! nl2br(__('faq')) !!}
                    </div>
                    @auth
                        <a href="{{ route('text.index') }}" class="button green-button">Tekst bewerken</a>
                    @endauth
                </div>

            </div>
        </div>
    </div>
</body>

</html>
