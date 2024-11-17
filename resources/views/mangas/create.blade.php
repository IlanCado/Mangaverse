@extends('layouts.app')

@section('title', 'Ajouter un manga')

@section('content')
    <h1>Ajouter un manga</h1>
    <form action="{{ route('mangas.store') }}" method="POST">
        @csrf
        <label for="title">Titre :</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        @error('title')
            <p>{{ $message }}</p>
        @enderror

        <label for="author">Auteur :</label>
        <input type="text" name="author" id="author" value="{{ old('author') }}" required>
        @error('author')
            <p>{{ $message }}</p>
        @enderror

        <label for="description">Description :</label>
        <textarea name="description" id="description" required>{{ old('description') }}</textarea>
        @error('description')
            <p>{{ $message }}</p>
        @enderror

        <label for="genre">Genre :</label>
        <input type="text" name="genre" id="genre" value="{{ old('genre') }}" required>
        @error('genre')
            <p>{{ $message }}</p>
        @enderror

        <button type="submit">Ajouter</button>
    </form>
@endsection
