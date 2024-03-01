<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Historie</h1>
    @foreach ($historyItems as $history)
        <x-history_item :historyItem="$history" />
    @endforeach
</body>
</html>