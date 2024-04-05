<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voorstellingen</title>
</head>

<body>
    <x-navbar />
    <div class="performances">

        <div class="container">
            <h1>Voorstellingen</h1>

            @auth
                @if (auth()->user()->isAdmin())
                    <a href="{{ route('performances.create') }}" class="button">
                        <i class="fas fa-plus"></i> Toevoegen
                    </a>
                @endif
            @endauth

            @foreach ($performances as $performance)
                <div>
                    <x-performance_item :performanceItem="$performance" />
                </div>
            @endforeach
        </div>
    </div>
</body>

</html>
