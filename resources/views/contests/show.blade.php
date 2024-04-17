<h1>Contest Details</h1>

@if($contest->place)
    <p>Location: {{ $contest->place->name }}</p>
@else
    <p>No location specified for this contest.</p>
@endif

<h2>Characters:</h2>
<ul>
    @foreach($contest->characters as $character)
        <li>{{ $character->name }}</li>
    @endforeach
</ul>
