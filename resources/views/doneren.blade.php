<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Goederen Donatie</title>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</head>

<body>
    <x-navbar />

    <div class="contact">

        <div class="container">

            <h1>
                Goederen Doneren
            </h1>

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="contact-split">

                <form method="POST" action="{{ route('doneren.submit') }}" class="contact-form" enctype="multipart/form-data">
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
                        <label for="image">Foto van het goed: <b>*</b></label>
                        <input type="file" id="image" name="image" accept="image/*" required class="form-control" required>
                    </div>
                    <div class="form-group">
                    <label for="type">Wil je het goed uitlenen of doneren</label>
                        <select id="type" name="type" required class="form-control">
                            <option value="doneren">Doneren</option>
                            <option value="uitlenen">Uitlenen</option>
                        </select>
                    </div>
                    <div class="form-group" id="date-group" style="display: none;">
                        <label for="date">Tot wanneer wil je het uitlenen?</label>
                        <input type="date" id="date" name="date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="state">In welke staat is uw goed:</label>
                        <input id="state" name="state" class="form-control"></input>
                    </div>
                    <div class="form-group">
                        <label for="message">Bericht:</label>
                        <textarea id="message" name="message" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="button green-button">Verstuur</button>
                    </div>
                    <label><b>*</b> Verplicht veld</label>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var typeSelect = document.getElementById('type');
            var dateGroup = document.getElementById('date-group');

            typeSelect.addEventListener('change', function() {
                if (typeSelect.value === 'uitlenen') {
                    dateGroup.style.display = 'block';
                } else {
                    dateGroup.style.display = 'none';
                }
            });
        });
    </script>
</body>

</html>
