@props(['historyItem'])

<div style="border: 1px solid #ccc; border-radius: 10px; padding: 10px; max-width: 400px; margin: 0 auto; @if($historyItem->milestone) background-color: #ffd700; @endif">
    <h2>{{ $historyItem->header }}</h2>
    <p>{{ $historyItem->optional_text_one }}</p>
    <img src="{{ asset('storage/' . $historyItem->image_path) }}" alt="" style="display: block; max-width: 100%; border-radius: 5px; margin-bottom: 10px;">
    @if($historyItem->video_path)
    <div style="display: flex; justify-content: center; align-items: center; height: 100%;">
        <iframe src="https://www.youtube.com/embed/{{ $historyItem->video_path }}" frameborder="0" allowfullscreen></iframe>
    </div>
    @endif
    <p>{{ $historyItem->optional_text_two }}</p>
    <h3>{{ $historyItem->optional_footer }}</h3>
    <p>{{ $historyItem->date }}</p>
    <div>
        <a href="{{ route('history.edit', ['id' => $historyItem->id]) }}" class="btn btn-primary">Edit</a>
        <form action="{{ route('history.delete', ['id' => $historyItem->id]) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
        </form>
    </div>
    
</div>

