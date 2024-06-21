@props(['performanceItem'])
@php
    $performanceItem->starttimeDT = new DateTime($performanceItem->starttime);
    $performanceItem->endtimeDT = new DateTime($performanceItem->endtime);
@endphp

<div class=performance-item>
    <h2>{{ $performanceItem->name }}</h2>
    {{-- <p>Start Time: {{ $performanceItem->starttime }}</p>
    <p>End Time: {{ $performanceItem->endtime }}</p>
    <p>Location: {{ $performanceItem->location }}</p>
    <p>Available Seats: {{ $performanceItem->available_seats }}</p>
    <p>Tickets Remaining: {{ $performanceItem->tickets_remaining }}</p>
    <p>Price: {{ $performanceItem->price }}</p> --}}
    <div class="performance-image">
        <img src="{{ asset('images/' . $performanceItem->image) }}" alt="Performance Image">
    </div>
    <p>{{ $performanceItem->description }}</p>
    <div class="pills">
        <div class="performance-datetime">
            <p><i class="far fa-calendar-alt"></i> {{ $performanceItem->starttimeDT->format("d-m-Y") }}</p>
            <p><i class="far fa-clock"></i> {{ $performanceItem->starttimeDT->format("H:i") }}-{{ $performanceItem->endtimeDT->format("H:i") }}</p>
        </div>
        <div class="performance-tickets">
            <p><i class="fas fa-ticket-alt"></i> {{ $performanceItem->tickets_remaining }}/{{ $performanceItem->available_seats }} tickets</p>
            <p><i class="fas fa-euro-sign"></i> {{ $performanceItem->price }}</p>
        </div>
    </div>
    <a href="/voorstellingen/{{ $performanceItem->id }}" class="button blue-button">Kaarten kopen</a>
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
