<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voorstellingen</title>
</head>

<body>
    <x-navbar />
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

    
    <div class="performances">
    @php
            $images = json_decode(file_get_contents(resource_path('intro.json')), true);
            $sectionImage = $images['voorstellingen_overzicht_intro'] ?? 'default_intro.jpg';
        @endphp

        <section class="intro" style="background-image: url('{{ asset('storage/introImages/' . $sectionImage) }}');">
            <h1><strong>{!! nl2br(__("voorstellingen-overzicht-titel")) !!}</strong></h1>

            @auth
                <a href="javascript:void(0)" onclick="toggleUploadForm()" class="button green-button">Achtergrondafbeelding aanpassen</a>
                <form id="imageUploadForm" class="no-blur" action="{{ route('uploadImage') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <input type="hidden" name="section" value="voorstellingen_overzicht_intro">
                    <input type="file" name="image" class="form-control">
                    <button type="submit" class="button green-button">Upload</button>
                </form>
            @endauth

            <p>{!! nl2br(__("voorstellingen-overzicht-intro")) !!}</p>

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
                    <a href="{{ route('performances.create') }}" class="button" tabindex="0">
                        <i class="fas fa-plus"></i> Toevoegen
                    </a>
                @endif
            @endauth

            <div class="performance-items-container">
                @foreach ($performances as $performance)
                    <x-performance_item :performanceItem="$performance" />
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
