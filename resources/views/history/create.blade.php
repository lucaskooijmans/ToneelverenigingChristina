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
    <div class="historie">
        <div class="container">

            <form action="{{ route('history.store') }}" method="POST" enctype="multipart/form-data" class="post-form">
                @csrf
                <input type="hidden" name="edit" value="{{ $edit ?? false }}">
                <input type="hidden" name="id" value="{{ $historyItem->id ?? null }}">
                <div class="form-group">
                    <label for="header">Header: <b>*</b></label>
                    <input type="text" name="header" id="header" required class="form-control"
                        value="{{ old('header', $historyItem->header ?? null) }}">
                </div>

                <div class="form-group">
                    <label for="optional_text_one">Koptekst:</label>
                    <textarea name="optional_text_one" class="form-control" id="optional_text_one">{{ old('optional_text_one', $historyItem->optional_text_one ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="image_path">Afbeelding:</label>
                    <input type="file" name="image_path" class="form-control" id="image_path" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="video_path">YouTube URL:</label>
                    @isset($historyItem)
                        <input type="text" name="video_path" id="video_path" class="form-control"
                            value="https://www.youtube.com/watch?v={{ old('header', $historyItem->video_path ?? null) }}">
                    @else
                        <input type="text" name="video_path" class="form-control" id="video_path">
                    @endisset
                </div>

                <div class="form-group">
                    <label for="optional_text_two">Koptekst 2:</label>
                    <textarea name="optional_text_two" class="form-control" id="optional_text_two">{{ old('optional_text_two', $historyItem->optional_text_two ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="optional_footer">Footer:</label>
                    <textarea name="optional_footer" class="form-control" id="optional_footer">{{ old('optional_footer', $historyItem->optional_footer ?? '') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="date_override">Datum:</label>
                    <input type="date" name="date" id="date" class="form-control"
                        value="{{ old('header', $historyItem->date ?? null) }}">
                </div>

                <div class="form-group">
                    <label for="is_milestone">Mijlpaal:</label>
                    <input type="checkbox" name="milestone" id="milestone"
                        {{ old('milestone', $historyItem->milestone ?? false) ? 'checked' : '' }}>
                </div>

                <div class="form-group">
                    <label for="is_contribution">Bijdrage:</label>
                    <input type="checkbox" name="contribution" id="contribution"
                        {{ old('contribution', $historyItem->contribution ?? false) ? 'checked' : '' }}>
                </div>
                <label><b>*</b> Verplicht veld</label>

                <button type="submit" class="button green-button"><i class="fa fa-check"></i>Bevestig </button>
            </form>
        </div>
    </div>
</body>

</html>
