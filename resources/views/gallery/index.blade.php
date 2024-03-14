<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Photo Gallery</title>
    <script src="https://kit.fontawesome.com/2a5648d90a.js" crossorigin="anonymous" defer></script>
</head>

<body>

    <x-navbar />

    <div class="gallery">

        <div class="container">

            <h1>Photo Gallery</h1>

            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('gallery.create') }}" class="button">
                        <i class="fas fa-plus"></i> Add Photo
                    </a>
                @endif
            @endauth

            @if ($photos->isEmpty())
                <p>No photos available at the moment...</p>
            @else
                <div class="photo-grid">
                    @foreach ($photos as $photo)
                        <div class="photo-item">
                            <img src="{{ asset('storage/' . $photo->image) }}">
                            <h2>{{ $photo->title }}</h2>
                            <p>{{ $photo->description }}</p>
                        </div>
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
                                    <div class="popup-image">
                                        <span>&times;</span>
                                        <img src="{{ asset('storage/' . $photo->image) }}">
                                    </div>
                                @endif
                            @endauth
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