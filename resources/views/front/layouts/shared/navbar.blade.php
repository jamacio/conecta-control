<nav class="navbar navbar-expand-lg navbar-light bg-white shadow py-3">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">

            <img src="{{ asset('assets/images/control.png') }}" alt="Logo" style="width: 20px;margin-bottom: 10px;">
            Conecta Control</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Alternar navegação">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-0 ms-sm-0 me-auto mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('home') }}">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="{{ route('jobs') }}">Procurar Vagas</a>
                </li>
            </ul>
            @auth
            @if (Auth::user()->role == 'admin')
            <a class="btn btn-primary me-2" href="{{ route('admin.dashboard') }}" type="submit">Admin</a>
            @endif
            <a class="btn btn-primary me-2" href="{{ route('account.profile.show') }}" type="submit">Minha Conta</a>
            @if (Auth::user()->role == 'admin')
            <a class="btn btn-outline-primary" href="{{ route('account.job.create') }}" type="submit">Publicar Vaga</a>
            @endif
            @endauth

            @guest
            <a class="btn btn-outline-primary me-2" href="{{ route('account.login.index') }}" type="submit">Entrar</a>
            @endguest
        </div>
    </div>
</nav>