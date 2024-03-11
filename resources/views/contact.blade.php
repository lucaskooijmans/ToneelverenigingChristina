<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
</head>
<body>
    <x-navbar />

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
</body>
</html>