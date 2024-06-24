<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nieuws</title>
</head>

<body>

    <x-navbar />

    <div class="nieuws">
        @php
            $images = json_decode(file_get_contents(resource_path('intro.json')), true);
            $sectionImage = $images['nieuws_intro'] ?? 'default_intro.jpg';
        @endphp

        <section class="intro" style="background-image: url('{{ asset('storage/introImages/' . $sectionImage) }}');">
            <h1><strong>{!! nl2br(__("nieuws-titel")) !!}</strong></h1>

            @auth
                <a href="javascript:void(0)" onclick="toggleUploadForm()" class="button green-button">Achtergrondafbeelding aanpassen</a>
                <form id="imageUploadForm" class="no-blur" action="{{ route('uploadImage') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <input type="hidden" name="section" value="nieuws_intro">
                    <input type="file" name="image" class="form-control">
                    <button type="submit" class="button green-button">Upload</button>
                </form>
            @endauth

            <p>{!! nl2br(__("nieuws-intro")) !!}</p>

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
                    <a href="{{ route('posts.create') }}" class="button">
                        <i class="fas fa-plus"></i> Toevoegen
                    </a>
                @endif
            @endauth

            @if ($posts->isEmpty())
                <p>Er is op dit moment geen nieuws...</p>
            @else
                <div class="list-group posts">
                    @foreach ($posts as $post)
                        <div class="list-group-item post">
                            <div class="post-content">
                                <h2>{{ $post->title }}</h2>
                                <p class="date">Aangemaakt: {{ $post->created_at->format('j-n-Y H:i') }}</p>
                                <p>{!! nl2br($post->body) !!}</p>
                            </div>
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
