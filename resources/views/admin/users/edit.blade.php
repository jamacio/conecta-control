@extends('front.layouts.app')

@section('content')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Admin</a></li>
                        <li class="breadcrumb-item active">Candidato</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                @include('admin.shared.sidebar')
            </div>
            <div class="col-lg-9">
                @include('front.account.shared.message')
                <div class="card border-0 shadow mb-4">
                    <form action="" method="POST" id="user-edit-form" name="user-edit-form">
                        @method('PUT')
                        <div class="card-body p-4">
                            <h3 class="fs-4 mb-1">Candidato</h3>
                            <div class="mb-4">
                                <label for="name" class="mb-2">Nome*</label>
                                <input type="text" name="name" id="name" placeholder="Digite o Nome"
                                    class="form-control" value="{{ $user->name }}">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="email" class="mb-2">E-mail*</label>
                                <input type="email" name="email" id="email" placeholder="Digite o E-mail"
                                    class="form-control" value="{{ $user->email }}">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="designation" class="mb-2">Cargo</label>
                                <input type="text" name="designation" id="designation" placeholder="Digite o Cargo"
                                    class="form-control" value="{{ $user->designation }}">
                            </div>


                            <div class="mb-4">
                                <label for="mobile" class="mb-2">Celular/WhatsApp</label>
                                <div class="input-group">
                                    <input type="number" name="mobile" id="mobile" placeholder="Digite o Celular"
                                        class="form-control" value="{{ $user->mobile }}">
                                </div>
                            </div>
                            <div class="mb-4">
                                <label for="site_media" class="mb-2">Portfólio/Rede Social</label>
                                <div class="input-group">
                                    <input type="url" name="site_media" id="site_media" placeholder="Digite o link do site ou rede social"
                                        class="form-control" value="{{ $user->site_media }}">
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="curriculum" class="mb-2">Currículo: </label>
                                @if ($user->curriculum)
                                <small class="form-text text-muted">
                                    <a href="{{ asset('curriculum/' . $user->curriculum) }}" target="_blank">Ver arquivo atual</a>
                                </small>
                                @endif
                            </div>












                        </div>
                        <!-- <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Atualizar</button>
                        </div> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJS')
<script type="text/javascript">
    $("#user-edit-form").submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "PUT",
            url: "{{ route('admin.users.update', $user->id) }}",
            dataType: "JSON",
            data: $("#user-edit-form").serializeArray(),
            success: function(response) {
                if (response.status == true) {
                    $("#name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#email").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    window.location.href = "{{ route('admin.users.index') }}";

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
                }
            }
        });
    });
</script>
@endsection