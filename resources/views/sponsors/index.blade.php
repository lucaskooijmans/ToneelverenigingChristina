<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alle Sponsors</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script src="{{ asset('js/sponsor-sortable.js') }}"></script>
</head>
<body>

    <x-navbar/>


    <div style="text-align: center; font-family: 'Arial', sans-serif;">
        <h1>Alle Sponsors</h1>
        <div class="sponsors-list" style="display: flex; flex-wrap: wrap; justify-content: center; margin: auto;">
            @foreach($sponsors as $sponsor)
            <div data-sponsor-id="{{ $sponsor->id }}" style="margin: 20px; text-align: center;">
                <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}" style="width: 250px; height: 250px; border: 1px solid #ddd; border-radius: 4px; padding: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                <div style="margin-top: 10px;">
                    <strong style="display: block; margin-bottom: 5px;">{{ $sponsor->name }}</strong>
                    <a href="{{ $sponsor->url }}" style="color: #007bff; text-decoration: none; font-size: 14px;" target="_blank">Bezoek de website</a>
                </div>
            </div>
        @endforeach
        </div>
        <a href="{{ route('sponsors.create') }}" class="btn btn-primary" style="display: block; width: max-content; margin: 20px auto; padding: 10px 15px; background-color: #007bff; color: white; text-align: center; text-decoration: none; border-radius: 5px;">Voeg een sponsor</a>
        <a href="{{ route('sponsorscategory.create') }}" class="btn btn-primary" style="display: block; width: max-content; margin: 20px auto; padding: 10px 15px; background-color: #007bff; color: white; text-align: center; text-decoration: none; border-radius: 5px;">Voeg een categorie toe</a>
    </div>

    
</body>
</html>