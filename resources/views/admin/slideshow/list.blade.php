@extends('layouts.admin_master')
@section('title')
    Slideshows
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">User Table</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-12 text-end my-2">
                        <a href="{{ route('admin#slideshow_insertPage') }}" class="btn btn-primary"><i
                                class="fa-solid fa-plus"></i> Insert</a>
                    </div>
                    <div class="col-md-12 overflow-auto">
                        <table class="table  table-bordered table-dark table-hover dataTable dtr-inline"
                            aria-describedby="example2_info">
                            <thead>
                                <tr>
                                    <th style="width: 10px">ID</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th style="width: 10px">More</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slideShows as $slide)
                                    <tr>
                                        <td>{{ $slide->id }}</td>
                                        <td><a href="{{ asset('storage/slideShows/' . $slide->image) }}"><img width="100"
                                                    src="{{ asset('storage/slideShows/' . $slide->image) }}"
                                                    alt=""></a></td>
                                        <td>{{ $slide->title }}</td>
                                        <td>
                                            <div class="d-flex justify-content-evenly">
                                                <a href="{{ route('admin#slideshow_edit', $slide->id) }}" title="edit movie"
                                                    class="btn-sm m-1  btn-primary"><i
                                                        class="fa-solid fa-pen-to-square"></i></a>
                                                <a href="{{ route('admin#slideshow_destroy', $slide->id) }}"
                                                    onclick="return confirm('Are you Sure to Deleted?')" title="remove"
                                                    class="btn-sm m-1  btn-primary"><i class="fa-solid fa-trash"></i></a>
                                                <a href="{{ route('admin#slideshow_edit', $slide->id) }}?view=true"
                                                    title="more" class="btn-sm m-1  btn-primary"><i
                                                        class="fa-solid fa-ellipsis"></i></a>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer clearfix">
                    {{-- {{ $users->appends(request()->query())->links() }} --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            activeMenu('.side-slideShows');
            $('.searchForm input').attr('disabled', true);
        });
    </script>
@endpush
