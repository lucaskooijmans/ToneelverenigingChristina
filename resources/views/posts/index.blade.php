<h1>Nieuws</h1>

@auth
    @if (auth()->user()->isAdmin())
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Toevoegen</a>
    @endif
@endauth

@if($posts->isEmpty())
    <p>Er is op dit moment geen nieuws...</p>
@else
    <ul class="list-group">
        @foreach($posts as $post)
            <li class="list-group-item">
                <h2>{{ $post->title }}</h2>
                <p>Aangemaakt: {{ $post->created_at->format('j-n-Y H:i') }}</p>
                <p>{{ $post->body }}</p>
                @auth
                    @if (auth()->user()->isAdmin())
                        <div class="btn-group" role="group" aria-label="Post Actions">


                            <a href="{{ route('posts.edit', $post->id) }}">
                                <button class="btn btn-primary">Aanpassen</button>
                            </a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                @csrf {{-- https://laravel.com/docs/10.x/csrf --}}
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Verwijderen</button>
                            </form>
                        </div>
                    @endif
                @endauth
            </li>
        @endforeach
    </ul>
@endif
