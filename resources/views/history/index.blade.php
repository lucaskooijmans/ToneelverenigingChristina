<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historie</title>
</head>

<body>

    <x-navbar />

    <div class="historie">

        <h1>Historie</h1>

        <a href="{{ route('history.create') }}" class="add-item button"><i class="fas fa-plus"></i> Toevoegen</a>

        <div class="container">
            <div class="section">
                <h1>Onze bijdragen</h1>
                @foreach ($historyItems as $history)
                    @if ($history->contribution)
                        <x-history_item :historyItem="$history" />
                    @endif
                @endforeach
            </div>

            <div class="section">
                <h1>Historie</h1>
                @foreach ($historyItems as $history)
                    @if (!$history->contribution)
                        <x-history_item :historyItem="$history" />
                    @endif
                @endforeach
            </div>
        </div>

    </div>

</body>

</html>