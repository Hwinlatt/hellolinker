@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-2"></div>
        <!-- -- Links --  -->
        <div class="col-md-8 mb-5 mt-2">
            <div class="row ">
                <div class="col-md-12 my-3">
                    <a href="javascript:history.back()" title="back page" class="btn btn-primary"><i class="fs-6 fa-solid fa-arrow-left-long"></i></a>
                    <a href="{{route('user#movies')}}" class="btn btn-primary" title="Movie List"><i class="fs-6 fa-solid fa-clapperboard"></i></a>
                </div>
                <div class="col-md-12">
                    <div>@php echo $movie->trailer @endphp</div>
                </div>
                <div class="col-md-4">
                    <img src="{{asset('storage/movie_photos/'.$movie->image)}}" class="w-100" alt="...">
                </div>
                <div class="col-md-8">
                    <!-- About Movie -->
                    <div class="card">
                        <div class="card-header bg-white text-center py-3">
                            <h5 class="mb-0 fw-bold">{{$movie->name}}
                                @if($movie->role != 'free') <i class="fa-solid fa-crown text-warning"></i> @endif</h5>
                        </div>
                        <div class="card-body">
                            <ul>
                                <li class="my-2"><strong class="me-3"><span language="eng">Actors</span><span language="mm">သရုပ်ဆောင်များ </span> -> </strong> {{$movie->actors}}</li>
                                <li class="my-2"><strong class="me-3"><span language="eng">Director</span><span language="mm">ဒါရိုက်တာ </span> -></strong> {{$movie->director}}</li>
                                <li class="my-2"><strong class="me-3"><span language="eng">Studio</span><span language="mm">စတူဒီယို</span> -></strong> {{$movie->studio}}</li>
                                <li class="my-2"><strong class="me-3"><span language="eng">Release Date</span><span language="mm">ထွက်ရှိသောရက်</span> -></strong> {{$movie->released_at}}</li>
                                <li class="my-2"><strong class="me-3"><span language="eng">Movie Type</span><span language="mm">ဇတ်လမ်းအမျိုးအစား</span> -></strong>
                                    <h5 class=" d-inline-block">@php
                                        $types = explode(',',$movie->type);
                                        @endphp
                                        @foreach ($types as $type)
                                        <span class="badge bg-primary">{{$type}}</span>
                                        @endforeach
                                    </h5>
                                </li>
                                <li class="my-2"><strong class="me-3"><span language="eng">Rating</span><span language="mm">အဆင့်သတ်မှတ်ချက် </span> -> </strong>
                                    <span>{{$movie->rating($movie->id)}}</span>
                                </li>
                                <li class="my-2"><strong class="me-3"><span language="eng">View</span><span language="mm">ကြည့်ရှုသူ</span> -></strong>
                                    <i class="fa-solid fa-eye"></i>
                                    @if($movie->view_count  <= 999)
                                    {{$movie->view_count}}
                                     @else
                                    {{round($movie->view_count / 1000,1)}}K
                                @endif</li>
                            </ul>
                        </div>
                        <div class="card-footer bg-white  py-3">
                            <div class="text-center  m-2">
                                @if(!empty(Auth::user()))
                                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'member')
                                <a href="{{route('user#movie_get_link',$movie->id)}}" target="_black" class="btn btn-primary watchBtn w-100"><span language='eng'>Watch
                                        Now</span><span language="mm">ကြည့်ရှုရန်</span></a>
                                @else
                                <!-- Normal User -->
                                <span class="p-3 countForWatch rounded border fs-4">10</span>
                                <a href="{{route('user#movie_get_link',$movie->id)}}" target="_black" class="btn btn-primary d-none watchBtn w-100"><span language='eng'>Watch
                                        Now</span><span language="mm">ကြည့်ရှုရန်</span></a>

                                @endif
                                @else
                                <!-- not Auth User -->
                                <span class="p-3 countForWatch rounded border fs-4">10</span>
                                <a href="{{route('user#movie_get_link',$movie->id)}}" target="_black" class="btn btn-primary d-none watchBtn w-100"><span language='eng'>Watch
                                        Now</span><span language="mm">ကြည့်ရှုရန်</span></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row  my-4 w-100 mx-0">
                    <h5 class="text-center"><span language='eng'>Short Description</span><span language='mm'>ဇတ်လမ်းအကျဉ်း</span></h5>
                    <div class="line-mf"></div>
                    <p class=" text-muted bg-dark p-2 rounded">{{$movie->description}}</p>

                </div>
                <hr>
                <div class="row">
                    <div class="row">
                        <h5 class="text-center mb-3"><i class="fa-solid fa-comments text-primary"></i> <span language='eng'>Comments</span><span language='mm'>မှတ်ချက်များ</span>( {{$totalCmt}} )</h5>
                        <div class="line-mf"></div>
                    </div>
                    <!-- Commments -->
                    <div class="col-md-6">
                        @foreach($comments as $comment)
                        <div class="row bg-dark rounded m-1">
                            <div class="p-2 rounded">
                                <div>
                                    <img src="{{ asset('storage/profile_photos/'.$comment->user_info->profile_photo_path) }}" class="rounded rounded-circle" width="30px" height="30px" alt="">
                                    <span>{{$comment->user_info->name}}</span>
                                    <div class=" float-end">
                                        @for ($a = 0; $a < 4; $a++) <i class="fa-solid fa-star @if($a < $comment->rating) text-warning @endif"></i>
                                            @endfor
                                            <!-- Cmt Action Btn-->
                                            @if(!empty(Auth::user()))
                                            @if(Auth::user()->id == $comment->user_id || Auth::user()->role == 'admin')
                                            <div class="dropdown d-inline">
                                                <a class="btn btn-dark text-light btn-sm " title="more" href="#" role="button" id="cmtAction" data-mdb-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-ellipsis"></i>
                                                </a>

                                                <ul class="dropdown-menu" aria-labelledby="cmtAction">
                                                    <li>
                                                        <a class="dropdown-item delCmtBtn"    href="{{route('user#comment_del',$comment->id)}}"><i class="fa-solid fa-trash"></i>
                                                            <span language='eng'>Remove</span><span language='mm'>ဖျက်ပြစ်ရန်</span>
                                                        </a>
                                                    </li>
                                                    {{-- <li>
                                                        <a class="dropdown-item" href="#" disabled><i class="fa-solid fa-pen"></i>
                                                            <span language='eng'>Edit</span><span language='mm'>ပြင်ဆင်ရန်</span>
                                                        </a>
                                                    </li> --}}
                                                </ul>
                                            </div>
                                            @endif
                                            @endif
                                    </div>
                                </div>
                                <hr>
                                <div>
                                    <p class=" text-muted bg-dark p-2 rounded">{{$comment->comment}}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @if($totalCmt > 3)
                        <a href="{{ route('user#movie_comments',$id) }}" class="d-block text-end"><span><span language="eng">More</span><span language="mm">ပိုမိုကြည့်ရန်</span>.....</span></a>
                        @endif
                        @if($totalCmt== 0)
                        <div class="w-100 text-uppercase    "><span language='eng'>There is no comments for this movie.</span><span language='mm'>ဤရုပ်ရှင်အတွက် မှတ်ချက်များမရှိသေးပါ</span></div>
                        @endif
                    </div>
                    <div class="col-md-6 mb-4 align-items-center">
                        <form action="{{route('user#comment_add',$movie->id)}}" class="commentForm" method="POST">
                            @csrf
                            <!-- Comment Input -->
                            <label class="form-label" for="form1"><span language="eng">Entert Comment</span><span language="mm">မှတ်ချက်ရေးရန်</span></label>
                            <textarea type="search" minlength="5" required id="form1" name="comment" class="form-control @error('comment') is-invalid @endif" rows="4"></textarea>
                            @error('comment')
                            <span class="text-danger">{{$message}}</span>
                            @enderror
                            <!-- Rating -->
                            <div class="mt-3">
                                <label class="form-label" for="customRange1"><span language="eng">Rating</span><span language="mm">အဆင့်သတ်မှတ်ပါ</span></label>
                                <input type="range" required min="1" max="4" name="rating" class="form-range cmtRating d-none" autocompleted="none" value="3">
                            </div>
                            <div class="d-flex ratingIconContainer justify-content-around fs-3 text-warning">
                                <p><i class="ratIcon-1 fa-solid fa-face-frown rounded rounded-circle"></i></p>
                                <p><i class="ratIcon-2 fa-solid fa-face-meh rounded rounded-circle"></i></p>
                                <p><i class="ratIcon-3 fa-solid fa-face-smile-beam rounded rounded-circle border border-4 scaletwo"></i>
                                </p>
                                <p><i class="ratIcon-4 fa-solid fa-face-grin-hearts rounded rounded-circle"></i></p>
                            </div>
                            <p class="text-end">Rating : <span id="ratText"><span language="eng">good</span><span language="mm">ကောင်းသော</span></span></p>
                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mt-2">
                                <i class="fa-solid fa-paper-plane"></i>
                                <span language="eng">Send</span><span language="mm">ပေးပို့ရန်</span>
                            </button>
                        </form>
                    </div>
                </div>
                <hr class="my-1">
                <!-- Random Movies-->
                <section class="row mt-2">
                    <h5 class="text-center"><span language='eng'>Random Movie</span><span language='mm'>အလိုအလျောက်ရှာ‌ဖွေထားသော ရုပ်ရှင်များ</span></h5>
                    <div class="line-mf"></div>
                    <div class="d-flex justify-content-evenly flex-wrap">
                        @foreach ($rmovies as $rmovie)
                        <div class="card m-1 my-2 movieCard" style="width: 10rem;">
                            <div class=" position-relative overflow-hidden">
                                <img src="{{asset('storage/movie_photos/'.$rmovie->image)}}" class="card-img-top" style="height: 8rem;" alt="...">
                                <div class=" position-absolute bg-dark p-1 rounded   end-0 bottom-0" style="opacity: 0.9">
                                   @php  $floorRate= round($rmovie->rating($rmovie->id)) @endphp
                                    @for ($a = 0; $a < 4; $a++) <i class="fa-solid fa-star
                                    @if($floorRate > $a) text-warning @endif"></i>
                                        @endfor
                                        <small class="fs-smallest opacity-75 text-muted"><i class="fa-solid fa-eye "></i>
                                            @if($rmovie->view_count  <= 999)
                                                {{$rmovie->view_count}}
                                            @else
                                            {{round($rmovie->view_count / 1000,1)}}K
                                            @endif
                                        </small>
                                </div>
                                <div class=" position-absolute start-50 top-50 translate-middle">
                                    <a href="{{route('user#movie_info',$rmovie->id)}}" class="fs-1 d-none text-primary shadow  movLink " id=""><i class="fa-solid fa-play"></i></a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <h6 class="card-title ">
                                        Rip in Time (2022)</h6> <small class="fs-smallest opacity-75"></small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </section>
            </div>
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('.nav-movies').addClass('active');
        ratingFunction();

        $('.card-img-top').click(function () {
            let link = $(this).parent().find('.movLink').attr('href')
            window.location.href = link;
        })

        $('.card-img-top,.movLink').hover(function () {
            $('.card-img-top').addClass('low-light')
            $(this).parent().parent().find('.card-img-top').addClass('hover-img').removeClass('low-light');
            let item = $(this).parent().parent().find('.movLink').removeClass('d-none');
        }, function () {
            $('.movLink').addClass('d-none');
            $('.card-img-top').removeClass('hover-img');
            $('.card-img-top').removeClass('low-light');
        }
        );;

    });

    let watchCount = setInterval(() => {
        $('.countForWatch').toggleClass('border-primary')
        $('.countForWatch').html(parseInt($('.countForWatch').html()) - 1)
        if (parseInt($('.countForWatch').html()) == 0) {
            showWatchBtn();
        }
    }, 1000);


    function showWatchBtn() {
        clearInterval(watchCount);
        $('.countForWatch').remove();
        $('.watchBtn').removeClass('d-none').addClass('d-block')
    }
</script>
@endpush
