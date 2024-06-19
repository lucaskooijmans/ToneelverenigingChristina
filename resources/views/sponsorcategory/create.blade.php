<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creër categorie</title>
</head>

<body>
    <x-navbar />
    <div class="sponsors">
        <div class="container">

            <h1 style="font-family: 'Arial', sans-serif;">Creër Categorie</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('sponsorcategory.store') }}" method="post" enctype="multipart/form-data"
                class="post-form">
                @csrf
                <div class="form-group">
                    <label for="sponsorcategories">Naam:</label>
                    <input type="text" id="sponsorcategories" name="sponsorcategories"
                        value="{{ old('sponsorcategories') }}" required class="form-control">
                </div>
                <div>
                    <button type="submit" class="button green-button"><i class="fas fa-check"></i> Opslaan</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
