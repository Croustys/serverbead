@extends('layouts.app')

@section('content')
<h1>Places List</h1>
<a href="{{ route('places.create') }}" class="btn btn-primary">Új Helyszín létrehozása</a>

<table>
  <thead>
    <tr>
      <th>Name</th>
      <th>Image</th>
      <th>Actions</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($places as $place)
    <tr>
      <td>{{ $place->name }}</td>
      <td><img src="{{ $place->image }}" alt="Place Image"></td>
      <td>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
@endsection