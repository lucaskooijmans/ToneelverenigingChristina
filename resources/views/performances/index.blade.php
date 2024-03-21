<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <x-navbar />
    <div class="performances">
        <h1>Performances</h1>

        @foreach ($performances as $performance)
            <div>
                <h2>{{ $performance->name }}</h2>

                <a href="{{ route('performances.edit', $performance) }}">Edit</a>

                <form method="POST" action="{{ route('performances.destroy', $performance) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        @endforeach
    </div>
</body>
</html>