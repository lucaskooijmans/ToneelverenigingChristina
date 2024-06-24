<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lid bewerken</title>
</head>

<body>
<x-navbar/>

<div class="member-edit-form">
    <h1>Lid bewerken</h1>

    <form method="POST" action="{{ route('members.update', $member->id) }}">
        @csrf
        @method('PUT')
        <x-members-form :member="$member"/>
        <button type="submit">Bijwerken</button>
    </form>
</div>

</body>

</html>
