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
        @php
            $images = json_decode(file_get_contents(resource_path('intro.json')), true);
            $sectionImage = $images['contact_intro'] ?? 'default_intro.jpg';
        @endphp

        <section class="intro" style="background-image: url('{{ asset('storage/introImages/' . $sectionImage) }}');">
            <h1><strong>{!! nl2br(__("contact-titel")) !!}</strong></h1>

            @auth
                <a href="javascript:void(0)" onclick="toggleUploadForm()" class="button green-button">Achtergrondafbeelding aanpassen</a>
                <form id="imageUploadForm" class="no-blur" action="{{ route('uploadImage') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <input type="hidden" name="section" value="contact_intro">
                    <input type="file" name="image" class="form-control">
                    <button type="submit" class="button green-button">Upload</button>
                </form>
            @endauth

            <p>{!! nl2br(__("contact-intro")) !!}</p>

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
                    <div class="cf-turnstile" data-sitekey="{{ env('CLOUDFLARE_PUBLIC', '0x4AAAAAAAW38y6G28Abmhjw') }}"></div>
                    <div class="form-group">
                        <button type="submit" class="button green-button">Verstuur</button>
                    </div>
                    <label><b>*</b> Verplicht veld</label>
                </form>

                <div class="contact-info">

                    <div>
                        <h1>Contactgegevens</h1>
                        {!! nl2br(__('contactgegevens')) !!}
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
