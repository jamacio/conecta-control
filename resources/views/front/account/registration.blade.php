@extends('front.layouts.app')

@section('content')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        @include('front.account.shared.message')
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Registrar</h1>
                    <form action="{{ route('account.user.register') }}" method="POST" name="registration-form" id="registration-form" autocomplete="on">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="mb-2">Nome*</label>
                            <input type="text" name="name" id="name" class="form-control"
                                placeholder="Digite seu Nome" autocomplete="on">
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="mb-2">Email*</label>
                            <input type="text" name="email" id="email" class="form-control"
                                placeholder="Digite seu Email" autocomplete="on">
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="mb-2">Senha*</label>
                            <input type="password" name="password" id="password" class="form-control"
                                placeholder="Digite sua Senha">
                            <p></p>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="mb-2">Confirme a Senha*</label>
                            <input type="password" name="confirm_password" id="confirm_password" class="form-control"
                                placeholder="Confirme sua Senha">
                            <p></p>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Registrar</button>
                    </form>
                </div>
                <div class="mt-4 text-center">
                    <p>Já tem uma conta? <a href="{{ route('account.login.index') }}">Entrar</a></p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJS')
<script type="text/javascript">
    // Validações com jQuery
    $("#registration-form").submit(function(e) {
        let hasError = false;

        // Validação do campo Nome
        if ($("#name").val().trim() === "") {
            $("#name")
                .addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html('O campo Nome é obrigatório.');
            hasError = true;
        } else {
            $("#name")
                .removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
        }

        // Validação do campo Email
        if ($("#email").val().trim() === "") {
            $("#email")
                .addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html('O campo Email é obrigatório.');
            hasError = true;
        } else {
            $("#email")
                .removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
        }

        // Validação do campo Senha
        if ($("#password").val().trim() === "") {
            $("#password")
                .addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html('O campo Senha é obrigatório.');
            hasError = true;
        } else {
            $("#password")
                .removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
        }

        // Validação do campo Confirmar Senha
        if ($("#confirm_password").val().trim() === "") {
            $("#confirm_password")
                .addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html('O campo Confirmar Senha é obrigatório.');
            hasError = true;
        } else if ($("#confirm_password").val() !== $("#password").val()) {
            $("#confirm_password")
                .addClass('is-invalid')
                .siblings('p')
                .addClass('invalid-feedback')
                .html('As senhas não coincidem.');
            hasError = true;
        } else {
            $("#confirm_password")
                .removeClass('is-invalid')
                .siblings('p')
                .removeClass('invalid-feedback')
                .html('');
        }

        // Impede o envio do formulário se houver erros
        if (hasError) {
            e.preventDefault();
        }
    });
</script>
@endsection