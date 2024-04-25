@extends('layouts.app')

<title>Home</title>

@section('content')
<div class="flex flex-col items-center justify-center h-full mt-5">
    <div class="w-full max-w-md p-6 bg-white rounded-lg shadow-lg max-h-screen">
        <h1 class="text-black text-center pb-10">Welcome to the game!</h1>
        <p>Embark on an epic journey in our immersive game where users unleash their strategic prowess! Players delve into a realm teeming with diverse characters, captivating places, and thrilling contests. With boundless creativity, users forge their formidable characters, meticulously tailoring attributes such as name, defence, and magic on a scale from 0 to 20. These avatars traverse enchanting landscapes, encountering allies and formidable foes alike. Engaging in fierce contests, characters test their mettle against both friends and "enemies," adding layers of depth and excitement. Dive into a world where imagination knows no bounds, and every decision shapes destiny!</p>
        <br />
        <p>There are currently <span class="font-medium">{{ $characterCount }}</span> characters, and <span class="font-medium">{{ $matchCount }}</span> contests have been played so far.</p>
        <a href="/login" class="block w-full mt-4 py-2 px-4 bg-blue-500 text-white text-center rounded-md">Login</a>
        <a href="/register" class="block w-full mt-4 py-2 px-4 bg-blue-500 text-white text-center rounded-md">Register</a>
    </div>
</div>
@endsection