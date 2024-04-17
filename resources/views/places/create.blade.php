<form action="{{ route('places.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="name">Helyszín neve:</label>
        <input type="text" id="name" name="name" required>
    </div>
    <div>
        <label for="image">Kép feltöltése:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
    </div>
    <button type="submit">Mentés</button>
</form>