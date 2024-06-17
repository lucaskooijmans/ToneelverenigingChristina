<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bestuursleden</title>
    <script src="https://kit.fontawesome.com/2a5648d90a.js" crossorigin="anonymous" defer></script>
</head>

<body>

<x-navbar/>

<div class="bestuursleden">

    <div class="container">

        <h1>Onze bestuursleden</h1>

        <div class="bestuursleden-intro">
            <img src="/images/bestuur.jpg" alt="Foto van de bestuursleden van Toneelvereniging Christina">
            <p>
                {{ __("bestuursleden-intro") }}
            </p>
        </div>

        @auth
            @if (auth()->user()->isAdmin())
                <a href="{{ route('boardmembers.create') }}"><button class="button"><i class="fas fa-plus"></i> Toevoegen</button></a>
            @endif
        @endauth

        @if ($bestuursleden->isEmpty())
            <p>Er zijn op dit moment geen bestuursleden...</p>
        @else
            <div class="list-group boardmembers">
                @foreach ($bestuursleden as $bestuurslid)
                    <div class="member-card">
                        <div class="member-image">
                            <img src="{{ asset('storage/' . $bestuurslid->image_url) }}" width="200" height="200" alt="Bestuurslid">
                        </div>
                        <h3>{{ $bestuurslid->name }}</h3>
                        <p>Email: {{ $bestuurslid->email }}</p>
                        <p>Telefoonnummer: {{ $bestuurslid->phone }}</p>
                        <p>{!! $bestuurslid->description !!}</p>
                        <div class="post-buttons">
                            @auth
                                @if (auth()->user()->isAdmin())
                                    <a href="{{ route('boardmembers.edit', $bestuurslid->id) }}"><button class="button blue-button"><i class="fas fa-pencil"></i> Edit</button></a>
                                    <form action="{{ route('boardmembers.destroy', $bestuurslid->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button red-button"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

</body>

</html>
