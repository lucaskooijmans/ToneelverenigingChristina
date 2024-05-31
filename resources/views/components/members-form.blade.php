<div>
    <label for="name">Naam:</label>
    <input type="text" id="name" name="name" value="{{ old('name', $member->name ?? '') }}" required>
    <br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="{{ old('email', $member->email ?? '') }}" required>
    <br>

    <label for="phoneNumber">Telefoonnummer:</label>
    <input type="text" id="phoneNumber" name="phoneNumber" value="{{ old('phoneNumber', $member->phoneNumber ?? '') }}">
    <br>

    <label for="postalCode">Postcode:</label>
    <input type="text" id="postalCode" name="postalCode" value="{{ old('postalCode', $member->postalCode ?? '') }}" required>
    <br>

    <label for="houseNumber">Huisnummer:</label>
    <input type="text" id="houseNumber" name="houseNumber" value="{{ old('houseNumber', $member->houseNumber ?? '') }}" required>
    <br>

    <label for="street">Straat:</label>
    <input type="text" id="street" name="street" value="{{ old('street', $member->street ?? '') }}" required>
    <br>

    <label for="city">Plaats:</label>
    <input type="text" id="city" name="city" value="{{ old('city', $member->city ?? '') }}" required>
    <br>
</div>
