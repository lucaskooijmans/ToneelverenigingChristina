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

<div class="nieuws">

    <div class="container">

        <h1>Overzicht bestuursleden</h1>

        @auth
            @if (auth()->user()->isAdmin())
                <a href="{{ route('bestuursleden.create') }}"><button>Toevoegen</button></a>
            @endif
        @endauth

        @if ($bestuursleden->isEmpty())
            <p>Er zijn op dit moment geen bestuursleden...</p>
        @else
            <div class="list-group boardmembers">
                @foreach ($bestuursleden as $bestuurslid)
                    <div class="member-card">
                        <div class="member-image">
                            <img src="{{ $bestuurslid->image_url }}" width="200" height="200" alt="Board Member">
                        </div>
                        <h3>{{ $bestuurslid->name }}</h3>
                        <p>Email: {{ $bestuurslid->email }}</p>
                        <p>Telefoonnummer: {{ $bestuurslid->phone }}</p>
                        <p>Beschrijving: {{ $bestuurslid->description }}</p>

                        @auth
                            @if (auth()->user()->isAdmin())
                                <a href="{{ route('bestuursleden.edit', $bestuurslid->id) }}"><button>Edit</button></a>
                                <form action="{{ route('bestuursleden.destroy', $bestuurslid->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>

</body>

</html>
