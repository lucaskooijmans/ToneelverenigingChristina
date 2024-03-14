<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Board Member</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Voeg een nieuwe bestuurslid toe</h2>
        <form action="{{ route('bestuursleden.store') }}" method="POST" enctype="multipart/form-data">
            @csrf <!-- CSRF token is required for form submissions in Laravel -->

            <div class="form-group">
                <label for="name">Naam:</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Telefoonnummer:</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <div class="form-group">
                <label for="description">Beschrijving:</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>

            <div class="form-group">
                <label for="image_url">URL naar foto:</label>
                <input type="text" class="form-control" id="image_url" name="image_url" required>
            </div>

            <button type="submit" class="btn btn-primary">Creëer</button>
        </form>
    </div>
</body>
</html>