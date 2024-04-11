<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alle Sponsors</title>
    @if(auth()->check() && auth()->user()->isAdmin())
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="{{ asset('js/sponsor-sortable.js') }}"></script>
    @endif
</head>
    <body>

        <x-navbar/>

        <div style="text-align: center; font-family: 'Arial', sans-serif;">
            <h1>Alle Sponsors</h1>
            <div class="sponsors-list">
                @foreach($categories as $category)
                    <div class="category-group" style="margin: 20px; text-align: center;">
                        <h2 style="font-weight: bold;">{{ $category->sponsorcategories }}</h2>
                        <div class="category" data-category-id="{{ $category->id }}" style="margin-bottom: 40px; display: flex; flex-wrap: wrap; justify-content: center; min-height: 120px;">
                        @foreach($category->sponsors as $sponsor)
                            <div data-sponsor-id="{{ $sponsor->id }}" style="margin: 10px; text-align: center; flex: 0 1 auto;">
                                <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}" style="width: 150px; height: 150px; border: 1px solid #ddd; border-radius: 4px; padding: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                <div style="margin-top: 10px;">
                                    <strong style="display: block; margin-bottom: 5px;">{{ $sponsor->name }}</strong>
                                    <a href="{{ $sponsor->url }}" style="color: #007bff; text-decoration: none; font-size: 14px;" target="_blank">Website</a>
                                
                                    @auth
                                        @if(auth()->user()->isAdmin())
                                            <a href="{{ route('sponsors.edit', $sponsor->id) }}" style="display: inline-block; margin-top: 10px; padding: 5px 10px; background-color: #007bff; color: white; text-decoration: none; border-radius: 5px;">Edit</a>
                                        @endif
                                    @endauth   
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('sponsors.create') }}" class="btn btn-primary" style="display: block; width: max-content; margin: 20px auto; padding: 10px 15px; background-color: #007bff; color: white; text-align: center; text-decoration: none; border-radius: 5px;">Voeg een sponsor</a>
                    <a href="{{ route('sponsorcategory.create') }}" class="btn btn-primary" style="display: block; width: max-content; margin: 20px auto; padding: 10px 15px; background-color: #007bff; color: white; text-align: center; text-decoration: none; border-radius: 5px;">Voeg een categorie toe</a>
                @endif
            @endauth
        </div>

        
    </body>
</html>