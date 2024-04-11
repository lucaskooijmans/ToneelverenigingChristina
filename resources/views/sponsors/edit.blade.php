<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Bewerk Sponsor</title>
    </head>
    <body>
        <x-navbar />
        <div class="sponsors">
            <div class="container">

                <h1>Bewerk Sponsor</h1>

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

                <form action="{{ route('sponsors.update', $sponsor->id) }}" method="post" enctype="multipart/form-data"
                    class="post-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name" style="display: block; margin-bottom: 5px;">Naam:</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $sponsor->name) }}"
                            required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="url" style="display: block; margin-bottom: 5px;">URL naar de website:</label>
                        <input type="url" id="url" name="url" value="{{ old('url', $sponsor->url) }}"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="logo" style="display: block; margin-bottom: 5px;">Foto van sponsor:</label>
                        <input type="file" id="logo" name="logo" accept="image/*" class="form-control">
                        @if ($sponsor->logo)
                            <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="Current Logo"
                                style="max-width: 100px; margin-top: 10px;">
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="isActive" value="0">
                        <label for="isActive">Is sponsor?</label>
                        <input type="checkbox" id="isActive" name="isActive" value="1"
                            {{ $sponsor->isActive ? 'checked' : '' }}>
                    </div>
                    <div class="post-buttons">
                        <button type="submit" class="button green-button"><i class="fas fa-save"></i> Bijwerken</button>
                        <button type="button" onclick="window.history.back();" class="button gray-button"><i class="fas fa-times"></i> Annuleren</button>
                    </div>
                </form>
                <form action="{{ route('sponsors.destroy', $sponsor->id) }}" method="POST"
                    onsubmit="return confirm('Weet u zeker dat u deze sponsor wilt verwijderen? Deze actie kan niet ongedaan gemaakt worden.');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="button red-button"><i class="fas fa-trash"></i> Verwijderen</button>
                </form>
            </div>
        </div>
    </body>
</html>
