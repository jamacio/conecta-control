@extends('front.layouts.app')

@section('content')
<!-- Seção de Banner -->
<section class="section-0 lazy d-flex bg-image-style dark align-items-center" data-bg="{{ asset('assets/images/banner-01.jpg') }}">
    <div class="container">
        <div class="row">
            <div class="col-12 col-xl-8">
                <h1>Encontre o emprego ideal</h1>
                <p>Descubra oportunidades alinhadas com o seu perfil.</p>
                <div class="banner-btn mt-5">
                    <a href="{{ route('jobs') }}" class="btn btn-primary mb-4 mb-sm-0">Explorar Agora</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seção de Busca de Vagas -->
<section class="section-1 py-5">
    <div class="container">
        <div class="card border-0 shadow p-5">
            <form action="{{ route('jobs') }}" method="GET">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" name="keywords" id="keywords" placeholder="Palavras-chave">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" class="form-control" name="location" id="location" placeholder="Localização">
                    </div>
                    <div class="col-md-3 mb-3">
                        <select name="category" id="category" class="form-select form-control">
                            <option value="">Selecione uma Categoria</option>
                            @if ($searchCategories->isNotEmpty())
                            @foreach ($searchCategories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-3">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary btn-block">Pesquisar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Seção de Categorias Populares -->
<section class="section-2 bg-2 py-5">
    <div class="container">
        <h2>Categorias Populares</h2>
        <div class="row pt-5">
            @if ($categories->isNotEmpty())
            @foreach ($categories as $category)
            <div class="col-lg-4 col-xl-3 col-md-6">
                <div class="single_catagory">
                    <a href="{{ route('jobs') . '?category=' . $category->id }}">
                        <h4 class="pb-2">{{ $category->name }}</h4>
                    </a>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Seção de Vagas em Destaque -->
<section class="section-3 py-5">
    <div class="container">
        <h2>Vagas em Destaque</h2>
        <div class="row pt-5">
            <div class="job_listing_area">
                <div class="job_lists">
                    <div class="row">
                        @if ($featuredJobs->isNotEmpty())
                        @foreach ($featuredJobs as $featuredJob)
                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="fs-5 pb-2 mb-0">{{ $featuredJob->title }}</h3>
                                    <p>{{ Str::words(strip_tags($featuredJob->description), 5) }}</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">{{ $featuredJob->location }}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                            <span class="ps-1">{{ $featuredJob->jobType->name }}</span>
                                        </p>
                                        @if (!is_null($featuredJob->salary))
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                            <span class="ps-1">{{ $featuredJob->salary }}</span>
                                        </p>
                                        @endif
                                    </div>
                                    <div class="d-grid mt-3">
                                        <a href="{{ route('job.detail', $featuredJob->id) }}" class="btn btn-primary btn-lg">Detalhes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Seção de Últimas Vagas -->
<section class="section-3 bg-2 py-5">
    <div class="container">
        <h2>Últimas Vagas</h2>
        <div class="row pt-5">
            <div class="job_listing_area">
                <div class="job_lists">
                    <div class="row">
                        @if ($latestJobs->isNotEmpty())
                        @foreach ($latestJobs as $latestJob)
                        <div class="col-md-4">
                            <div class="card border-0 p-3 shadow mb-4">
                                <div class="card-body">
                                    <h3 class="fs-5 pb-2 mb-0">{{ $latestJob->title }}</h3>
                                    <p>{{ Str::words(strip_tags($latestJob->description), 15) }}</p>
                                    <div class="bg-light p-3 border">
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                            <span class="ps-1">{{ $latestJob->location }}</span>
                                        </p>
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                            <span class="ps-1">{{ $latestJob->jobType->name }}</span>
                                        </p>
                                        @if (!is_null($latestJob->salary))
                                        <p class="mb-0">
                                            <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                            <span class="ps-1">{{ $latestJob->salary }}</span>
                                        </p>
                                        @endif
                                    </div>
                                    <div class="d-grid mt-3">
                                        <a href="{{ route('job.detail', $latestJob->id) }}" class="btn btn-primary btn-lg">Detalhes</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection