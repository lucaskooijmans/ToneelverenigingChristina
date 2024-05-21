<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="{{ route('sponsorcategories.update', $category->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="sponsorcategories">Category Name:</label>
            <input type="text" id="sponsorcategories" name="sponsorcategories" value="{{ $category->sponsorcategories }}" required class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <form action="{{ route('sponsorcategories.destroy', $category->id) }}" method="POST"
        onsubmit="return confirm('Weet je zeker dat je deze categorie wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt.');">
        @csrf
        @method('DELETE')
        <button type="submit" class="button red-button"><i class="fas fa-trash"></i> Delete</button>
    </form>
</body>
</html>