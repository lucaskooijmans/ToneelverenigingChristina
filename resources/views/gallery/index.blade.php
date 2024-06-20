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
    @php
            $images = config('introImages');
            $sectionImage = $images['galerij_intro'] ?? 'default_intro.jpg';
        @endphp

        <section class="intro" style="background-image: url('{{ asset('storage/introImages/' . $sectionImage) }}');">
            <h1><strong>{!! nl2br(__("galerij-titel")) !!}</strong></h1>

            @auth
                <a href="javascript:void(0)" onclick="toggleUploadForm()" class="button green-button">Achtergrondafbeelding aanpassen</a>
                <form id="imageUploadForm" class="no-blur" action="{{ route('uploadImage') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <input type="hidden" name="section" value="galerij_intro">
                    <input type="file" name="image" class="form-control">
                    <button type="submit" class="button green-button">Upload</button>
                </form>
            @endauth

            <p>{!! nl2br(__("galerij-intro")) !!}</p>

            @auth
                <a href="{{ route('text.index') }}" class="button green-button">Tekst bewerken</a>
            @endauth
        </section>

        <script>
            function toggleUploadForm() {
                var form = document.getElementById('imageUploadForm');
                if (form.style.display === "none") {
                    form.style.display = "block";
                } else {
                    form.style.display = "none";
                }
            }
        </script>
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