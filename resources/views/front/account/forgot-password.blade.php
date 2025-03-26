@extends('front.layouts.app')

@section('content')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        @include('front.account.shared.message')
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Redefinir sua senha</h1>
                    <form action="{{ route('account.process.forgot.password') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="mb-2">Email*</label>
                            <input type="email" value="{{ old('email') }}" name="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" placeholder="Digite seu Email">

                            @error('email')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="justify-content-between d-flex">
                            <button class="btn btn-primary mt-2">Enviar link para redefinir senha</button>
                        </div>
                    </form>
                </div>
                <div class="mt-4 text-center">
                    <p>
                        Não tem uma conta?
                        <a href="{{ route('account.registration.index') }}">Cadastre-se</a> Ou
                        <a href="{{ route('account.login.index') }}">Faça login</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
    </div>
</section>
@endsection