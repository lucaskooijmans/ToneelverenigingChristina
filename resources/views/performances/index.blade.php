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
            <h1>Voorstellingen</h1>
            <p>Hier is een overzicht te zien van onze aankomende voorstellingen.</p>
        </section>
        <div class="container">
            

            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('performances.create') }}" class="button" tabindex="3">
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