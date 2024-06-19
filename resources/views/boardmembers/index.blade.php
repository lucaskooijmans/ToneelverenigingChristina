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

    <x-navbar />

    <div class="bestuursleden">
        <section class="intro">
            <h1>Bestuursleden</h1>
            <p>Hier is een overzicht te zien van onze bestuursleden.</p>
        </section>
        <div class="container">

            <div class="bestuursleden-intro">
                <img src="/images/bestuur.jpg" alt="Foto van de bestuursleden van Toneelvereniging Christina">
                <p>
                    {!! nl2br(__('bestuursleden-intro')) !!}
                    @auth
                        <a href="{{ route('text.index') }}" class="button green-button">Tekst bewerken</a>
                    @endauth
                </p>
            </div>

            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('boardmembers.create') }}"><button class="button"><i class="fas fa-plus"></i>
                            Toevoegen</button></a>
                @endif
            @endauth

            @if ($bestuursleden->isEmpty())
                <p>Er zijn op dit moment geen bestuursleden...</p>
            @else
                <div class="list-group boardmembers">
                    @foreach ($bestuursleden as $bestuurslid)
                        <div class="member-card">
                            <div class="member">
                                <div class="member-image">
                                    <img src="{{ asset('storage/' . $bestuurslid->image_url) }}" width="200"
                                        height="200" alt="Bestuurslid">
                                </div>
                                <h3><strong>{{ $bestuurslid->name }}</strong></h3>
                                <p><strong>Email:</strong> {{ $bestuurslid->email }}</p>
                                <p><strong>Telefoonnummer:</strong> {{ $bestuurslid->phone }}</p>
                            </div>
                            <div class="info">
                                <p>{!! nl2br($bestuurslid->description) !!}</p>
                                <div class="post-buttons">
                                </div>
                                @auth
                                    @if (auth()->user()->isAdmin())
                                        <div class="post-buttons">
                                            <a href="{{ route('boardmembers.edit', $bestuurslid->id) }}"><button
                                                    class="button blue-button"><i class="fas fa-pencil"></i>
                                                    Edit</button></a>
                                            <form action="{{ route('boardmembers.destroy', $bestuurslid->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button red-button"><i
                                                        class="fas fa-trash"></i>
                                                    Delete</button>
                                            </form>
                                        </div>
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
