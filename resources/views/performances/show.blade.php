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
            <div class="split">

                <div class="performance-item-showcase">
                    <h1>Voorstelling</h1>
                    <x-performance_item_expanded :performanceItem="$performance" />
                </div>

                <div class="checkout">
                    <h1>
                        Bestel kaartjes
                    </h1>
                </div>
            </div>


        </div>
    </div>
</body>

</html>
