<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nieuw lid toevoegen</title>
</head>

<body>
    <x-navbar />

    <div class="sponsors">

        <div class="container">
            <h1>Nieuw lid toevoegen</h1>

            <form method="POST" action="{{ route('members.store') }}" class="post-form">
                @csrf
                <x-members-form />
                <button type="submit">Toevoegen</button>
            </form>
        </div>

    </div>
</body>

</html>
