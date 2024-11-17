@extends('layouts.app')

@section('title', 'Contactez-nous')

@section('content')
    <h1>Contactez-nous</h1>

    <form action="{{ route('contacts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <p>{{ $message }}</p>
        @enderror

        <label for="message">Message :</label>
        <textarea id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
        @error('message')
            <p>{{ $message }}</p>
        @enderror

        <label for="screenshot">Capture d'écran (optionnel) :</label>
        <input type="file" id="screenshot" name="screenshot">
        @error('screenshot')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Envoyer</button>
    </form>
@endsection
