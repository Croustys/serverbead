<form method="POST" action="{{ route('characters.update', $character->id) }}">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ old('name', $character->name) }}" required>
    </div>

    <div>
        <label for="defence">Defence:</label>
        <input type="number" id="defence" name="defence" value="{{ old('defence', $character->defence) }}" required>
    </div>

    <div>
        <label for="strength">Strength:</label>
        <input type="number" id="strength" name="strength" value="{{ old('strength', $character->strength) }}" required>
    </div>

    <div>
        <label for="accuracy">Accuracy:</label>
        <input type="number" id="accuracy" name="accuracy" value="{{ old('accuracy', $character->accuracy) }}" required>
    </div>

    <div>
        <label for="magic">Magic:</label>
        <input type="number" id="magic" name="magic" value="{{ old('magic', $character->magic) }}" required>
    </div>

    @if(Auth::user()->admin && $character->is_enemy)
    <div>
        <label for="enemy">Enemy:</label>
        <input type="checkbox" id="enemy" name="enemy" value="1" {{ old('enemy', $character->is_enemy) ? 'checked' : '' }}>
    </div>
    @endif
    

    <button type="submit">Update Character</button>
</form>
