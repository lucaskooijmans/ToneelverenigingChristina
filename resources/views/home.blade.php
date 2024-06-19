<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Toneelvereniging Christina</title>
    <script src="/curtains.js" defer></script>
</head>

<body id="home">
    <x-navbar />

    <section class="hero">
        <div class="container">
            <div class="text">
                <h1>Welkom</h1>
                <p>
                    {!! nl2br(__("homepagina-intro")) !!}
                </p>

                @auth
                    <a href="{{ route('text.index') }}" class="button green-button">Tekst bewerken</a>
                @endauth
            </div>
            <img src="{{ __("image") }}" alt="Groepsfoto van de toneelvereniging.">
        </div>
    </section>

    <x-countdown />

    <x-aankondigingen />

</body>

</html>
