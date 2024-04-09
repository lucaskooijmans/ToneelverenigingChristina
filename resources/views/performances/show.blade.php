<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Voorstelling</title>
</head>

<body>
<x-navbar />
<div class="performances">

    <div class="container">
        <h1>Voorstelling (dit moet links van het scherm)</h1>

        <div class="performance-items-container">
            <x-performance_item :performanceItem="$performance" />
        </div>

        <div class="checkout">
            <h1>
                Bestel kaartjes (dit moet rechts)
            </h1>
        </div>
    </div>
</div>
</body>

</html>
