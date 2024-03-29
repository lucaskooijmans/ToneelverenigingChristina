<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Sponsor</title>
</head>
<body>
    <h1>Edit Sponsor</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('sponsors.update', $sponsor->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ $sponsor->name }}" required>
        </div>
        <div>
            <label for="url">URL:</label>
            <input type="url" id="url" name="url" value="{{ $sponsor->url }}" required>
        </div>
        <div>
            <label for="photo">Photo:</label>
            <input type="file" id="photo" name="photo" accept="image/*">
            <img src="{{ asset($sponsor->photo_path) }}" alt="Sponsor Photo" style="max-width: 200px;">
        </div>
        <div>
            <button type="submit">Update</button>
        </div>
    </form>
</body>
</html>