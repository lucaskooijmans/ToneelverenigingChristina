<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historie</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .container {
            display: flex;
            justify-content: space-around;
            width: 100%;
            max-width: 1200px; /* Adjust based on your preference */
        }
        .section {
            width: 48%; /* Adjust the width as necessary, ensuring they fit side by side */
        }
        h1 {
            text-align: center;
            color: #333;
        }
        a.add-item {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<x-navbar />
<body>


    <a href="{{ route('history.create') }}" class="add-item">Voeg een item toe</a>

    <div class="container">
        <div class="section">
            <h1>Onze bijdragen</h1>
            @foreach ($historyItems as $history)
                @if($history->contribution)
                    <x-history_item :historyItem="$history" />
                @endif
            @endforeach
        </div>

        <div class="section">
            <h1>Historie</h1>
            @foreach ($historyItems as $history)
                @if(!$history->contribution)
                    <x-history_item :historyItem="$history" />
                @endif
            @endforeach
        </div>
    </div>

</body>
</html>
