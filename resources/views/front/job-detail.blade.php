@extends('front.layouts.app')

@section('content')
<section class="section-4 bg-2">
    <div class="container pt-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('jobs') }}"><i class="fa fa-arrow-left"
                                    aria-hidden="true"></i>
                                &nbsp;Voltar para Vagas</a></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="container job_details_area">
        <div class="row pb-5">
            <div class="col-md-8">
                @include('front.account.shared.message')
                <div class="card shadow border-0">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">

                                <div class="jobs_conetent">
                                    <a href="#">
                                        <h4>{{ $job->title }}</h4>
                                    </a>
                                    <div class="links_locat d-flex align-items-center">
                                        <div class="location">
                                            <p> <i class="fa fa-map-marker"></i> {{ $job->location }}</p>
                                        </div>
                                        <div class="location">
                                            <p> <i class="fa fa-clock-o"></i> {{ $job->jobType->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="jobs_right">
                                <div class="apply_now">
                                    <a class="heart_mark" href="javascript:void(0)"
                                        onclick="saveJob({{ $job->id }})">
                                        <i class="{{ $savedJobCount == 1 ? 'fa-solid fa-heart' : 'fa-regular fa-heart' }}"
                                            aria-hidden="true"></i>
                                    </a>
                                    @auth()
                                    @if (auth()->user()->id == $job->user_id)
                                    <a class="heart_mark" href="{{ route('account.job.edit', $job->id) }}"
                                        title="Editar">
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </a>
                                    @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="descript_wrap white-bg">
                        <div class="single_wrap">
                            <h4>Descrição da vaga</h4>
                            <p>{!! nl2br($job->description) !!}</p>
                        </div>
                        @if (!empty($job->responsibility))
                        <div class="single_wrap">
                            <h4>Responsabilidades</h4>
                            <p>{!! nl2br($job->responsibility) !!}</p>
                        </div>
                        @endif
                        @if (!empty($job->qualifications))
                        <div class="single_wrap">
                            <h4>Qualificações</h4>
                            <p>{!! nl2br($job->qualifications) !!}</p>
                        </div>
                        @endif
                        @if (!empty($job->benefits))
                        <div class="single_wrap">
                            <h4>Benefícios</h4>
                            <p>{!! nl2br($job->benefits) !!}</p>
                        </div>
                        @endif
                        <div class="border-bottom"></div>
                        <div class="pt-3 text-end">
                            @auth
                            <a href="#" onclick="saveJob({{ $job->id }})" class="btn btn-secondary">Salvar</a>
                            <a href="#" onclick="applyJob({{ $job->id }})" class="btn btn-primary">Candidatar-se</a>
                            @endauth
                            @guest
                            <a href="javascript:void(0);" class="btn btn-primary">Faça login para salvar</a>
                            <a href="javascript:void(0);" class="btn btn-primary">Faça login para se candidatar</a>
                            @endguest
                        </div>
                    </div>
                </div>
                @auth
                @if (Auth::user()->id == $job->user_id)
                {{-- seção de candidatos --}}
                <div class="card shadow border-0 mt-4">
                    <div class="job_details_header">
                        <div class="single_jobs white-bg d-flex justify-content-between">
                            <div class="jobs_left d-flex align-items-center">
                                <div class="jobs_conetent">
                                    <h4>Candidatos</h4>
                                </div>
                            </div>
                            <div class="jobs_right">
                            </div>
                        </div>
                    </div>

                    <div class="descript_wrap white-bg">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Nome</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Data de Candidatura</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @if ($applications->isNotEmpty())
                                    @foreach ($applications as $application)
                                    <tr class="active">
                                        <td>
                                            <div class="job-name fw-500">{{ $application->user->name }}
                                            </div>
                                        </td>
                                        <td><a
                                                href="mailto:{{ $application->user->email }}">{{ $application->user->email }}</a>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($application->applied_date)->format('d M, Y') }}
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/users/' . $application->user->id . '/edit') }}" class="btn btn-sm btn-primary">
                                                <i class="fa fa-eye"></i> Visualizar
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="3" class="text-center">Nenhum candidato encontrado</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
                @endauth
            </div>
            <div class="col-md-4">
                <div class="card shadow border-0">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Resumo da Vaga</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Publicado em:
                                    <span>
                                        {{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}
                                    </span>
                                </li>
                                <li>Vagas: <span>{{ $job->vacancy }}</span></li>
                                <li>Salário: <span>{{ $job->salary ? 'R$ ' . $job->salary : 'A combinar' }}</span></li>
                                <li>Localização: <span>{{ $job->location }}</span></li>
                                <li>Tipo de Trabalho: <span>{{ $job->jobType->name }}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card shadow border-0 my-4">
                    <div class="job_sumary">
                        <div class="summery_header pb-1 pt-4">
                            <h3>Detalhes da Empresa</h3>
                        </div>
                        <div class="job_content pt-3">
                            <ul>
                                <li>Nome: <span>{{ $job->company_name }}</span></li>
                                <li>Localização: <span>{{ $job->company_location }}</span></li>
                                <li>
                                    Website:
                                    <span>
                                        <a href="{{ $job->company_website }}" target="_blank">
                                            {{ $job->company_website }}
                                        </a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJS')
<script type="text/javascript">
    function applyJob(id) {
        if (confirm('Você tem certeza que deseja se candidatar a esta vaga?')) {
            $.ajax({
                type: "POST",
                url: "{{ route('job.apply') }}",
                data: {
                    id: id
                },
                dataType: "JSON",
                success: function(response) {
                    window.location.href = "{{ route('job.detail', $job->id) }}";
                }
            });
        }
    }

    function saveJob(id) {
        $.ajax({
            type: "POST",
            url: "{{ route('job.save') }}",
            data: {
                id: id
            },
            dataType: "JSON",
            success: function(response) {
                window.location.href = "{{ route('job.detail', $job->id) }}";
            }
        });
    }
</script>
@endsection