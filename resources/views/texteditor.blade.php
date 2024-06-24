<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tekstbewerker</title>
</head>

<body>
    <x-navbar />
    <div class="sponsors">

        <div class="container">
            <h1>Tekstbewerker</h1>
            <div class="post-form">
                @foreach ($keys as $key)
                    <form action="{{ route('text.edit', ['id' => $key]) }}" method="post" class="editor">
                        @csrf
                        <div class="form-group">
                            <label for="text">{{ $key }}</label>
                            <textarea name="text" class="form-control editor">{{ $messages[$key] }}</textarea>
                        </div>
                        <button type="submit" class="button green-button"><i class="fas fa-save"></i> Opslaan</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
</body>

</html>
