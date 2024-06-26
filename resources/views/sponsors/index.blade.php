<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alle Sponsors</title>
    @if (auth()->check() && auth()->user()->isAdmin())
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="{{ asset('js/sponsor-sortable.js') }}"></script>
    @else
        <script src="/minimizeCategories.js"></script>
    @endif
</head>

<body>
    <x-navbar />
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="sponsors">
        @php
            $images = json_decode(file_get_contents(resource_path('intro.json')), true);
            $sectionImage = $images['sponsoren_intro'] ?? 'default_intro.jpg';
        @endphp

        <section class="intro" style="background-image: url('{{ asset('storage/introImages/' . $sectionImage) }}');">
            <h1><strong>{!! nl2br(__("sponsoren-titel")) !!}</strong></h1>

            @auth
                <a href="javascript:void(0)" onclick="toggleUploadForm()" class="button green-button">Achtergrondafbeelding aanpassen</a>
                <form id="imageUploadForm" class="no-blur" action="{{ route('uploadImage') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <input type="hidden" name="section" value="sponsoren_intro">
                    <input type="file" name="image" class="form-control">
                    <button type="submit" class="button green-button">Upload</button>
                </form>
            @endauth

            <p>{!! nl2br(__("sponsoren-intro")) !!}</p>

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
                    <div class="post-buttons">
                        <a href="{{ route('sponsors.create') }}" class="button"><i class="fas fa-plus"></i> Sponsor
                            toevoegen</a>
                        <a href="{{ route('sponsorcategory.create') }}" class="button"><i class="fas fa-plus"></i> Categorie
                            toevoegen</a>
                    </div>
                @endif
            @endauth
            <div class="post-buttons">
                @foreach ($categories as $category)
                    <div class="button">
                        <a href="#{{ $category->id }}" class="category-button">{{ $category->sponsorcategories }}</a>
                        @auth
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('sponsorcategories.edit', $category->id) }}" class="button blue-button">
                                    <i class="fas fa-pencil"></i>
                                </a>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
            <div class="sponsors-list">
                @foreach ($categories as $category)
                    <div class="category-group" data-open='true' onclick="javascript:toggleOpen(this)">
                        <h2 class="@auth admin @endauth">{{ $category->sponsorcategories }}</h2>
                        <div class="category" data-category-id="{{ $category->id }}">
                            <div id="{{ $category->id }}" class="anchor"></div>
                            @foreach ($category->sponsors as $sponsor)
                                <div class="sponsor @auth @if (auth()->user()->isAdmin()) admin @endif @if(!$sponsor->isActive) inactive @endif @endauth"
                                    data-sponsor-id="{{ $sponsor->id }}"
                                    style="margin: 10px; text-align: center; flex: 0 1 auto;">
                                    <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}"
                                        style="width: 150px; height: 150px; border: 1px solid #ddd; border-radius: 4px; padding: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    <div style="margin-top: 10px;">
                                        <strong
                                            style="display: block; margin-bottom: 5px;">{{ $sponsor->name }}</strong>
                                        <a href="{{ $sponsor->url }}"
                                            style="color: #007bff; text-decoration: none; font-size: 14px;"
                                            target="_blank">Website</a>

                                        @auth
                                            @if (auth()->user()->isAdmin())
                                                <a href="{{ route('sponsors.edit', $sponsor->id) }}"
                                                    class="button blue-button"><i class="fas fa-pencil"></i> Bijwerken</a>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



</body>

</html>
