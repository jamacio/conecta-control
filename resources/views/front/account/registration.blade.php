@extends('front.layouts.app')

@section('content')
<section class="section-5">
    <div class="container my-5">
        <div class="py-lg-2">&nbsp;</div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <div class="card shadow border-0 p-5">
                    <h1 class="h3">Registrar</h1>
                    <form action="" name="registration-form" id="registration-form" autocomplete="on">
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
                        <button class="btn btn-primary mt-2">Registrar</button>
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
    // Script jQuery para registrar formulário usando AJAX
    $("#registration-form").submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "{{ route('account.user.register') }}",
            data: $("#registration-form").serializeArray(),
            dataType: "JSON",
            success: function(response) {
                if (response.status == false) {
                    var errors = response.errors;

                    if (errors.name) {
                        $("#name")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.name);
                    } else {
                        $("#name")
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.email) {
                        $("#email")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.email);
                    } else {
                        $("#email")
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.password) {
                        $("#password")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.password);
                    } else {
                        $("#password")
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.confirm_password) {
                        $("#confirm_password")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.confirm_password);
                    } else {
                        $("#confirm_password")
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }
                } else {
                    $("#name")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#email")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#password")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#confirm_password")
                        .removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    window.location.href = "{{ route('account.login.index') }}";
                }
            }
        });
    });
</script>
@endsection