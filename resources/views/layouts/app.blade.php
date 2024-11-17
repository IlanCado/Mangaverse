<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mangaverse')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('mangas.index') }}">Accueil</a>
            <a href="{{ route('contacts.create') }}">Contact</a> <!-- Ajout du lien vers la page de contact -->
            @auth
                <a href="{{ route('mangas.create') }}">Ajouter un manga</a>
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit">Se déconnecter</button>
                </form>
            @else
                <a href="{{ route('login') }}">Se connecter</a>
                <a href="{{ route('register') }}">S’inscrire</a>
            @endauth
        </nav>
    </header>
    <main>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>
    <footer>
        <p>&copy; 2024 - Mangaverse</p>
    </footer>
</body>
</html>
