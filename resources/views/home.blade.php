@extends('layouts.app')

<title>Home</title>

@section('content')
<div class="flex flex-col items-center justify-center h-full">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg max-h-screen">
        <h1 class="text-black text-center pb-10">Üdvözöljük a játékban!</h1>
        <p>Üdvözöljük a játékban! Ez a szöveg rövid ismertető arról, hogy miről is szól a játék.</p>
        <p>A játékban jelenleg összesen {{ $characterCount }} karakter van létrehozva, és {{ $matchCount }} mérkőzést játszottak le.</p>
        <a href="/login" class="block w-full mt-4 py-2 px-4 bg-blue-500 text-white text-center rounded-md">Belépés</a>
        <a href="/register" class="block w-full mt-4 py-2 px-4 bg-blue-500 text-white text-center rounded-md">Regisztrálás</a>
    </div>
</div>
@endsection