<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voorstellingen</title>
</head>

<body>
    <x-navbar />
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

    
    <div class="performances">
        <section class="intro">
            <h1>{!! nl2br(__("voorstellingen-overzicht-titel")) !!}</h1>
            @auth
                <a href="{{ route('text.index') }}" class="button green-button">Titel bewerken</a>
            @endauth
            <p>
                    {!! nl2br(__("voorstellingen-overzicht-intro")) !!}
            </p>

            @auth
                <a href="{{ route('text.index') }}" class="button green-button">Tekst bewerken</a>
            @endauth
        </section>
        <div class="container">

            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('performances.create') }}" class="button" tabindex="0">
                        <i class="fas fa-plus"></i> Toevoegen
                    </a>
                @endif
            @endauth

            <div class="performance-items-container">
                @foreach ($performances as $performance)
                    <x-performance_item :performanceItem="$performance" />
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
