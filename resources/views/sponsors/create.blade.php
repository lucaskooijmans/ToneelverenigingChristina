<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creër Sponsor</title>
</head>

<body>
    <x-navbar />
    <div class="sponsors">
        <div class="container">
            <div id="confirmationMessage" style="display: none; background-color: #4CAF50; color: white; padding: 10px; position: fixed; top: 0; left: 50%; transform: translateX(-50%); z-index: 9999;">
            Sponsor succesvol aangemaakt!
            </div>

            <h1 style="font-family: 'Arial', sans-serif; text-align: center;">Creër Sponsor</h1>

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

            <form id="myForm" action="{{ route('sponsors.store') }}" method="post" enctype="multipart/form-data" class="post-form">
                @csrf
                <div class="form-group">
                    <label for="name">Naam: <b>*</b></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="url">URL naar de website:</label>
                    <input type="url" id="url" name="url" value="{{ old('url') }}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="logo">Foto van sponsor: <b>*</b></label>
                    <input type="file" id="logo" name="logo" accept="image/*" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="category_id">Categorie: <b>*</b></label>
                    <select id="category_id" name="category_id" required class="form-control">
                        <option value="">Selecteer een categorie</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->sponsorcategories }}</option>
                        @endforeach
                    </select>
                </div>
                <label><b>*</b> Verplicht veld</label>
                <div>
                    <button type="submit" class="button green-button"><i class="fas fa-check"></i> Opslaan</button>
                    <button type="button" onclick="window.history.back();" class="button gray-button"><i class="fas fa-times"></i> Annuleren</button>
                </div>
            </form>

            <script>
                document.getElementById("myForm").addEventListener("submit", function(event) {
                    // Show the confirmation message
                    document.getElementById("confirmationMessage").style.display = "block";

                    // Delay the form submission for 3 seconds (3000 milliseconds)
                    setTimeout(function() {
                        // Allow the form to be submitted after the delay
                        document.getElementById("myForm").submit();
                    }, 1000);
                });
            </script>

        </div>
    </div>


</body>

</html>
