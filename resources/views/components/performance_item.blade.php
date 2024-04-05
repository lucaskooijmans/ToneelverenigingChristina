@props(['performanceItem'])

<div class=performance-item>
    <h2>{{ $performanceItem->name }}</h2>
    <p>{{ $performanceItem->description }}</p>
    <p>Start Time: {{ $performanceItem->starttime }}</p>
    <p>End Time: {{ $performanceItem->endtime }}</p>
    <p>Location: {{ $performanceItem->location }}</p>
    <p>Available Seats: {{ $performanceItem->available_seats }}</p>
    <p>Tickets Remaining: {{ $performanceItem->tickets_remaining }}</p>
    <p>Price: {{ $performanceItem->price }}</p>
    <img src="{{ asset('images/' . $performanceItem->image) }}" alt="Performance Image">
    @if (Gate::allows('isAdmin'))
        <div class="post-buttons">
            <button class="button blue-button"
                onclick="window.location='{{ route('performances.edit', $performanceItem->id) }}'"><i class="fas fa-pencil"></i> Bewerken</button>
            <form action="{{ route('performances.delete', ['id' => $performanceItem->id]) }}" method="POST"
                style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="button red-button" onclick="return confirm('Are you sure?')"><i
                        class="fa fa-trash"></i> Verwijderen</button>
            </form>
        </div>
    @endif
</div>
