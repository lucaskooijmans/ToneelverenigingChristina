<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Afbeelding aanpassen</title>
    <script src="https://kit.fontawesome.com/2a5648d90a.js" crossorigin="anonymous" defer></script>
</head>

<body>

    <x-navbar />

    <div class="afbeelding">

        <h1>Afbeelding aanpassen</h1>

        <form action="{{ route('gallery.update', $photo->id) }}" method="POST" class="image-form">
            @csrf {{-- https://laravel.com/docs/10.x/csrf --}}
            @method('PUT')
            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $photo->title }}"
                    required>
            </div>
            <div class="form-group">
                <label for="description">Beschrijving</label>
                <textarea class="form-control" id="description" name="description" rows="6"
                    required>{{ $photo->description }}</textarea>
            </div>
            <button type="submit" class="button green-button"><i class="fas fa-check"></i> Aanpassen</button>
        </form>

    </div>

</body>

</html>