<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bewerk Sponsor</title>
</head>
<body>
    <h1 style="font-family: 'Arial', sans-serif;">Bewerk Sponsor</h1>

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

    <form action="{{ route('sponsors.update', $sponsor->id) }}" method="post" enctype="multipart/form-data" style="max-width: 500px; margin: auto; background: #f9f9f9; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); font-family: 'Arial', sans-serif;">
        @csrf
        @method('PUT') <!-- Important: Specify the method as PUT -->
        <div style="margin-bottom: 20px;">
            <label for="name" style="display: block; margin-bottom: 5px;">Naam:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $sponsor->name) }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 20px;">
            <label for="url" style="display: block; margin-bottom: 5px;">URL naar de website:</label>
            <input type="url" id="url" name="url" value="{{ old('url', $sponsor->url) }}" required style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 20px;">
            <label for="logo" style="display: block; margin-bottom: 5px;">Foto van sponsor:</label>
            <input type="file" id="logo" name="logo" accept="image/*" style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
            @if($sponsor->logo)
                <img src="{{ asset('storage/'.$sponsor->logo) }}" alt="Current Logo" style="max-width: 100px; margin-top: 10px;">
            @endif
        </div>
        <div style="margin-bottom: 20px;">
            <input type="hidden" name="isActive" value="0">
            <input type="checkbox" id="isActive" name="isActive" value="1" {{ $sponsor->isActive ? 'checked' : '' }}>
            <label for="isActive">Is sponsor?</label>
        </div>
        <div>
            <button type="submit" style="padding: 10px 15px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Update</button>
        </div>
    </form>
    <form action="{{ route('sponsors.destroy', $sponsor->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this sponsor? This action cannot be undone.');">
        @csrf
        @method('DELETE')
        <button type="submit" style="padding: 10px 15px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer;">Delete Sponsor</button>
    </form>

</body>
</html>
