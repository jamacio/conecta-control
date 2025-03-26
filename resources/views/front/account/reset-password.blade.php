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
                    <form action="{{ route('account.process.reset.password') }}" method="POST">
                        @csrf
                        <input type="hidden" name="token" value="{{ $tokenString }}">
                        <div class="mb-3">
                            <label for="new_password" class="mb-2">Nova Senha*</label>
                            <input type="password" value="" name="new_password" id="new_password"
                                class="form-control @error('new_password') is-invalid @enderror"
                                placeholder="Digite a nova senha">

                            @error('new_password')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="confirm_new_password" class="mb-2">Confirme a Nova Senha*</label>
                            <input type="password" value="" name="confirm_new_password" id="confirm_new_password"
                                class="form-control @error('confirm_new_password') is-invalid @enderror"
                                placeholder="Digite a nova senha novamente">

                            @error('confirm_new_password')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="justify-content-between d-flex">
                            <button type="submit" class="btn btn-primary mt-2">Redefinir Senha</button>
                        </div>
                    </form>
                </div>
                <div class="mt-4 text-center">
                    <p>
                        Não tem uma conta?
                        <a href="{{ route('account.registration.index') }}">Cadastre-se</a> Ou
                        <a href="{{ route('account.login.index') }}">Faça Login</a>
                    </p>
                </div>
            </div>
        </div>
        <div class="py-lg-5">&nbsp;</div>
    </div>
</section>
@endsection