<h1>Aanpassen</h1>

<form action="{{ route('posts.update', $post->id) }}" method="POST">
    @csrf {{-- https://laravel.com/docs/10.x/csrf --}}
    @method('PUT')
    <div class="form-group">
        <label for="title">Titel</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}" required>
    </div>
    <div class="form-group">
        <label for="content">Omschrijving</label>
        <textarea class="form-control" id="body" name="body" rows="6" required>{{ $post->body }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Aanpassen</button>
</form>
