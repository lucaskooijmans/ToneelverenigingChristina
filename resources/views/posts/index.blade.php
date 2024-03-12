<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nieuws</title>
    <script src="https://kit.fontawesome.com/2a5648d90a.js" crossorigin="anonymous" defer></script>
</head>

<body>

    <x-navbar />

    <div class="nieuws">

        <div class="container">

            <h1>Nieuws</h1>

            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('posts.create') }}" class="button">
                        <i class="fas fa-plus"></i> Toevoegen
                    </a>
                @endif
            @endauth

            @if ($posts->isEmpty())
                <p>Er is op dit moment geen nieuws...</p>
            @else
                <div class="list-group posts">
                    <div class="tree"></div>
                    @foreach ($posts as $post)
                        <div class="list-group-item post">
                            <h2>{{ $post->title }}</h2>
                            <p class="date">Aangemaakt: {{ $post->created_at->format('j-n-Y H:i') }}</p>
                            <p>{{ $post->body }}</p>
                            @auth
                                @if (auth()->user()->isAdmin())
                                    <div class="post-buttons" role="group" aria-label="Post Actions">


                                        <a href="{{ route('posts.edit', $post->id) }}">
                                            <button class="button blue-button">
                                                <i class="fas fa-pencil"></i> Aanpassen
                                            </button>
                                        </a>
                                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                            @csrf {{-- https://laravel.com/docs/10.x/csrf --}}
                                            @method('DELETE')
                                            <button type="submit" class="button red-button">
                                                <i class="fas fa-trash"></i> Verwijderen
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    @endforeach
                    <p class="tree-bottom-text">U heeft het eind van deze pagina bereikt</p>
                </div>
            @endif
        </div>

    </div>

</body>

</html>
