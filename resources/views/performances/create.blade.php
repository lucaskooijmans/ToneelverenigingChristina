<!DOCTYPE html>
<html lang="en">

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
                    <input type="file" class="form-control" id="image" name="image" class="form-control" accept ="image/*">
                </div>
                <div class="form-group">
                    <label for="location">Locatie:</label>
                    <input type="text" id="location" name="location" required class="form-control"
                    value="{{ old('location', $performance->location ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="available_seats">Aantal plekken:</label>
                    <input type="number" id="available_seats" name="available_seats" required class="form-control"
                        value="{{ old('available_seats', $performance->available_seats ?? '') }}">
                </div>
                <div class="form-group">
                    <label for="price">Prijs:</label>
                    <input type="number" step="0.01" id="price" name="price" required class="form-control"
                        value="{{ old('price', $performance->price ?? '') }}">
                </div>
                <input type="hidden" name="edit" value="{{ $edit ?? false }}">
                <input type="hidden" name="id" value="{{ $performance->id ?? null }}">
                <button type="submit" class="button green-button"><i class="fas fa-check"></i> Toevoegen</button>
            </form>
        </div>
    </div>
</body>

</html>
