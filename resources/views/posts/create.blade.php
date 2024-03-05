<h1>Toevoegen</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf {{-- https://laravel.com/docs/10.x/csrf --}}
    <div class="form-group">
        <label for="title">Titel</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="content">Omschrijving</label>
        <textarea class="form-control" id="body" name="body" rows="6" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Toevoegen</button>
</form>
