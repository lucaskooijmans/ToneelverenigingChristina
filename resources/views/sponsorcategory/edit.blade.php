<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <x-navbar />
    <div class="container">
        <div class="sponsors">

            <h1>Sponsor Categorie Bewerken</h1>

            <form action="{{ route('sponsorcategories.update', $category->id) }}" method="post" class="post-form">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="sponsorcategories">Category Name:</label>
                    <input type="text" id="sponsorcategories" name="sponsorcategories"
                        value="{{ $category->sponsorcategories }}" required class="form-control">
                </div>
                <div class="post-buttons">
                    <button type="submit" class="button blue-button"><i class="fas fa-save"></i> Bijwerken</button>
            </form>

            <form action="{{ route('sponsorcategories.destroy', $category->id) }}" method="POST"
                onsubmit="return confirm('Weet je zeker dat je deze categorie wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="button red-button"><i class="fas fa-trash"></i> Verwijderen</button>
            </form>
        </div>
    </div>
    </div>
</body>

</html>
