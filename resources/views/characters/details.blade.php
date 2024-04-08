<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character Details</title>
</head>

<body>
    <h1>Character Details</h1>
    <p><strong>Name:</strong> {{ $character->name }}</p>
    <p><strong>Defence:</strong> {{ $character->defence }}</p>
    <p><strong>Strength:</strong> {{ $character->strength }}</p>
    <p><strong>Accuracy:</strong> {{ $character->accuracy }}</p>
    <p><strong>Magic:</strong> {{ $character->magic }}</p>
    <p><a href="{{ route('characters.index') }}">Back to Characters</a></p>
    <p><a href="{{ route('characters.edit', $character->id) }}">Edit</a></p>
    <form method="POST" action="{{ route('characters.destroy', $character->id) }}" onsubmit="return confirm('Are you sure you want to delete this character?')">
        @csrf
        @method('DELETE')
        <button type="submit">Delete Character</button>
    </form>
</body>

</html>