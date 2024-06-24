@props(['performanceItem'])

<div class=performance-item>
    <h2>{{ $performanceItem->name }}</h2>
    <p>{{ $performanceItem->description }}</p>
    <div class="performance-image">
        <img src="{{ asset('images/' . $performanceItem->image) }}" alt="Performance Image">
    </div>
    <p>Starttijd: {{ $performanceItem->starttime }}</p>
    <p>Eindtijd: {{ $performanceItem->endtime }}</p>
    <p>Locatie: {{ $performanceItem->location }}</p>
    <p>Aantal stoelen: {{ $performanceItem->available_seats }}</p>
    <p>Beschikbare tickets: {{ $performanceItem->tickets_remaining }}</p>
    <p>Prijs: {{ $performanceItem->price }}</p>
    @if (Gate::allows('isAdmin'))
        <div class="post-buttons">
            <button class="button blue-button" tabindex="4"
                onclick="window.location='{{ route('performances.edit', $performanceItem->id) }}'"><i
                    class="fas fa-pencil"></i> Bewerken</button>
            <form action="{{ route('performances.delete', ['id' => $performanceItem->id]) }}" method="POST"
                style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button tabindex="4" type="submit" class="button red-button"
                    onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i> Verwijderen</button>
            </form>
        </div>
    @endif
</div>
