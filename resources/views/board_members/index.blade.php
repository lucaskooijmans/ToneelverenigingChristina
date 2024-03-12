<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestuurleden</title>
    <link href="/css/style.css" rel="stylesheet">
</head>
<body>
    <div class="grid-container">
        @foreach ($boardMembers as $member)
            <div class="member-card">
                <div class="member-image">
                    <img src="{{ $member->image_url }}" alt="Board Member">
                </div>
                <h3>{{ $member->name }}</h3>
                <p>Email: {{ $member->email }}</p>
                <p>Telefoonnummer: {{ $member->phone }}</p>
                <p>Beschrijving: {{ $member->description }}</p>
            </div>
        @endforeach
    </div>
</body>
</html>
