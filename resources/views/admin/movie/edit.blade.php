@extends('layouts.admin_master')
@section('title')
View Movie
@endsection
@section('routes')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Movies</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin#movie_list') }}">Movies</a></li>
                    <li class="breadcrumb-item active">@if(request('view')) View @else Edit @endif</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="nav navbar navbar-expand-lg navbar-dark border-bottom border-dark p-0 justify-content-end">
        @if(request('view'))
        <a class="nav-link bg-success" href="{{route('admin#movie_edit',$movie->id)}}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
        @endif
        <a class="nav-link bg-danger" href="{{route('admin#movie_list')}}">Close</a>
    </div>
</div>
@endsection
@section('content')
<div class="row">
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">@if(request('view')) View @else Edit @endif Movie</h3>
            </div>
            <form action="{{route('admin#movie_edit',$movie->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="text" name="back_url" value="{{url()->previous()}}" class="d-none" readonly>
                <div class="card-body">
                    <div class="row">
                        <div class="row mb-2 ">
                            <div class="col-md-8">
                                {{-- Show More Option of Movie --}}
                                <div class="">
                                    <table class="w-50">
                                        <tr>
                                            <td class="col-5"><i class="fa-solid fa-message"></i> Comment</td><td>:</td>
                                            <td class="">10000</td>
                                        </tr>
                                        <tr>
                                            <td class="col-5"><i class="fa-solid fa-eye"></i> View</td><td>:</td>
                                            <td class="">500</td>
                                        </tr>
                                        <tr>
                                            <td class="col-5"><i class="fa-solid fa-tags"></i> Tags</td><td>:</td>
                                            <td>
                                                @if($movie->new_arrived == '1')
                                                <span class="badge bg-primary text-uppercase">NEW ARRIVE</span>
                                                @endif
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <a cl href="{{asset('storage/movie_photos/'.$movie->image)}}"><img height="200" class="rounded" src="{{asset('storage/movie_photos/'.$movie->image)}}" class="" alt=""></a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nameL">Movie Name</label>
                                <input value="{{old('name',$movie->name)}}" type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="nameL" placeholder="Enter name of movie">
                                @error('name')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="imageL">New Image</label> <a href="">old image</a>
                                <input type="file" name="image" class="form-control @error('image   ') is-invalid @enderror">
                                @error('image')
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                              </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Movie Link</label>
                                <input value="{{old('movieLink',$movie->link)}}" type="url" name="movieLink" class="form-control @error('movieLink') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password">
                                @error('movieLink')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="trailerL">Trailer Code (You Tube)</label>
                                <textarea name="movieTrailer" class="form-control @error('movieTrailer') is-invalid @enderror" id="trailerL" rows="5" placeholder="Enter iframe code with class='w-100'">{{old('movieTrailer',$movie->trailer)}}</textarea>
                                @error('movieTrailer')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="actorsL"><i class="fa-solid fa-person-walking"></i> Actors Name</label>
                                <input type="text" value="{{old('actors',$movie->actors)}}" name="actors" class="form-control" id="actorsL" placeholder="Actor name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="directorL"><i class="fa-solid fa-person-harassing"></i> Director Name</label>
                                <input type="text" value="{{old('director',$movie->director)}}" name="director" title="" class="form-control" id="directorL" placeholder="Director name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="studioL"><i class="fa-solid fa-hotel"></i> Studio Name</label>
                                <input type="text" value="{{old('studio',$movie->studio)}}" name="studio" title="" class="form-control" id="studioL" placeholder="Studio name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="typeL">Movie Type</label>
                                <input  type="text" value="{{old('type',$movie->type)}}" name="type"  class="form-control @error('type') is-invalid @enderror" id="typeL" placeholder="Movie type">
                                @error('type')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="roleL">Movie Role</label>
                                <select name="role" class="form-control" id="roleL">
                                    <option value="free" @if(old('role',$movie->role) == 'free') selected @endif>Free</option>
                                    <option value="premium" @if(old('role',$movie->role) == 'premium') selected @endif>Premium</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="releasedL">Released Date</label>
                                <input  type="date" value="{{old('releasedDate',$movie->released_at)}}" name="releasedDate"  class="form-control " id="releasedL">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descriptionL">Description</label>
                                <textarea name="description"  class="form-control @error('description') is-invalid @enderror" id="descriptionL" rows="5" placeholder="Enter description">{{old('description',$movie->description)}}</textarea>
                                @error('description')
                                        <span class="text-danger">{{$message}}</span>
                                        @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="newArrive" @if($movie->new_arrived == '1') checked @endif id="newarrvieL">
                                <label class="form-check-label" for="newarrvieL">
                                  New Arrive
                                </label>
                              </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <div class="float-right">
                @if(!request('view'))

                        <button type="submit" class="btn btn-primary">Update</button>
                @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        $('input').attr("autocomplete","none")
        activeMenu('.side-movies', '.side-movies-list');
        $('.searchForm').attr('action','{{route("admin#movie_list")}}');

    });
</script>
@if(request('view'))
    <script>
        $(document).ready(function () {
            $('input , textarea').attr('disabled',true);
        });
    </script>
@endif
@endpush
