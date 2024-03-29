@extends('layouts.admin_master')
@section('title')
    New Arrive Movies
@endsection
@section('styles')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">New Arrived Movie Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">Search Key : New Arrive/{{ request('searchKey') }}</div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 overflow-auto">
                                <table id="movieTable"
                                    class="table  table-bordered table-dark table-hover dataTable dtr-inline"
                                    aria-describedby="example2_info">
                                    <thead>
                                        <tr>
                                            <th class="col-1">Image</th>
                                            <th>Name</th>
                                            <th>Type</th>
                                            <th>Studio</th>
                                            <th>Released Date</th>
                                            <th class="col-1">More</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($movies as $movie)
                                            <tr class="align-middle">
                                                <td><a
                                                        href="@if ($movie->image == null) {{ $movie->image_link }} @else {{ asset('storage/movie_photos/' . $movie->image) }} @endif"><img
                                                            class="w-100"
                                                            src="@if ($movie->image == null) {{ $movie->image_link }} @else {{ asset('storage/movie_photos/' . $movie->image) }} @endif"
                                                            alt=""></a></td>
                                                <td>{{ $movie->name }} @if ($movie->role != 'free')
                                                        <i class="fa-solid fa-crown text-warning"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    @php
                                                        $types = explode(',', $movie->type);
                                                    @endphp
                                                    @foreach ($types as $type)
                                                        <span
                                                            class="badge badge-primary text-uppercase">{{ $type }}</span>
                                                    @endforeach
                                                </td>
                                                <td>{{ $movie->studio }}</td>
                                                <td>{{ $movie->released_at }}
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-evenly">
                                                        <a href="{{ route('admin#movie_edit', $movie->id) }}"
                                                            title="edit movie" class="btn-sm m-1  btn-primary"><i
                                                                class="fa-solid fa-pen-to-square"></i></a>
                                                        <a href="{{ route('admin#movie_edit', $movie->id) }}?view='true'"
                                                            title="more" class="btn-sm m-1  btn-primary"><i
                                                                class="fa-solid fa-ellipsis"></i></a>
                                                        <a onclick="return confirm('Are you sure to remove from New Arrive?')" href="{{ route('admin#new_arrive_remove',$movie->id) }}" class="btn-sm m-1  btn-primary"
                                                            title="remove form new arrive"><i
                                                                class="fa-solid fa-delete-left"></i></a>
                                                    </div>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div>{{ $movies->links() }}</div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            activeMenu('.side-movies', '.side-movies-new_arrive');

            if ('{{ request('searchKey') }}') {
                $('.searchForm input').val('{{ request('searchKey') }}');
            }
        });
    </script>
@endpush
