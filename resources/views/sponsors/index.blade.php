<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alle Sponsors</title>
    <style>
        .sponsors-list {
            display: flex;
            flex-wrap: wrap;
            gap: 20px; /* Space between sponsors */
        }
        .sponsor-photo {
            border: 2px solid black;
            padding: 5px;
            display: inline-block;
            max-width: 200px;
        }
    </style>
</head>
<body>
    <h1>Alle Sponsors</h1>

    <div class="sponsors-list">
        @foreach($sponsors as $sponsor)
            <a href="{{ route('sponsors.show', $sponsor->id) }}" class="sponsor-photo">
                <img src="{{ asset($sponsor->photo_path) }}" alt="{{ $sponsor->name }}">
            </a>
        @endforeach
    </div>
    <a href="{{ route('sponsors.create') }}" class="btn btn-primary">Create Sponsor</a>

</body>
</html>