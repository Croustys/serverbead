    <h1>Your Characters</h1>
    <a href="/characters/create">Create new Character</a>

    <table class="table">
      <thead>
        <tr>
          <th>Name</th>
          <th>Defence</th>
          <th>Strength</th>
          <th>Accuracy</th>
          <th>Magic</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($characters as $character)
        <tr>
          <td>{{ $character->name }}</td>
          <td>{{ $character->defence }}</td>
          <td>{{ $character->strength }}</td>
          <td>{{ $character->accuracy }}</td>
          <td>{{ $character->magic }}</td>
          <td><a href="{{ route('characters.details', $character->id) }}">Details</a></td>
        </tr>
        @endforeach
      </tbody>
    </table>