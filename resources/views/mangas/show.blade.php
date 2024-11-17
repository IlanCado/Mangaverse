@extends('layouts.app')

@section('title', $manga->title)

@section('content')
    <h1>{{ $manga->title }}</h1>
    <p>Auteur : {{ $manga->author }}</p>
    <p>Genre : {{ $manga->genre }}</p>
    <p>Description : {{ $manga->description }}</p>
    <p>Note moyenne : {{ $manga->ratings->avg('rating_value') ?? 'Non noté' }}</p>

    @auth
        <form action="{{ route('ratings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="manga_id" value="{{ $manga->id }}">
            <label for="rating">Note :</label>
            <input type="number" name="rating_value" id="rating" min="1" max="5" required>
            <button type="submit">Noter</button>
        </form>
    @endauth

    <h2>Commentaires</h2>
    @foreach ($manga->comments as $comment)
        <div>
            <p>{{ $comment->content }}</p>
            <p>Posté par : Utilisateur {{ $comment->user->name }}</p>
            @if (auth()->id() === $comment->user_id)
                <form action="{{ route('comments.destroy', $comment) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Supprimer</button>
                </form>
            @endif
        </div>
    @endforeach

    @auth
        <form action="{{ route('comments.store') }}" method="POST">
            @csrf
            <input type="hidden" name="manga_id" value="{{ $manga->id }}">
            <label for="content">Ajouter un commentaire :</label>
            <textarea name="content" id="content" required></textarea>
            <button type="submit">Commenter</button>
        </form>
    @endauth
@endsection
