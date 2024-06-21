<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bestuursleden</title>
    <script src="https://kit.fontawesome.com/2a5648d90a.js" crossorigin="anonymous" defer></script>
</head>

<body>

    <x-navbar />

    <div class="bestuursleden">
        @php
            $images = json_decode(file_get_contents(resource_path('intro.json')), true);
            $sectionImage = $images['bestuursleden_intro'] ?? 'default_intro.jpg';
        @endphp

        <section class="intro" style="background-image: url('{{ asset('storage/introImages/' . $sectionImage) }}');">
            <h1><strong>{!! nl2br(__("bestuursleden-titel")) !!}</strong></h1>

            @auth
                <a href="javascript:void(0)" onclick="toggleUploadForm()" class="button green-button">Achtergrondafbeelding aanpassen</a>
                <form id="imageUploadForm" class="no-blur" action="{{ route('uploadImage') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <input type="hidden" name="section" value="bestuursleden_intro">
                    <input type="file" name="image" class="form-control">
                    <button type="submit" class="button green-button">Upload</button>
                </form>
            @endauth

            <p>{!! nl2br(__("bestuursleden-intro")) !!}</p>

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

            <div class="bestuursleden-intro">
                <img src="/images/bestuur.jpg" alt="Foto van de bestuursleden van Toneelvereniging Christina">
                <p>
                    {!! nl2br(__('bestuursleden-blok-intro')) !!}
                    @auth
                        <a href="{{ route('text.index') }}" class="button green-button">Tekst bewerken</a>
                    @endauth
                </p>
            </div>

            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('boardmembers.create') }}"><button class="button"><i class="fas fa-plus"></i>
                            Toevoegen</button></a>
                @endif
            @endauth

            @if ($bestuursleden->isEmpty())
                <p>Er zijn op dit moment geen bestuursleden...</p>
            @else
                <div class="list-group boardmembers">
                    @foreach ($bestuursleden as $bestuurslid)
                        <div class="member-card">
                            <div class="member">
                                <div class="member-image">
                                    <img src="{{ asset('storage/' . $bestuurslid->image_url) }}" width="200"
                                        height="200" alt="Bestuurslid">
                                </div>
                                <h3><strong>{{ $bestuurslid->name }}</strong></h3>
                                <p><strong>Email:</strong> {{ $bestuurslid->email }}</p>
                                <p><strong>Telefoonnummer:</strong> {{ $bestuurslid->phone }}</p>
                            </div>
                            <div class="info">
                                <p>{!! nl2br($bestuurslid->description) !!}</p>
                                <div class="post-buttons">
                                </div>
                                @auth
                                    @if (auth()->user()->isAdmin())
                                        <div class="post-buttons">
                                            <a href="{{ route('boardmembers.edit', $bestuurslid->id) }}"><button
                                                    class="button blue-button"><i class="fas fa-pencil"></i>
                                                    Edit</button></a>
                                            <form action="{{ route('boardmembers.destroy', $bestuurslid->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button red-button"><i
                                                        class="fas fa-trash"></i>
                                                    Delete</button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

    </div>

</body>

</html>
