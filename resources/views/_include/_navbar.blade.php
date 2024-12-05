<div class="d-flex justify-content-end mb-3 py-4">
    @auth
        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link text-decoration-none me-5">Se déconnecter</button>
        </form>
    @endauth
    @guest
        <form action="{{ route('auth.login') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-link text-decoration-none me-5">Se connecter</button>
        </form>
    @endguest
</div>
