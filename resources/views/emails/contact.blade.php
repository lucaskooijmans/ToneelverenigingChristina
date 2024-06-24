<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contactformulier inzending</title>
</head>
<body>
    <p>Naam: {{ $data['name'] }}</p>
    <p>E-mailadres: {{ $data['email'] }}</p>
    <p>Onderwerp: {{ $data['subject'] }}</p>
    <p>Bericht: {{ $data['user_message'] }}</p>
</body>
</html>