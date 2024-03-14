<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nieuwsitem aanpassen</title>
</head>

<body>

    <x-navbar />

    <div class="nieuws">

        <h1>Aanpassen</h1>

        <form action="{{ route('posts.update', $post->id) }}" method="POST" class="post-form">
            @csrf {{-- https://laravel.com/docs/10.x/csrf --}}
            @method('PUT')
            <div class="form-group">
                <label for="title">Titel</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}"
                    required>
            </div>
            <div class="form-group">
                <label for="content">Omschrijving</label>
                <textarea class="form-control" id="body" name="body" rows="6" required>{{ $post->body }}</textarea>
            </div>
            <button type="submit" class="button green-button"><i class="fas fa-check"></i> Aanpassen</button>
        </form>

    </div>

</body>

</html>
