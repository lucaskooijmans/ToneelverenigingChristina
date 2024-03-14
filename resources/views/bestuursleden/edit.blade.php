<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Board Member</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Pas een bestuurslid aan</h2>
    <form action="{{ route('bestuursleden.update', $bestuurslid->id) }}" method="POST">
        @csrf <!-- CSRF token is required for form submissions in Laravel -->
        @method('PUT')

        <div class="form-group">
            <label for="name">Naam:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $bestuurslid->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $bestuurslid->email }}" required>
        </div>

        <div class="form-group">
            <label for="phone">Telefoonnummer:</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ $bestuurslid->phone }}" required>
        </div>

        <div class="form-group">
            <label for="description">Beschrijving:</label>
            <input class="form-control" id="description" name="description" rows="3" value="{{ $bestuurslid->description }}" required>
        </div>

        <div class="form-group">
            <label for="image_url">URL naar foto:</label>
            <input type="text" class="form-control" id="image_url" name="image_url" value="{{ $bestuurslid->image_url }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Wijzigen</button>
    </form>
</div>
</body>
</html>
