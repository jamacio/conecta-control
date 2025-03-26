@extends('front.layouts.app')

@section('content')
<section class="section-3 py-5 bg-2 ">
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-10 ">
                <h2>Buscar Vagas</h2>
            </div>
            <div class="col-6 col-md-2">
                <div class="align-end">

                </div>
            </div>
        </div>

        <div class="row pt-5">
            <div class="col-md-4 col-lg-3 sidebar mb-4">
                <form action="" id="search-form" name="search-form">
                    <div class="card border-0 shadow p-4">
                        <div class="mb-4">
                            <h2>Ordenar Por</h2>
                            <select name="sort" id="sort" class="form-select form-control">
                                <option {{ Request::get('sort') == 0 ? 'selected' : '' }} value="1">Mais Recentes</option>
                                <option {{ Request::get('sort') == 1 ? 'selected' : '' }} value="0">Mais Antigas</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <h2>Palavras-chave</h2>
                            <input value="{{ Request::get('keywords') }}" type="text" name="keywords" id="keywords"
                                class="form-control" placeholder="Palavras-chave">
                        </div>

                        <div class="mb-4">
                            <h2>Localização</h2>
                            <input value="{{ Request::get('location') }}" type="text" name="location" id="location"
                                class="form-control" placeholder="Localização">
                        </div>

                        <div class="mb-4">
                            <h2>Categoria</h2>
                            <select name="category" id="category" class="form-select form-control">
                                <option value="">Selecione uma Categoria</option>
                                @if ($categories->isNotEmpty())
                                @foreach ($categories as $category)
                                <option {{ Request::get('category') == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                                @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="mb-4">
                            <h2>Tipo de Trabalho</h2>
                            @if ($categories->isNotEmpty())
                            @foreach ($jobTypes as $jobType)
                            <div class="form-check mb-2">
                                <input {{ in_array($jobType->id, $jobTypeArray) ? 'checked' : '' }}
                                    class="form-check-input" name="job_type" type="checkbox"
                                    value="{{ $jobType->id }}" id="job-type-{{ $jobType->id }}">
                                <label class="form-check-label" for="job-type-{{ $jobType->id }}">
                                    {{ $jobType->name }}
                                </label>
                            </div>
                            @endforeach
                            @endif
                        </div>

                        <div class="mb-4">
                            <h2>Experiência</h2>
                            <select name="experience" id="experience" class="form-select form-control">
                                <option value="">Selecione a Experiência</option>
                                <option value="1" {{ Request::get('experience') == 1 ? 'selected' : '' }}>1 Ano
                                </option>
                                <option value="2" {{ Request::get('experience') == 2 ? 'selected' : '' }}>2 Anos
                                </option>
                                <option value="3" {{ Request::get('experience') == 3 ? 'selected' : '' }}>3 Anos
                                </option>
                                <option value="4" {{ Request::get('experience') == 4 ? 'selected' : '' }}>4 Anos
                                </option>
                                <option value="5" {{ Request::get('experience') == 5 ? 'selected' : '' }}>5 Anos
                                </option>
                                <option value="6" {{ Request::get('experience') == 6 ? 'selected' : '' }}>6 Anos
                                </option>
                                <option value="7" {{ Request::get('experience') == 7 ? 'selected' : '' }}>7 Anos
                                </option>
                                <option value="8" {{ Request::get('experience') == 8 ? 'selected' : '' }}>8 Anos
                                </option>
                                <option value="9" {{ Request::get('experience') == 9 ? 'selected' : '' }}>9 Anos
                                </option>
                                <option value="10" {{ Request::get('experience') == 10 ? 'selected' : '' }}>10
                                    Anos
                                </option>
                                <option value="10_plus"
                                    {{ Request::get('experience') == '10_plus' ? 'selected' : '' }}>10+
                                    Anos</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg mb-1">Buscar</button>
                        <a href="{{ route('jobs') }}" class="btn btn-outline-danger btn-lg">Limpar</a>
                    </div>
                </form>
            </div>
            <div class="col-md-8 col-lg-9 ">
                <div class="job_listing_area">
                    <div class="job_lists">
                        <div class="row">
                            @if ($jobs->isNotEmpty())
                            @foreach ($jobs as $job)
                            <div class="col-md-4">
                                <div class="card border-0 p-3 shadow mb-4">
                                    <div class="card-body">
                                        <h3 class="border-0 fs-5 pb-2 mb-0">{{ $job->title }}</h3>
                                        <p>{{ Str::words(strip_tags($job->description), $words = 15) }}</p>
                                        <div class="bg-light p-3 border">
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-map-marker"></i></span>
                                                <span class="ps-1">{{ $job->location }}</span>
                                            </p>
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-clock-o"></i></span>
                                                <span class="ps-1">{{ $job->jobType->name }}</span>
                                            </p>
                                            @if (!is_null($job->salary))
                                            <p class="mb-0">
                                                <span class="fw-bolder"><i class="fa fa-usd"></i></span>
                                                <span class="ps-1">{{ $job->salary }}</span>
                                            </p>
                                            @endif
                                        </div>

                                        <div class="d-grid mt-3">
                                            <a href="{{ route('job.detail', $job->id) }}"
                                                class="btn btn-primary btn-lg">Detalhes</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
                <div>
                    {{ $jobs->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('customJS')
<script>
    $("#search-form").submit(function(e) {
        e.preventDefault();

        var url = "{{ route('jobs') }}?";

        var keywords = $("#keywords").val();
        var location = $("#location").val();
        var category = $("#category").val();
        var experience = $("#experience").val();
        var sort = $("#sort").val();

        var checkedJobTypes = $("input[name='job_type']:checked").map(function() {
            return this.value;
        }).get();

        if (keywords != "") {
            url += "?keywords=" + keywords;
        }

        if (location != "") {
            url += "&location=" + location;
        }

        if (category != "") {
            url += "&category=" + category;
        }

        if (experience != "") {
            url += "&experience=" + experience;
        }

        if (checkedJobTypes.length > 0) {
            url += "&jobType=" + checkedJobTypes.join(",");
        }

        url += "&sort=" + sort;

        window.location.href = url;
    })

    $("#sort").change(function() {
        $("#search-form").submit();
    });
</script>
@endsection