<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alle Sponsors</title>
    @if (auth()->check() && auth()->user()->isAdmin())
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        <script src="{{ asset('js/sponsor-sortable.js') }}"></script>
    @else
        <script src="/minimizeCategories.js"></script>
    @endif
</head>

<body>
    <x-navbar />
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="sponsors">
        <div class="container">

            <h1>Sponsoren</h1>
            @auth
                @if (auth()->user()->isAdmin())
                    <div class="post-buttons">
                        <a href="{{ route('sponsors.create') }}" class="button"><i class="fas fa-plus"></i> Sponsor
                            toevoegen</a>
                        <a href="{{ route('sponsorcategory.create') }}" class="button"><i class="fas fa-plus"></i> Categorie
                            toevoegen</a>
                    </div>
                @endif
            @endauth
            <div class="post-buttons">
                @foreach ($categories as $category)
                    <a href="#{{ $category->id }}" class="button">{{ $category->sponsorcategories }}</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('sponsorcategories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                    @endif
                @endforeach
            </div>
            <div class="sponsors-list">
                @foreach ($categories as $category)
                    <div class="category-group" data-open='true' onclick="javascript:toggleOpen(this)">
                        <h2>{{ $category->sponsorcategories }}</h2>
                        <div class="category" data-category-id="{{ $category->id }}">
                            <div id="{{ $category->id }}" class="anchor"></div>
                            @foreach ($category->sponsors as $sponsor)
                                <div class="sponsor" data-sponsor-id="{{ $sponsor->id }}"
                                    style="margin: 10px; text-align: center; flex: 0 1 auto;">
                                    <img src="{{ asset('storage/' . $sponsor->logo) }}" alt="{{ $sponsor->name }}"
                                        style="width: 150px; height: 150px; border: 1px solid #ddd; border-radius: 4px; padding: 5px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                    <div style="margin-top: 10px;">
                                        <strong
                                            style="display: block; margin-bottom: 5px;">{{ $sponsor->name }}</strong>
                                        <a href="{{ $sponsor->url }}"
                                            style="color: #007bff; text-decoration: none; font-size: 14px;"
                                            target="_blank">Website</a>

                                        @auth
                                            @if (auth()->user()->isAdmin())
                                                <a href="{{ route('sponsors.edit', $sponsor->id) }}"
                                                    class="button blue-button"><i class="fas fa-pencil"></i> Bijwerken</a>
                                            @endif
                                        @endauth
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>



</body>

</html>
