@extends('front.layouts.app')

@section('content')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
                        <li class="breadcrumb-item active">Configurações da Conta</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('front.account.shared.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.account.shared.message')
                <div class="card border-0 shadow mb-4">
                    <form action="" method="POST" id="user-form" name="user-form">



                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Meu Perfil</h3>
                            <div class="mb-4">
                                <label for="name" class="mb-2">Nome*</label>
                                <input type="text" name="name" id="name" placeholder="Digite o Nome"
                                    class="form-control" value="{{ Auth::user()->name }}">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="mb-2">Email*</label>
                                <div class="input-group">
                                    <input type="email" name="email" id="email" placeholder="Digite o Email"
                                        class="form-control" value="{{ Auth::user()->email }}">
                                    @if (Auth::user()->is_verified == 0)
                                    <button class="btn btn-outline-dark" type="button" id="button-verify-email"
                                        onclick="verifyEmail({{ Auth::user()->id }})">Verificar</button>
                                    @else
                                    <button class="btn btn-outline-success" type="button"
                                        disabled>Verificado</button>
                                    @endif
                                </div>
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="designation" class="mb-2">Cargo</label>
                                <input type="text" name="designation" id="designation" placeholder="Cargo"
                                    class="form-control" value="{{ Auth::user()->designation }}">
                            </div>

                            <div class="mb-4">
                                <label for="mobile" class="mb-2">Celular/WhatsApp</label>
                                <div class="input-group">
                                    <input type="number" name="mobile" id="mobile" placeholder="Celular"
                                        class="form-control" value="{{ Auth::user()->mobile }}">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="site_media" class="mb-2">Portfólio/Rede Social</label>
                                <div class="input-group">
                                    <input type="url" name="site_media" id="site_media" placeholder="Digite o link do site ou rede social"
                                        class="form-control" value="{{ Auth::user()->site_media }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="curriculum" class="mb-2">Curriculum</label>
                                <input type="file" name="curriculum" id="curriculum" class="form-control">
                                @if (Auth::user()->curriculum)
                                <small class="form-text text-muted">
                                    <a href="{{ asset('curriculum/' . Auth::user()->curriculum) }}" target="_blank">Ver arquivo atual</a>
                                </small>
                                @endif
                            </div>

                        </div>





                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Endereço</h3>
                            <div class="mb-4">
                                <label for="cep" class="mb-2">CEP*</label>
                                <input type="text" name="cep" id="cep" placeholder="Digite o CEP" class="form-control" value="{{ Auth::user()->cep }}">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="street" class="mb-2">Rua*</label>
                                <input type="text" name="street" id="street" placeholder="Digite a Rua" class="form-control" value="{{ Auth::user()->street }}">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="number" class="mb-2">Número*</label>
                                <input type="text" name="number" id="number" placeholder="Digite o Número" class="form-control" value="{{ Auth::user()->number }}">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="city" class="mb-2">Cidade*</label>
                                <input type="text" name="city" id="city" placeholder="Digite a Cidade" class="form-control" value="{{ Auth::user()->city }}">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="state" class="mb-2">Estado*</label>
                                <input type="text" name="state" id="state" placeholder="Digite o Estado" class="form-control" value="{{ Auth::user()->state }}">
                                <p></p>
                            </div>
                        </div>







                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>


                <div class="card border-0 shadow mb-4">
                    <form action="" method="POST" id="change-password-form" name="change-password-form"
                        autocomplete="on">
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Alterar Senha</h3>
                            <div class="mb-4">
                                <label for="old_password" class="mb-2">Senha Antiga*</label>
                                <input type="password" name="old_password" id="old_password" placeholder="Senha Antiga"
                                    class="form-control" autocomplete="on">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="new_password" class="mb-2">Nova Senha*</label>
                                <input type="password" name="new_password" id="new_password" placeholder="Nova Senha"
                                    class="form-control" autocomplete="on">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="confirm_password" class="mb-2">Confirmar Senha*</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    placeholder="Confirmar Senha" class="form-control" autocomplete="on">
                                <p></p>
                            </div>
                        </div>
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customModal')
@include('front.layouts.shared.file-picker-modal')
@endsection

@section('customJS')
<script type="text/javascript">
    $("#cep").on("blur", function() {
        var cep = $(this).val().replace(/\D/g, '');

        if (cep != "") {
            var validacep = /^[0-9]{8}$/;

            if (validacep.test(cep)) {
                $.getJSON("https://viacep.com.br/ws/" + cep + "/json/", function(data) {
                    if (!("erro" in data)) {
                        $("#street").val(data.logradouro).removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                        $("#city").val(data.localidade).removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                        $("#state").val(data.uf).removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    } else {
                        alert("CEP não encontrado.");
                        $("#street, #city, #state").val('').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html('CEP não encontrado.');
                    }
                }).fail(function() {
                    alert("Erro ao buscar o CEP. Tente novamente.");
                });
            } else {
                alert("Formato de CEP inválido.");
                $("#cep").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html('Formato de CEP inválido.');
            }
        }
    });
</script>


<script type="text/javascript">
    $("#user-form").submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: "POST",
            url: "{{ route('account.profile.update') }}",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "JSON",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "JSON",
            success: function(response) {
                if (response.status == true) {
                    $("#name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#email").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    window.location.href = "{{ route('account.profile.show') }}";

                } else {
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

                    if (errors.curriculum) {
                        $("#curriculum").addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.curriculum);
                    } else {
                        $("#curriculum").removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                }
            }
        });
    });

    $("#change-password-form").submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "{{ route('account.password.update') }}",
            data: $("#change-password-form").serializeArray(),
            dataType: "JSON",
            success: function(response) {
                if (response.status == true) {

                    $("#old_password").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#new_password").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    $("#confirm_password").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('');

                    window.location.href = "{{ route('account.profile.show') }}";

                } else {
                    var errors = response.errors;

                    if (errors.old_password) {
                        $("#old_password")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.old_password);
                    } else {
                        $("#old_password")
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.new_password) {
                        $("#new_password")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.new_password);
                    } else {
                        $("#new_password")
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
                }
            }
        });
    });

    function verifyEmail(userId) {
        $.ajax({
            type: "GET",
            url: "{{ route('account.verification', Auth::user()->id) }}",
            data: {
                user_id: userId
            },
            dataType: "JSON",
            success: function(response) {
                if (response.status == true) {
                    alert(response.message);
                } else {
                    alert(response.message);
                }
            }
        });
    }
</script>
@endsection