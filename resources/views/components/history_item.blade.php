@props(['historyItem'])

<div class="historie-item @if($historyItem->milestone) milestone @endif">
    <h2>{{ $historyItem->header }}</h2>
    <p>{{ $historyItem->optional_text_one }}</p>
    <img src="{{ asset('storage/' . $historyItem->image_path) }}" alt="">
    @if($historyItem->video_path)
    <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
        <iframe src="https://www.youtube.com/embed/{{ $historyItem->video_path }}" frameborder="0" allowfullscreen></iframe>
    </div>
    @endif
    <p>{{ $historyItem->optional_text_two }}</p>
    <h3>{{ $historyItem->optional_footer }}</h3>
    <p class="date">{{ $historyItem->date }}</p>
    @if (Gate::allows('isAdmin'))
    <div class="post-buttons">
        <a href="{{ route('history.edit', ['id' => $historyItem->id]) }}" class="button blue-button"><i class="fa fa-pencil"></i> Aanpassen</a>
        <form action="{{ route('history.delete', ['id' => $historyItem->id]) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="button red-button" onclick="return confirm('Weet je zeker dat je dit item wilt verwijderen?')"><i class="fa fa-trash"></i> Verwijderen</button>
        </form>
    </div>
    @endif
    
</div>

