<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voorstelling aanmaken</title>
</head>

<body>
    <x-navbar />
    <div class="performances">

        <div class="container">

            <h1>Maak voorstelling aan</h1>

            <form class="post-form" method="POST" action="{{ route('performances.store') }}" enctype="multipart/form-data">
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
                @csrf
                <div class="form-group">
                    <label for="name">Naam:</label>
                    <input type="text" id="name" name="name" class="form-control"
                        value="{{ old('name', $performance->name ?? '') }}" required>
                </div>
                <div class="form-group">
                    <label for="description">Beschrijving:</label>
                    <textarea id="description" name="description" class="form-control">{{ old('description', $performance->description ?? '') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="starttime">Starttijd:</label>
                    <input type="datetime-local" id="starttime" name="starttime" required class="form-control"
                        value="{{ old('starttime', $performance->starttime ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="endtime">Eindtijd:</label>
                    <input type="datetime-local" id="endtime" name="endtime" required class="form-control"
                        value="{{ old('endtime', $performance->endtime ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="image">Afbeelding:</label>
                    <input type="file" class="form-control" id="image" name="image" class="form-control"
                        accept ="image/*">
                </div>
                <div class="form-group">
                    <label for="location">Locatie:</label>
                    <input type="text" id="location" name="location" class="form-control"
                        value="{{ old('location', $performance->location ?? 'Dorpshuis de Rozenhoek') }}"
                        placeholder="Laat leeg voor 'Dorpshuis de Rozenhoek'">
                </div>
                <div class="form-group">
                    <label for="available_seats">Aantal plekken:</label>
                    <input type="number" id="available_seats" name="available_seats" required class="form-control"
                        value="{{ old('available_seats', $performance->available_seats ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="price">Prijs:</label>
                    <input type="number" step="0.01" id="price" name="price" required class="form-control"
                        value="{{ old('price', $performance->price ?? '') }}" min="0">
                </div>
                <div class="form-group">
                    <label for="location_embed">Locatie:</label>
                    <input type="text" id="location_embed" name="location_embed" class="form-control"
                        value="{{ old('location_embed', $performance->location_embed ?? '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d217.3498098737098!2d5.327337745359679!3d51.95160077772477!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c6592dd4cbe6a1%3A0xa592b7f9668a192b!2sDe%20Rozenhoek!5e0!3m2!1snl!2snl!4v1718289897215!5m2!1snl!2snl" width="800" height="600" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>') }}">
                </div>
                <input type="hidden" name="edit" value="{{ $edit ?? false }}">
                <input type="hidden" name="id" value="{{ $performance->id ?? null }}">
                <button type="submit" class="button green-button"><i class="fas fa-check"></i> Opslaan</button>
            </form>
        </div>
    </div>
</body>

</html>
