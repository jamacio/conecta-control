@extends('front.layouts.app')

@section('content')
<section class="section-5 bg-2">
    <div class="container py-5">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active">Minhas Vagas</li>
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
                        <div class="d-flex justify-content-between">
                            <div>
                                <h3 class="fs-4 mb-1">Minhas Vagas</h3>
                            </div>


                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Título</th>
                                        <th scope="col">Data de Criação</th>
                                        <th scope="col">Candidatos</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Ação</th>
                                    </tr>
                                </thead>

                                <tbody class="border-0">
                                    @forelse ($jobs as $job)
                                    <tr class="active">
                                        <td>
                                            <div class="job-name fw-500">{{ $job->title }}</div>
                                            <div class="info1">
                                                {{ $job->jobType->name }} . {{ $job->location }}
                                            </div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($job->created_at)->format('d M, Y') }}</td>
                                        <td>{{ $job->applications->count() }} Candidaturas</td>
                                        <td>
                                            @if ($job->status == 1)
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
                                                            href="{{ route('job.detail', $job->id) }}">
                                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                                            Visualizar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item"
                                                            href="{{ route('account.job.edit', $job->id) }}">
                                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                            Editar
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="#"
                                                            onclick="deleteJob({{ $job->id }})">
                                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                                            Excluir
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Nenhuma vaga encontrada</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div>
                            {{ $jobs->links() }}
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
    function deleteJob(id) {
        if (confirm('Você tem certeza que deseja excluir esta vaga?')) {
            $.ajax({
                url: "{{ route('account.job.destroy') }}",
                type: "POST",
                dataType: "JSON",
                data: {
                    id: id,
                },
                success: function(response) {

                    window.location.href = "{{ route('account.job.my') }}";

                }
            });
        }
    }
</script>
@endsection