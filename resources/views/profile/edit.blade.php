@extends('layouts.app')

@section('title', 'Mon Profil')

@section('content')
    <h1>Mon Profil</h1>

    <!-- Messages de succès ou d'erreur -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PATCH')

        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        @error('name')
            <p>{{ $message }}</p>
        @enderror

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        @error('email')
            <p>{{ $message }}</p>
        @enderror

        <label for="password">Nouveau mot de passe (optionnel) :</label>
        <input type="password" id="password" name="password">
        @error('password')
            <p>{{ $message }}</p>
        @enderror

        <label for="password_confirmation">Confirmez le mot de passe :</label>
        <input type="password" id="password_confirmation" name="password_confirmation">

        <button type="submit">Mettre à jour</button>
    </form>

    <hr>

    <h2>Supprimer le compte</h2>
    <form action="{{ route('profile.destroy') }}" method="POST">
        @csrf
        @method('DELETE')

        <label for="password_delete">Mot de passe :</label>
        <input type="password" id="password_delete" name="password" required>
        @error('password')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ?')">Supprimer mon compte</button>
    </form>
@endsection
