<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Sponsor</title>
    <style>
        .sponsor-photo {
            border: 2px solid black;
            padding: 5px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <h1>{{ $sponsor->name }}</h1>

    <a href="{{ $sponsor->url }}" target="_blank" class="sponsor-photo">
        <img src="{{ asset($sponsor->photo_path) }}" alt="{{ $sponsor->name }}" style="max-width: 200px;">
    </a>
</body>
</html>