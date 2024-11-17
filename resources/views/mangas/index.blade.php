@extends('layouts.app')

@section('title', 'Liste des mangas')

@section('content')
    <h1>Liste des mangas</h1>
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @foreach ($mangas as $manga)
        <div>
            <h2>{{ $manga->title }}</h2>
            <p>{{ $manga->author }}</p>
            <p>{{ $manga->description }}</p>
            <a href="{{ route('mangas.show', $manga) }}">Voir les détails</a>
        </div>
    @endforeach
@endsection
