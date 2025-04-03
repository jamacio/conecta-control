@extends('front.layouts.app')

@section('content')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active">Publicar uma Vaga</li>
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
                <form action="" method="POST" id="create-job-form" name="create-job-form">
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Detalhes da Vaga</h3>
                            <div class="row">
                                <div class="col-md-12 mb-12">
                                    <label for="status" class="mb-2">Status da Vaga<span class="req">*</span></label>
                                    <select class="form-select form-control col-md-4 mb-4" name="status" id="status">
                                        <option value="0">Desabilitado</option>
                                        <option value="1">Ativa</option>
                                        <option value="2">Fechada</option>
                                    </select>
                                    <p></p>
                                </div>


                                <div class="col-md-6 mb-4">
                                    <label for="title" class="mb-2">Título<span class="req">*</span></label>
                                    <input type="text" placeholder="Título da Vaga" id="title" name="title"
                                        class="form-control">
                                    <p></p>
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="category" class="mb-2">Categoria<span class="req">*</span></label>
                                    <select class="form-select form-control" name="category" id="category">
                                        <option value="">Selecione uma Categoria</option>
                                        @if ($categories->isNotEmpty())
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="job_type" class="mb-2">Tipo de Vaga<span class="req">*</span></label>
                                    <select class="form-select form-control" name="job_type" id="job_type">
                                        <option value="">Selecione um Tipo de Vaga</option>
                                        @if ($jobTypes->isNotEmpty())
                                        @foreach ($jobTypes as $jobType)
                                        <option value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <p></p>
                                </div>
                                <div class="col-md-6  mb-4">
                                    <label for="vacancy" class="mb-2">Vagas<span class="req">*</span></label>
                                    <input type="number" min="1" placeholder="Número de Vagas" id="vacancy"
                                        name="vacancy" class="form-control">
                                    <p></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="salary" class="mb-2">Salário</label>
                                    <input type="text" placeholder="Salário" id="salary" name="salary"
                                        class="form-control">
                                    <p></p>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="location" class="mb-2">Localização<span class="req">*</span></label>
                                    <input type="text" placeholder="Localização" id="location" name="location"
                                        class="form-control">
                                    <p></p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="mb-2">Descrição<span class="req">*</span></label>
                                <textarea class="form-control text-editor" name="description" id="description" cols="5" rows="5"
                                    placeholder="Descrição"></textarea>
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="benefits" class="mb-2">Benefícios</label>
                                <textarea class="form-control text-editor" name="benefits" id="benefits" cols="5" rows="5"
                                    placeholder="Benefícios"></textarea>
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="responsibility" class="mb-2">Responsabilidades</label>
                                <textarea class="form-control text-editor" name="responsibility" id="responsibility" cols="5" rows="5"
                                    placeholder="Responsabilidades"></textarea>
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="qualifications" class="mb-2">Qualificações</label>
                                <textarea class="form-control text-editor" name="qualifications" id="qualifications" cols="5" rows="5"
                                    placeholder="Qualificações"></textarea>
                                <p></p>
                            </div>

                            <div class="mb-4">
                                <label for="" class="mb-2">Experiência<span class="req">*</span></label>
                                <select class="form-select form-control" name="experience" id="experience">
                                    <option value="1">1 Ano</option>
                                    <option value="2">2 Anos</option>
                                    <option value="3">3 Anos</option>
                                    <option value="4">4 Anos</option>
                                    <option value="5">5 Anos</option>
                                    <option value="6">6 Anos</option>
                                    <option value="7">7 Anos</option>
                                    <option value="8">8 Anos</option>
                                    <option value="9">9 Anos</option>
                                    <option value="10_plus">10 Anos</option>
                                </select>
                                <p></p>
                            </div>

                            <div class="mb-4">
                                <label for="keywords" class="mb-2">Palavras-chave</label>
                                <input type="text" placeholder="Palavras-chave" id="keywords" name="keywords"
                                    class="form-control">
                                <p></p>
                            </div>

                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Detalhes da Empresa</h3>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="company_name" class="mb-2">Nome<span
                                            class="req">*</span></label>
                                    <input type="text" placeholder="Nome da Empresa" id="company_name"
                                        name="company_name" class="form-control">
                                    <p></p>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="company_location" class="mb-2">Localização<span
                                            class="req">*</span></label>
                                    <input type="text" placeholder="Localização" id="company_location"
                                        name="company_location" class="form-control">
                                    <p></p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="company_website" class="mb-2">Website</label>
                                <input type="text" placeholder="Website" id="company_website"
                                    name="company_website" class="form-control">
                                <p></p>
                            </div>
                        </div>
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Salvar Vaga</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJS')
<script type="text/javascript">
    $("#create-job-form").submit(function(e) {
        e.preventDefault();

        $("button[type=submit]").prop('disabled', true);

        $.ajax({
            type: "POST",
            url: "{{ route('account.job.store') }}",
            dataType: "JSON",
            data: $("#create-job-form").serializeArray(),
            success: function(response) {
                if (response.status == true) {
                    $("button[type=submit]").prop('disabled', false);

                    $("#title").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#category").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#job_type").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#vacancy").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#location").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#description").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#company_name").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    $("#company_location").removeClass('is-invalid')
                        .siblings('p')
                        .removeClass('invalid-feedback')
                        .html('')

                    window.location.href = "{{ route('account.job.my') }}";

                } else {
                    var errors = response.errors;

                    if (errors.title) {
                        $("#title")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.title);
                    } else {
                        $("#title")
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    // Re-enable the button in case of errors
                    $("button[type=submit]").prop('disabled', false);

                    if (errors.category) {
                        $("#category")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.category);
                    } else {
                        $("#category")
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.job_type) {
                        $("#job_type")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.job_type);
                    } else {
                        $("#job_type")
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.vacancy) {
                        $("#vacancy")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.vacancy);
                    } else {
                        $("#vacancy")
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.location) {
                        $("#location")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.location);
                    } else {
                        $("#location")
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.description) {
                        $("#description")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.description);
                    } else {
                        $("#description")
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.company_name) {
                        $("#company_name")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.company_name);
                    } else {
                        $("#company_name")
                            .removeClass('is-invalid')
                            .siblings('p')
                            .removeClass('invalid-feedback')
                            .html('');
                    }

                    if (errors.company_location) {
                        $("#company_location")
                            .addClass('is-invalid')
                            .siblings('p')
                            .addClass('invalid-feedback')
                            .html(errors.company_location);
                    } else {
                        $("#company_location")
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