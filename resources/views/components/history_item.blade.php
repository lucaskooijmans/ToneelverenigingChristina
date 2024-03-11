@props(['historyItem'])

<div style="border: 1px solid #ccc; border-radius: 10px; padding: 10px; max-width: 400px; margin: 0 auto; @if($historyItem->milestone) background-color: #ffd700; @endif">
    <h2>{{ $historyItem->header }}</h2>
    <p>{{ $historyItem->optional_text_one }}</p>
    <img src="{{ asset('storage/' . $historyItem->image_path) }}" alt="" style="display: block; max-width: 100%; border-radius: 5px; margin-bottom: 10px;">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/MYyJ4PuL4pY?rel=0" frameborder="0" allowfullscreen></iframe>
    <p>{{ $historyItem->optional_text_two }}</p>
    <h3>{{ $historyItem->optional_footer }}</h3>
    <p>{{ $historyItem->date }}</p>
</div>