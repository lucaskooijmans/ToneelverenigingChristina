@props(['historyItem'])

<div style="border: 1px solid #ccc; border-radius: 10px; padding: 10px; max-width: 400px; margin: 0 auto;">
    <h2>{{ $historyItem->header }}</h2>
    <p>{{ $historyItem->optional_text_one }}</p>
    <img src="{{ $historyItem->image_path }}" alt="" style="display: block; max-width: 100%; border-radius: 5px; margin-bottom: 10px;">
    <p>{{ $historyItem->optional_text_two }}</p>
    <h3>{{ $historyItem->optional_footer }}</h3>
</div>