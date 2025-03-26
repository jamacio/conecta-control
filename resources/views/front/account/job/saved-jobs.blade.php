@extends('front.layouts.app')

@section('content')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class="rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active">Vagas Salvas</li>
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
                <div class="card border-0 shadow mb-4 p-3">
                    <div class="card-body card-form">
                        <h3 class="fs-4 mb-1">Vagas Salvas</h3>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Título</th>
                                        <th scope="col">Candidatos</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Ação</th>
                                    </tr>
                                </thead>
                                <tbody class="border-0">
                                    @forelse ($savedJobs as $savedJob)
                                    <tr class="active">
                                        <td>
                                            <div class="job-name fw-500">{{ $savedJob->job->title }}</div>
                                            <div class="info1">
                                                {{ $savedJob->job->jobType->name }} .
                                                {{ $savedJob->job->location }}
                                            </div>
                                        </td>
                                        </td>
                                        <td>{{ $savedJob->job->applications->count() }} Candidaturas
                                        <td>
                                            @if ($savedJob->job->status == 1)
                                            <div class="job-status text-capitalize">Ativa</div>
                                            @else
                                            <div class="job-status text-capitalize">Inativa</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div
                                                class="action-dots d-flex justify-content-center align-items-center">
                                                <button href="#" class="button btn btn-secondary"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-end">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('job.detail', $savedJob->job->id) }}">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                            Visualizar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="removeSavedJob({{ $savedJob->id }})">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                            Remover
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Nenhuma vaga salva encontrada</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div>
                        {{ $savedJobs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJS')
<script type="text/javascript">
    function removeSavedJob(id) {
        if (confirm('Tem certeza de que deseja remover esta vaga salva?')) {
            $.ajax({
                url: "{{ route('account.job.saved.remove') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                },
                success: function(response) {

                    window.location.href = "{{ route('account.job.saved') }}";

                }
            });
        }
    }
</script>
@endsection