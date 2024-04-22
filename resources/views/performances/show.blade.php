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
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @auth
            @if (auth()->user()->isAdmin())
                <div class="admin-actions">
                    <h1 class="admin-heading">Eigenaar acties:</h1>
                    <form action="{{ route('performances.updateTicketAmount', $performance->id) }}" method="POST" class="admin-form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="ticket_change" class="form-label">Aantal tickets:</label>
                            <input type="number" name="ticket_change" id="ticket_change" value="0" class="form-control" style="border: 1px solid black">
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="action" value="add" class="blue-button button">Toevoegen</button>
                            <button type="submit" name="action" value="remove" class="blue-button button">Verwijderen</button>
                        </div>
                    </form>
                    <div class="ticket-info">
                        <p class="ticket-sold">Aantal tickets verkocht via de website: <span class="ticket-number">{{ $performance->tickets_sold }}</span></p>
                        <p class="ticket-added">Aantal tickets toegevoegd: <span class="ticket-number">{{ $performance->tickets_added }}</span></p>
                        <p class="ticket-removed">Aantal tickets verwijderd: <span class="ticket-number">{{ $performance->tickets_removed }}</span></p>
                    </div>
                </div>
            @endif
        @endauth

        <div class="container">
            <div class="split">

                <div class="performance-item-showcase">
                    <h1>Voorstelling</h1>
                    <x-performance_item_expanded :performanceItem="$performance" />
                </div>

                <div class="checkout">
                    <h1>
                        <a href="{{ route('tickets.create', $performance->id) }}" class="buy-tickets-button">
                            Bestel kaartjes
                        </a>
                    </h1>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
