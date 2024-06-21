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

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @php
    $images = config('introImages');
    $sectionImage = $images['doneren_intro'] ?? 'default_intro.jpg';
    @endphp

    <section class="intro" style="background-image: url('{{ asset('storage/introImages/' . $sectionImage) }}');">
        <h1><strong>{!! nl2br(__("doneren-titel")) !!}</strong></h1>

        @auth
        <a href="javascript:void(0)" onclick="toggleUploadForm()" class="button green-button">Achtergrondafbeelding aanpassen</a>
        <form id="imageUploadForm" class="no-blur" action="{{ route('uploadImage') }}" method="POST" enctype="multipart/form-data" style="display:none;">
            @csrf
            <input type="hidden" name="section" value="doneren_intro">
            <input type="file" name="image" class="form-control no-blur">
            <button type="submit" class="button green-button no-blur">Upload</button>
        </form>
        @endauth

        <p>{!! nl2br(__("doneren-intro")) !!}</p>

        @auth
        <a href="{{ route('text.index') }}" class="button green-button">Tekst bewerken</a>
        @endauth
    </section>

    <div class="tabs">
        <div class="tab-list">
            <button class="tab-list__button active" data-target="donations">Goederen</button>
            <button class="tab-list__button" data-target="gelddonatie">Geld</button>
        </div>

        <div class="tab-content">
            <div id="donations" class="tab active">
                <div class="contact">


                    <div class="container">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
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
                                    <label for="state">In welke staat is uw goed: <b>*</b></label>
                                    <select id="state" name="state" required class="form-control">
                                        <option value="Nieuw">Nieuw</option>
                                        <option value="Zo goed als nieuw">Zo goed als nieuw</option>
                                        <option value="Gebruikt">Gebruikt</option>
                                        <option value="Beschadigd">Beschadigd</option>
                                    </select>
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
            </div>

            <div id="gelddonatie" class="tab">
                <div class="donationdiv">
                    <form action="{{ route('donations.prepare') }}" method="POST" class="donation-form">
                        @csrf
                        <h1>Gelddonatie</h1>
                        <div class="donation-buttons">
                            <button type="button" class="donation-button" onclick="setDonationAmount(5)">€5</button>
                            <button type="button" class="donation-button" onclick="setDonationAmount(10)">€10</button>
                            <button type="button" class="donation-button" onclick="setDonationAmount(20)">€20</button>
                            <button type="button" class="donation-button" onclick="setDonationAmount()">Kies eigen bedrag</button>
                        </div>
                        <div class="form-group">
                            <label for="donation_amount">Donatiebedrag</label>
                            <input type="number" id="donation_amount" name="donation_amount" required class="form-control" max="5000" placeholder="Vul hier het gewenste bedrag in">
                        </div>
                        <button type="submit">Doneer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleUploadForm() {
            var form = document.getElementById('imageUploadForm');
            if (form.style.display === "none") {
                form.style.display = "block";
            } else {
                form.style.display = "none";
            }
        }

        function setDonationAmount(amount) {
            document.getElementById('donation_amount').value = amount;
        }

        document.querySelectorAll('.tab-list__button').forEach(button => {
            button.addEventListener('click', () => {
                const target = button.dataset.target;
                document.querySelectorAll('.tab-list__button').forEach(btn => btn.classList.remove('active'));
                document.querySelectorAll('.tab').forEach(tab => tab.classList.remove('active'));
                button.classList.add('active');
                document.querySelector('#' + target).classList.add('active');
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var typeSelect = document.getElementById('type');
            var dateGroup = document.getElementById('date-group');
            var donationAmountInput = document.getElementById('donation_amount');
            var donationButtons = document.querySelectorAll('.donation-button');
            var donationAmountLabel = document.querySelector('label[for="donation_amount"]');

            typeSelect.addEventListener('change', function() {
                if (typeSelect.value === 'uitlenen') {
                    dateGroup.style.display = 'block';
                } else {
                    dateGroup.style.display = 'none';
                }
            });

            donationButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove highlight from all buttons
                    donationButtons.forEach(btn => btn.classList.remove('highlight'));

                    // Add highlight to the clicked button
                    this.classList.add('highlight');

                    // Hide the input bar
                    donationAmountInput.style.display = 'none';
                    donationAmountLabel.style.display = 'none';

                    // If "Kies eigen bedrag" button is clicked, show the input bar
                    if (this.textContent === 'Kies eigen bedrag') {
                        donationAmountInput.style.display = 'block';
                        donationAmountLabel.style.display = 'block';
                    }
                });
            });
        });
    </script>
</body>

</html>