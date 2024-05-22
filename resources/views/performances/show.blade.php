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
        <div id="confirmationMessage" style="display: none; background-color: #4CAF50; color: white; padding: 10px; position: fixed; top: 0; left: 50%; transform: translateX(-50%); z-index: 9999;">
            Bestelling succesvol geplaatst!
        </div>

        <h1 style="font-family: 'Arial', sans-serif; text-align: center;">Bestel kaartjes</h1>

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
                <a href="{{ route('tickets.exportTickets', $performance->id) }}" class="blue-button button">Exporteer verkochte tickets naar CSV</a>

                <div class="admin-actions">
                    <h1 class="admin-heading">Eigenaar acties:</h1>
                    <form action="{{ route('tickets.updateTicketAmount', $performance->id) }}" method="POST" class="admin-form">
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
                        <p class="ticket-removed">Huidig aantal beschikbare tickets: <span class="ticket-number">{{ $performance->tickets_remaining }}</span></p>
                        <p class="ticket-added">Aantal tickets aangemaakt: <span class="ticket-number">{{ $performance->tickets_added }}</span></p>
                        <p class="ticket-removed">Aantal tickets verwijderd: <span class="ticket-number">{{ $performance->tickets_removed }}</span></p>
                        <p class="ticket-sold">Aantal tickets verkocht via de website: <span class="ticket-number">{{ $performance->tickets_sold }}</span></p>
                    </div>
                    <form action="{{ route('performances.updateSeatAmount', $performance->id) }}" method="POST" class="admin-form">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="seats_change" class="form-label">Aantal stoelen:</label>
                            <input type="number" name="seats_change" id="seats_change" value="0" class="form-control" style="border: 1px solid black">
                        </div>
                        <div class="form-actions">
                            <button type="submit" name="action" value="add" class="blue-button button">Toevoegen</button>
                            <button type="submit" name="action" value="remove" class="blue-button button">Verwijderen</button>
                        </div>
                    </form>
                    <div class="chair-info">
                        <p class="available-seats">Huidig aantal stoelen: <span class="seats-number">{{ $performance->available_seats }}</span></p>
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
                    <h1>Bestel kaartjes</h1>
                    @if ($performance->tickets_remaining > 0)
                        <form action="{{ route('payment.prepare', ['id' => $performance->id]) }}" method="POST" class="post-form">
                            @csrf
                            <div class="form-group">
                                <label for="buyer_first_name">Voornaam</label>
                                <input type="text" name="buyer_first_name" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="buyer_last_name">Achternaam</label>
                                <input type="text" name="buyer_last_name" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="buyer_email">E-mailadres</label>
                                <input type="email" name="buyer_email" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="amount">Aantal tickets</label>
                                <input type="number" name="amount" required class="form-control">
                            </div>  

                            <button type="submit" class="blue-button button">Afrekenen</button>
                        </form>
                    @else
                        <div class="alert alert-warning">
                            <p>Helaas, er zijn geen tickets meer beschikbaar voor deze voorstelling.</p>
                        </div>
                    @endif
                </div>              
            </div>          
        </div>
    </div>

    <div class="container" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh;">
        <h1 style="margin: 0;">Locatie</h1>
        <div style="width: 100%; height: 80%; display: flex; justify-content: center; align-items: center;">
            <iframe 
                src="https://storage.googleapis.com/maps-solutions-dmaxp2tpvp/locator-plus/ulxj/locator-plus.html"
                style="border: 0; width: 100%; height: 100%;"
                loading="lazy">
            </iframe>
        </div>
    </div>

</body>

</html>
