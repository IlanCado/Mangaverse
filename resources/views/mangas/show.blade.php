@extends('layouts.app')

@section('title', $manga->title)

@section('content')
    <h1>{{ $manga->title }}</h1>
    <p><strong>Auteur :</strong> {{ $manga->author }}</p>
    <p><strong>Genre :</strong> {{ $manga->genre }}</p>
    <p><strong>Description :</strong> {{ $manga->description }}</p>
    <p><strong>Note moyenne :</strong> {{ $averageRating }}</p>

    <h2>Commentaires</h2>
    @foreach ($manga->comments as $comment)
        <div>
            <p>{{ $comment->content }}</p>
            <small>Posté par : {{ $comment->user->name }}</small>
            @auth
                @if (auth()->id() === $comment->user_id)
                    <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Supprimer</button>
                    </form>
                @endif
            @endauth
        </div>
    @endforeach

    @auth
        <h3>Ajouter un commentaire</h3>
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="manga_id" value="{{ $manga->id }}">
            <textarea name="content" required></textarea>
            <button type="submit">Commenter</button>
        </form>
    @else
        <p><a href="{{ route('login') }}">Connectez-vous</a> pour ajouter un commentaire.</p>
    @endauth
@endsection
