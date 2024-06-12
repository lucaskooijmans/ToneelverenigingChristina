<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Fotogalerij</title>
    <script src="https://kit.fontawesome.com/2a5648d90a.js" crossorigin="anonymous" defer></script>
</head>

<body>

    <x-navbar />

    <div class="gallery">
        <section class="intro">
            <h1>Fotogalerij</h1>
            <p>Hier staan de beste vastgelegde momenten van de toneelvereniging.</p>
        </section>
        <div class="container">
            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('gallery.create') }}" class="button">
                        <i class="fas fa-plus"></i> Foto toevoegen
                    </a>
                @endif
            @endauth

            @if ($photos->isEmpty())
                <p>Geen foto's beschikbaar op dit moment...</p>
            @else
                <div class="photo-grid">
                    @foreach ($photos as $photo)
                        <div class="photo-item">
                            <img src="{{ asset('storage/' . $photo->image) }}">
                            <h2>{{ $photo->title }}</h2>
                            <p>{{ $photo->description }}</p>
                            @auth
                                @if (auth()->user()->isAdmin())
                                    <div class="post-buttons" role="group" aria-label="Post Actions">

                                        <a href="{{ route('gallery.edit', $photo->id) }}">
                                            <button class="button blue-button">
                                                <i class="fas fa-pencil"></i> Aanpassen
                                            </button>
                                        </a>

                                        <form action="{{ route('gallery.destroy', $photo->id) }}" method="POST">
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
                            <div class="popup-image">
                                        <span>&times;</span>
                                        <img src="{{ asset('storage/' . $photo->image) }}">
                                    </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

</body>

<script>
    document.querySelectorAll('.photo-grid img').forEach(image => {
        image.onclick = () => {
            document.querySelector('.popup-image').style.display = 'block';
            document.querySelector('.popup-image img').src = image.getAttribute('src');
        }
    });

    document.querySelector('.popup-image span').onclick = () => {
        document.querySelector('.popup-image').style.display = 'none';
    }
</script>

</html>