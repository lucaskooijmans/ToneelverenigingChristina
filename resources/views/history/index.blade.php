<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historie</title>
</head>

<body>

    <x-navbar />

    <div class="historie">
        @php
            $images = config('introImages');
            $sectionImage = $images['historie_intro'] ?? 'default_intro.jpg';
        @endphp

        <section class="intro" style="background-image: url('{{ asset('storage/introImages/' . $sectionImage) }}');">
            <h1><strong>{!! nl2br(__("historie-titel")) !!}</strong></h1>

            @auth
                <a href="javascript:void(0)" onclick="toggleUploadForm()" class="button green-button">Achtergrondafbeelding aanpassen</a>
                <form id="imageUploadForm" class="no-blur" action="{{ route('uploadImage') }}" method="POST" enctype="multipart/form-data" style="display:none;">
                    @csrf
                    <input type="hidden" name="section" value="historie_intro">
                    <input type="file" name="image" class="form-control">
                    <button type="submit" class="button green-button">Upload</button>
                </form>
            @endauth

            <p>{!! nl2br(__("historie-intro")) !!}</p>

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
            @if (Gate::allows('isAdmin'))
                <a href="{{ route('history.create') }}" class="add-item button"><i class="fas fa-plus"></i> Toevoegen</a>
            @endif
            <div class="split">

                <div class="section">
                    <h1>Onze bijdragen</h1>
                    @foreach ($historyItems as $history)
                        @if ($history->contribution)
                            <x-history_item :historyItem="$history" />
                        @endif
                    @endforeach
                </div>

                <div class="section">
                    <h1>Historie</h1>
                    @foreach ($historyItems as $history)
                        @if (!$history->contribution)
                            <x-history_item :historyItem="$history" />
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

    </div>

</body>

</html>
