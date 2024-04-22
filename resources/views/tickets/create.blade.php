<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact</title>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" async defer></script>
</head>

<body>
    <x-navbar />
    <div class="sponsors">
        <div class="container">

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

        {{-- tickets/create.blade.php --}}
        <form action="{{ route('tickets.store', $performance->id) }}" method="POST" class="post-form">
            @csrf
            <div class="form-group">
                <label for="buyer_name" style="display: block; margin-bottom: 5px;">Naam</label>
                <input type="text" name="buyer_name" required class="form-control" >
            </div>
            <div class="form-group">
                <label for="buyer_email" style="display: block; margin-bottom: 5px;">E-mailadres</label>
                <input type="email" name="buyer_email" required class="form-control" >
            </div>
            <div class="form-group">
                <label for="amount" style="display: block; margin-bottom: 5px;">Aantal tickets</label>
                <input type="number" name="amount" required class="form-control" >
            </div>
            
            
            <button type="submit" class="blue-button button">Afrekenen</button>
        </form>
        </div>
    </div>
    
    
</body>

</html>



