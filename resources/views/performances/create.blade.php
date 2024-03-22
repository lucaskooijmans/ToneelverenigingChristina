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
            <input type="text" id="name" name="name" required><br>
            <label for="description">Beschrijving:</label><br>
            <textarea id="description" name="description"></textarea><br>
            <label for="starttime">Starttijd:</label><br>
            <input type="datetime-local" id="starttime" name="starttime" required><br>
            <label for="endtime">Eindtijd:</label><br>
            <input type="datetime-local" id="endtime" name="endtime" required><br>
            <label for="image">Afbeelding:</label><br>
            <input type="file" class="form-control" id="image" name="image" accept ="image/*" required><br>
            <label for="location">Locatie:</label><br>
            <input type="text" id="location" name="location" required><br>
            <label for="available_seats">Aantal plekken:</label><br>
            <input type="number" id="available_seats" name="available_seats" required><br>
            <label for="price">Prijs:</label><br>
            <input type="number" step="0.01" id="price" name="price" required><br>
            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
