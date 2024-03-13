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
        @foreach ($bestuursleden as $bestuurslid)
            

            <div class="member-card">
                <div class="member-image">
                    <img src="{{ $bestuurslid->image_url }}" alt="Board Member">
                </div>
                <h3>{{ $bestuurslid->name }}</h3>
                <p>Email: {{ $bestuurslid->email }}</p>
                <p>Telefoonnummer: {{ $bestuurslid->phone }}</p>
                <p>Beschrijving: {{ $bestuurslid->description }}</p>

                <!-- Delete button -->
                <form action="{{ route('bestuursleden.destroy', $bestuurslid->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" onclick="return confirm('Weet je zeker dat je dit bestuurslid wilt verwijderen?')">Verwijder</button>
                </form>
            </div>
        @endforeach
        <a href="{{ route('bestuursleden.create') }}" class="btn btn-success mb-2">Nieuwe toevoegen</a>
    </div>
</body>
</html>
