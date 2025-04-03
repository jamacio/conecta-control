@extends('front.layouts.app')

@section('content')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Início</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('account.job.my') }}">Minhas Vagas</a></li>
                        <li class="breadcrumb-item active">Editar Vaga</li>
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
                <form action="" method="POST" id="update-job-form" name="update-job-form">
                    <div class="card border-0 shadow mb-4">
                        <div class="card-body card-form p-4">
                            <h3 class="fs-4 mb-1">Editar Detalhes da Vaga</h3>
                            <div class="row">

                                <div class="col-md-12 mb-12">
                                    <label for="status" class="mb-2">Status da Vaga<span class="req">*</span></label>
                                    <select class="form-select form-control col-md-4 mb-4" name="status" id="status">
                                        <option value="0" {{ $job->status == 0 ? 'selected' : '' }}>Desabilitado</option>
                                        <option value="1" {{ $job->status == 1 ? 'selected' : '' }}>Ativa</option>
                                        <option value="2" {{ $job->status == 2 ? 'selected' : '' }}>Fechada</option>
                                    </select>
                                    <p></p>
                                </div>

                                <div class="col-md-6 mb-4">
                                    <label for="title" class="mb-2">Título<span class="req">*</span></label>
                                    <input value="{{ $job->title }}" type="text" placeholder="Título da Vaga"
                                        id="title" name="title" class="form-control">
                                    <p></p>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="category" class="mb-2">Categoria<span class="req">*</span></label>
                                    <select class="form-select form-control" name="category" id="category">
                                        <option value="">Selecione uma Categoria</option>
                                        @forelse ($categories as $category)
                                        <option {{ $job->category_id == $category->id ? 'selected' : '' }}
                                            value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                        @empty
                                        <option value="">Nenhuma Categoria Encontrada</option>
                                        @endforelse
                                    </select>
                                    <p></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label for="job_type" class="mb-2">Tipo de Vaga<span class="req">*</span></label>
                                    <select class="form-select form-control" name="job_type" id="job_type">
                                        <option value="{{ $category->id }}">Selecione um Tipo de Vaga</option>
                                        @forelse ($jobTypes as $jobType)
                                        <option {{ $job->job_type_id == $jobType->id ? 'selected' : '' }}
                                            value="{{ $jobType->id }}">{{ $jobType->name }}</option>
                                        @empty
                                        <option value="">Nenhum Tipo de Vaga Encontrado</option>
                                        @endforelse
                                    </select>
                                    <p></p>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label for="vacancy" class="mb-2">Vagas Disponíveis<span class="req">*</span></label>
                                    <input value="{{ $job->vacancy }}" type="number" min="1"
                                        placeholder="Quantidade de Vagas" id="vacancy" name="vacancy" class="form-control">
                                    <p></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="salary" class="mb-2">Salário</label>
                                    <input value="{{ $job->salary }}" type="text" placeholder="Salário"
                                        id="salary" name="salary" class="form-control">
                                    <p></p>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="location" class="mb-2">Localização<span class="req">*</span></label>
                                    <input value="{{ $job->location }}" type="text" placeholder="Localização"
                                        id="location" name="location" class="form-control">
                                    <p></p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="description" class="mb-2">Descrição<span class="req">*</span></label>
                                <textarea class="form-control text-editor" name="description" id="description" cols="5" rows="5"
                                    placeholder="Descrição">{{ $job->description }}</textarea>
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="benefits" class="mb-2">Benefícios</label>
                                <textarea class="form-control text-editor" name="benefits" id="benefits" cols="5" rows="5"
                                    placeholder="Benefícios">{{ $job->benefits }}</textarea>
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="responsibility" class="mb-2">Responsabilidades</label>
                                <textarea class="form-control text-editor" name="responsibility" id="responsibility" cols="5" rows="5"
                                    placeholder="Responsabilidades">{{ $job->responsibility }}</textarea>
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="qualifications" class="mb-2">Qualificações</label>
                                <textarea class="form-control text-editor" name="qualifications" id="qualifications" cols="5" rows="5"
                                    placeholder="Qualificações">{{ $job->qualifications }}</textarea>
                                <p></p>
                            </div>

                            <div class="mb-4">
                                <label for="experience" class="mb-2">Experiência<span
                                        class="req">*</span></label>
                                <select class="form-select form-control" name="experience" id="experience">
                                    <option value="1" {{ $job->experience == 1 ? 'selected' : '' }}>1 Ano</option>
                                    <option value="2" {{ $job->experience == 2 ? 'selected' : '' }}>2 Anos</option>
                                    <option value="3" {{ $job->experience == 3 ? 'selected' : '' }}>3 Anos</option>
                                    <option value="4" {{ $job->experience == 4 ? 'selected' : '' }}>4 Anos</option>
                                    <option value="5" {{ $job->experience == 5 ? 'selected' : '' }}>5 Anos</option>
                                    <option value="6" {{ $job->experience == 6 ? 'selected' : '' }}>6 Anos</option>
                                    <option value="7" {{ $job->experience == 7 ? 'selected' : '' }}>7 Anos</option>
                                    <option value="8" {{ $job->experience == 8 ? 'selected' : '' }}>8 Anos</option>
                                    <option value="9" {{ $job->experience == 9 ? 'selected' : '' }}>9 Anos</option>
                                    <option value="10" {{ $job->experience == 10 ? 'selected' : '' }}>10 Anos</option>
                                    <option value="10_plus" {{ $job->experience == '10_plus' ? 'selected' : '' }}>10+ Anos</option>
                                </select>
                                <p></p>
                            </div>

                            <div class="mb-4">
                                <label for="keywords" class="mb-2">Palavras-chave</label>
                                <input value="{{ $job->keywords }}" type="text" placeholder="Palavras-chave"
                                    id="keywords" name="keywords" class="form-control">
                                <p></p>
                            </div>

                            <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Detalhes da Empresa</h3>

                            <div class="row">
                                <div class="mb-4 col-md-6">
                                    <label for="company_name" class="mb-2">Nome<span
                                            class="req">*</span></label>
                                    <input value="{{ $job->company_name }}" type="text"
                                        placeholder="Nome da Empresa" id="company_name" name="company_name"
                                        class="form-control">
                                    <p></p>
                                </div>

                                <div class="mb-4 col-md-6">
                                    <label for="company_location" class="mb-2">Localização<span
                                            class="req">*</span></label>
                                    <input value="{{ $job->company_location }}" type="text"
                                        placeholder="Localização" id="company_location" name="company_location"
                                        class="form-control">
                                    <p></p>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label for="company_website" class="mb-2">Site</label>
                                <input value="{{ $job->company_website }}" type="text" placeholder="Site"
                                    id="company_website" name="company_website" class="form-control">
                                <p></p>
                            </div>
                        </div>
                        <div class="card-footer p-4">
                            <button type="submit" class="btn btn-primary">Atualizar Vaga</button>
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
    $("#update-job-form").submit(function(e) {
        e.preventDefault();

        $("button[type=submit]").prop('disabled', true);

        $.ajax({
            type: "POST",
            url: "{{ route('account.job.update', $job->id) }}",
            dataType: "JSON",
            data: $("#update-job-form").serializeArray(),
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

                    window.location.href = "{{ route('job.detail', $job->id) }}";

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