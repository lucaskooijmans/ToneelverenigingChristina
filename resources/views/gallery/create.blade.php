<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Foto toevoegen</title>
    <script src="https://kit.fontawesome.com/2a5648d90a.js" crossorigin="anonymous" defer></script>
</head>

<body>

    <x-navbar />

    <div class="gallery">

        <h1>Foto toevoegen</h1>

        <form action="{{ route('gallery.store') }}" method="POST" class="post-form" enctype="multipart/form-data">
            @csrf {{-- https://laravel.com/docs/10.x/csrf --}}
            <div class="form-group">
                <label for="image">Afbeelding</label>
                <input type="file" class="form-control" id="image" name="image" accept ="image/*" required >
            </div>

            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Beschrijving</label>
                <textarea class="form-control" id="description" name="description" rows="6" required></textarea>
            </div>
            <button type="submit" class="button green-button"><i class="fas fa-check"></i> Toevoegen</button>
        </form>

    </div>

</body>

</html>