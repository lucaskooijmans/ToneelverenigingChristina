<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ledenlijst</title>
</head>

<body>
<x-navbar/>

<div class="member-list">
    <h1>Ingeschreven leden</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('members.create') }}">Nieuw lid toevoegen</a>
    <table>
        <thead>
        <tr>
            <th>Naam</th>
            <th>Email</th>
            <th>Telefoonnummer</th>
            <th>Acties</th>
        </tr>
        </thead>
        <tbody>
        @foreach($members as $member)
            <tr>
                <td>{{ $member->name }}</td>
                <td>{{ $member->email }}</td>
                <td>{{ $member->phoneNumber }}</td>
                <td>
                    <a href="{{ route('members.edit', $member->id) }}">Bewerken</a>
                    <form action="{{ route('members.destroy', $member->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Weet je zeker dat je dit lid wilt verwijderen?')">Verwijderen</button>
                    </form>
                    @if($member->isActive)
                        <form action="{{ route('members.removeIsActive', $member->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit">Deactiveren</button>
                        </form>
                    @else
                        <form action="{{ route('members.setIsActive', $member->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit">Activeren</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

</body>

</html>
