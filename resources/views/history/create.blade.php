<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historie Toevoegen</title>
</head>
    <body>
    <x-navbar />
        <form action="{{ route('history.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="edit" value="{{ $edit ?? false }}">
            <input type="hidden" name="id" value="{{ $historyItem->id ?? null }}">
            <label for="header">Header:</label>
            <input type="text" name="header" id="header" required value="{{ old('header', $historyItem->header ?? null) }}">


            <label for="optional_text_one">Koptekst:</label>
            <textarea name="optional_text_one" id="optional_text_one">{{ old('optional_text_one', $historyItem->optional_text_one ?? '') }}</textarea>
            

            <label for="image_path">Afbeelding:</label>
            <input type="file" name="image_path" id="image_path" accept="image/*">

            <label for="video_path">YouTube URL:</label>
            @isset($historyItem)
            <input type="text" name="video_path" id="video_path" value="https://www.youtube.com/watch?v={{ old('header', $historyItem->video_path ?? null) }}">
            @else
            <input type="text" name="video_path" id="video_path">
            @endisset
            <label for="optional_text_two">Koptekst 2:</label>
            <textarea name="optional_text_two" id="optional_text_two">{{ old('optional_text_two', $historyItem->optional_text_two ?? '') }}</textarea>

            <label for="optional_footer">Footer:</label>
            <textarea name="optional_footer" id="optional_footer">{{ old('optional_footer', $historyItem->optional_footer ?? '') }}</textarea>

            <label for="date_override">Datum:</label>
            <input type="date" name="date" id="date" value="{{ old('header', $historyItem->date ?? null) }}">

            <label for="is_milestone">Mijlpaal:</label>
            <input type="checkbox" name="milestone" id="milestone" {{ old('milestone', $historyItem->milestone ?? false) ? 'checked' : '' }}>


            <label for="is_contribution">Bijdrage:</label>
            <input type="checkbox" name="contribution" id="contribution" {{ old('contribution', $historyItem->contribution ?? false) ? 'checked' : '' }}>

            <button type="submit">Bevestig</button>
        </form>
    </body>
</html>
