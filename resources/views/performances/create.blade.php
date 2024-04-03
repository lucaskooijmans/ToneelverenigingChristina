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
        <h1>Maak voorstelling aan</h1>

        <form method="POST" action="{{ route('performances.store') }}" enctype="multipart/form-data">
            @csrf
            <label for="name">Naam:</label><br>
            <input type="text" id="name" name="name" value="{{ old('name', $performance->name ?? '') }}" required><br>
            <label for="description">Beschrijving:</label><br>
            <textarea id="description" name="description" value="{{ old('description', $performance->description ?? '') }}"></textarea><br>
            <label for="starttime">Starttijd:</label><br>
            <input type="datetime-local" id="starttime" name="starttime" required value="{{ old('starttime', $performance->starttime ?? '') }}"><br>
            <label for="endtime">Eindtijd:</label><br>
            <input type="datetime-local" id="endtime" name="endtime" required value="{{ old('endtime', $performance->endtime ?? '') }}"><br>
            <label for="image">Afbeelding:</label><br>
            <input type="file" class="form-control" id="image" name="image" accept ="image/*"><br>
            <label for="location">Locatie:</label><br>
            <input type="text" id="location" name="location" required value="{{ old('location', $performance->location ?? '') }}"><br>
            <label for="available_seats">Aantal plekken:</label><br>
            <input type="number" id="available_seats" name="available_seats" required value="{{ old('available_seats', $performance->available_seats ?? '') }}"><br>
            <label for="price">Prijs:</label><br>
            <input type="number" step="0.01" id="price" name="price" required value="{{ old('price', $performance->price ?? '') }}"><br>
            <input type="hidden" name="edit" value="{{ $edit ?? false }}">
            <input type="hidden" name="id" value="{{ $performance->id ?? null }}">
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
