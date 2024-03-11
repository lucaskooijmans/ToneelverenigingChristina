<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historie</title>
</head>
    <x-navbar />

        <a href="{{ route('history.create') }}" style="display: block; text-align: center; margin-top: 20px;">Voeg een item toe</a>

    <body style="font-family: Arial, sans-serif; margin: 0; padding: 0;">

        <h1 style="text-align: center; margin-top: 30px; color: #333;">Onze bijdragen</h1>
        @foreach ($historyItems as $history)
            @if($history->contribution)
                <x-history_item :historyItem="$history" />
            @endif
        @endforeach

        <h1 style="text-align: center; margin-top: 30px; color: #333;">Historie</h1>
        @foreach ($historyItems as $history)
            @if(!$history->contribution)
                <x-history_item :historyItem="$history" />
            @endif
        @endforeach
    </body>
</html>