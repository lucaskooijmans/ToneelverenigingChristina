<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creër Sponsor</title>
</head>
<body>
    <h1 style="font-family: 'Arial', sans-serif;">Creër Sponsor</h1>

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

    <form action="{{ route('sponsors.store') }}" method="post" enctype="multipart/form-data" style="max-width: 500px; margin: auto; background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-family: 'Arial', sans-serif;">
        @csrf
        <div style="margin-bottom: 20px;">
            <label for="name" style="display: block; margin-bottom: 5px;">Naam:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 20px;">
            <label for="url" style="display: block; margin-bottom: 5px;">URL naar de website:</label>
            <input type="url" id="url" name="url" value="{{ old('url') }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 20px;">
            <label for="logo" style="display: block; margin-bottom: 5px;">Foto van sponsor:</label>
            <input type="file" id="logo" name="logo" accept="image/*" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 20px;">
            <label for="category_id" style="display: block; margin-bottom: 5px;">Categorie:</label>
            <select id="category_id" name="category_id" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="">Selecteer een categorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->sponsorcategories }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Submit</button>
        </div>
    </form>

</body>
</html>