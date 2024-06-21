<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Board Member</title>
</head>

<body>
    <x-navbar />
    <div class="bestuursleden">
        <div class="container">

            <h1>Voeg een nieuwe bestuurslid toe</h1>
            <form action="{{ route('boardmembers.store') }}" method="POST" enctype="multipart/form-data"
                class="post-form">
                @csrf <!-- CSRF token is required for form submissions in Laravel -->

                <div class="form-group">
                    <label for="name">Naam: <b>*</b></label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email: <b>*</b> </label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Telefoonnummer: </label>
                    <input type="text" class="form-control" id="phone" name="phone">
                </div>

                <div class="form-group">
                    <label for="description">Beschrijving: <b>*</b></label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="image">Foto uploaden: <b>*</b></label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/png, image/jpeg, image/jpg" required>
                    @error('image')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <label><b>*</b> Verplicht veld</label>

                <button type="submit" class="button green-button"><i class="fas fa-check"></i> Toevoegen</button>
            </form>
        </div>
    </div>

</body>

</html>
