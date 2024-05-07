<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Board Member</title>
</head>

<body>
    <x-navbar />
    <div class="bestuursleden">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <h1>Pas een bestuurslid aan</h1>
            <form action="{{ route('boardmembers.update', $bestuurslid->id) }}" method="POST" class="post-form" enctype="multipart/form-data">
                @csrf 
                @method('PUT')
                <div class="form-group">
                    <label for="name">Naam:</label>
                    <input type="text" class="form-control" id="name" name="name"
                        value="{{ $bestuurslid->name }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email"
                        value="{{ $bestuurslid->email }}" required>
                </div>

                <div class="form-group">
                    <label for="phone">Telefoonnummer:</label>
                    <input type="text" class="form-control" id="phone" name="phone"
                        value="{{ $bestuurslid->phone }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Beschrijving:</label>
                    <input class="form-control" id="description" name="description" rows="3"
                        value="{{ $bestuurslid->description }}" required>
                </div>

                <div class="form-group">
                    <label for="image">Foto uploaden:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <button type="submit" class="button green-button"><i class="fas fa-save"></i> Wijzigen</button>
            </form>
        </div>
    </div>
</body>

</html>
