@extends('layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div id="carouselExampleCaptions" class="carousel slide carousel-fade shadow-3-strong" data-mdb-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    @for ($i = 0; $i < count($slideShows); $i++)
                        <li data-mdb-target="#carouselExampleCaptions" data-mdb-slide-to="{{ $i }}"
                            class="@if ($i == 0) active @endif" aria-current="true">
                        </li>
                    @endfor
                </ol>

                <!-- Inner -->
                <div class="carousel-inner">
                    <!-- Single item -->
                    @foreach ($slideShows as $slide)
                        <div class="carousel-item @if ($loop->first) active @endif">
                            <a href="{{ $slide->link }}"><img src="{{ asset('storage/slideShows/' . $slide->image) }}"
                                    class="d-block w-100 slideshowContainer" alt="..."></a>
                            <a href="{{ $slide->link }}">
                                <div class="carousel-caption d-none d-md-block rounded"
                                    style="backdrop-filter: blur(60px)  grayscale(30%);">
                                    <h5>{{ $slide->title }}</h5>
                                    <p style="overflow: auto;height:130px">
                                        {{ $slide->description }}
                                    </p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <!-- Inner -->

                <!-- Controls -->
                <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-mdb-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-mdb-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>

        </div>
    </div>
    <!-- New Arrive -->
    <div class="container-fluid mt-4">
        <h5 class="text-center"><span language="eng">New Arrive</span><span language="mm">အသစ်ထွက်ထားသော</span></h5>
        <div class="line-mf rounded"></div>
        <div class="owl-carousel owl-theme owl-loaded ">
            @foreach ($newMovies as $newM)
                <div class="mx-2">
                    <div class="card w-100 rounded" style="height: 200px">
                        <div class="bg-image hover-overlay ripple " data-mdb-ripple-color="light">
                            <img style="height: 200px" data-src="{{ asset('storage/movie_photos/' . $newM->image) }}"
                                class="img-fluid  owl-lazy w-100">
                            <a href="{{ route('user#movie_info', $newM->id) }}" class="h-100">
                                <div class="mask w-100" style="background-color: rgba(251, 251, 251, 0.15)">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Populer -->
    <div class="container-fluid mt-3">
        <h5 class="text-center"><span language="eng">Populer</span><span language="mm">လူကြိုက်အများဆုံး</span></h5>
        <div class="line-mf rounded"></div>
        <div class="owl-carousel owl-theme owl-loaded ">
            @foreach ($popMovies as $popMov)
                <div class="mx-2">
                    <div class="card w-100 rounded" style="height: 200px">
                        <div class="bg-image hover-overlay ripple " data-mdb-ripple-color="light">
                            <img style="height: 200px" data-src="{{ asset('storage/movie_photos/' . $popMov->image) }}"
                                class="img-fluid  owl-lazy w-100">
                            <a href="{{ route('user#movie_info', $popMov->id) }}" class="h-100">
                                <div class="mask w-100" style="background-color: rgba(251, 251, 251, 0.15)">
                                </div>
                            </a>
                        </div>
                        <div class="card-footer">
                            @php  $floorRate= round($popMov->rating($popMov->id)) @endphp
                            @for ($a = 0; $a < 4; $a++)
                                <i
                                    class="fa-solid fa-star
                            @if ($floorRate > $a) text-warning @endif"></i>
                            @endfor
                            <small class="fs-smallest opacity-75 text-muted"><i class="fa-solid fa-eye "></i>
                                @if ($popMov->view_count <= 999)
                                    {{ $popMov->view_count }}
                                @else
                                    {{ round($popMov->view_count / 1000, 1) }}K
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(".owl-carousel").owlCarousel({
            autoplay: true,
            autoplayHoverPause: true,
            autoplayTimeout: 5000,
            smartSpeed: 700,
            items: 4.5,
            nav: true,
            loop: true,
            lazyLoad: true,
            responsive: {
                0: {
                    items: 2,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false
                }
            }
        });
        $(document).ready(function() {
            $('.nav-home').addClass('active')

        });
    </script>
@endpush
