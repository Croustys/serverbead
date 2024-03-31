@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Üdvözöljük a játékban!</h1>
                <p>Üdvözöljük a játékban! Ez a szöveg rövid ismertető arról, hogy miről is szól a játék.</p>
                <p>A játékban jelenleg összesen {{ $characterCount }} karakter van létrehozva, és {{ $matchCount }} mérkőzést játszottak le.</p>
            </div>
        </div>
    </div>
@endsection
