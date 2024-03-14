<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
    <x-navbar />

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    <form method="POST" action="{{ route('contact.submit') }}">
        @csrf
        <div>
            <label for="name">*Naam:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">*Uw e-mailadres:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="subject">Onderwerp:</label>
            <input type="text" id="subject" name="subject">
        </div>
        <div>
            <label for="message">Bericht:</label>
            <textarea id="message" name="message"></textarea>
        </div>
        <div>
            <button type="submit">Verstuur</button>
        </div>
    </form>

    <div>
         <h1>Contact gegevens</h1></br>
         <label>Email</label></br>
         <label>toneelverenigingchristina@gmail.com</label>
     </div>
     <div>
         <label>Telefoonnummer<label></br>
         <label>06-36176711<label>
     </div>

     <div>
         <h1>FAQ</h1></br>
         <label>Vraag 1....</label></br>
         <label>Antwoord 1.....</label>
     </div>
     <div>
         <label>Vraag 2....</label></br>
         <label>Antwoord 2.....</label>
     </div>
     <div>
         <label>Vraag 3....</label></br>
         <label>Antwoord 3.....</label>
     </div>
</body>
</html>
