<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nieuwsitem aanmaken</title>
</head>

<body>

    <x-navbar />

    <div class="nieuws">

        <h1>Toevoegen</h1>

        <form action="{{ route('posts.store') }}" method="POST" class="post-form">
            @csrf {{-- https://laravel.com/docs/10.x/csrf --}}
            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" class="form-control" id="title" name="title">
                @error('title')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Omschrijving</label>
                <textarea class="form-control" id="body" name="body" rows="6"></textarea>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit" class="button green-button"><i class="fas fa-check"></i> Toevoegen</button>
        </form>

    </div>

</body>

</html>
