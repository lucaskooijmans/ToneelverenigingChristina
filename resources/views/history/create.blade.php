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
        <p>hello</p>
        <form action="{{ route('history.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="header">Header:</label>
            <input type="text" name="header" id="header" required>

            <label for="optional_text_one">Optional Text One:</label>
            <textarea name="optional_text_one" id="optional_text_one"></textarea>

            <label for="image_path">Image Upload:</label>
            <input type="file" name="image_path" id="image_path" accept="image/*">

            <label for="optional_text_two">Optional Text Two:</label>
            <textarea name="optional_text_two" id="optional_text_two"></textarea>

            <label for="optional_footer">Optional Footer:</label>
            <textarea name="optional_footer" id="optional_footer"></textarea>

            <label for="date_override">Date Override:</label>
            <input type="date" name="date" id="date">

            <label for="is_milestone">Is Milestone:</label>
            <input type="checkbox" name="milestone" id="milestone">

            <label for="is_contribution">Is Contribution:</label>
            <input type="checkbox" name="contribution" id="contribution">

            <button type="submit">Submit</button>
        </form>
    </body>
</html>
