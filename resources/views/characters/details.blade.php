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
</body>
</html>
