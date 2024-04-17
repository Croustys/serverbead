<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contests</title>
</head>
<body>
    <h1>Contests</h1>
    <ul>
        @foreach ($contests as $contest)
            <li>
                <a href="{{ route('contests.show', $contest) }}">visit</a>
            </li>
        @endforeach
    </ul>
</body>
</html>