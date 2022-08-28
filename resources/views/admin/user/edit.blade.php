@extends('layouts.admin_master')

@section('routes')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin#user_list') }}">Users</a></li>
                    <li class="breadcrumb-item active">@if(request('view')) View @else Edit @endif</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="nav navbar navbar-expand-lg navbar-dark border-bottom border-dark p-0 justify-content-end">
        @if(request('view'))
        <a class="nav-link bg-success" href="{{route('admin#movie_edit',$movie->id)}}"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
        @endif
        <a class="nav-link bg-danger" href="{{route('admin#user_list')}}">Close</a>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-7">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">User Edit </h3>
            </div>
            <form action="{{route('admin#user_update',$user->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="role">User Role</label>
                        <select name="role" class="form-control" id="">
                            <option value="member" @if($user->role == 'member') selected @endif>Member</option>
                            <option value="admin" @if($user->role == 'admin') selected @endif>Admin</option>
                            <option value="user" @if($user->role == 'user') selected @endif>User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="phone"> Phone</label>
                        <input type="text" minlength="5" name="phone" value="{{$user->phone}}" class="form-control">
                        @error('phone')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Update Password</label>
                        <input type="text" minlength="6" name="password" class="form-control">
                        @error('password')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-arrow-up-from-bracket"></i> Update</button>
                </div>
            </form>
        </div>
        <!-- Plan Change Section -->
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Plan Change
                    @if(strtotime($user->plan_end_date) <   time())
                    <span class="ml-2 badge text-bg-danger">Expire</span>
                    @else
                    <span class="ml-2 badge text-bg-success">Active</span>
                    @endif
                </h3>
                <h3 class="card-title float-end">@if($user->plan_end_date){{date('Y-m-d h:i:s A',strtotime($user->plan_end_date))}} @endif</h3>
            </div>
            <form action="{{route('admin#user_plan_change',$user->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="role">Plan Add (Day)</label>
                        <input type="number" name="planEndDate" class="form-control" value="30">
                        @error('planEndDate')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer text-end    ">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-cart-shopping"></i> Buy</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        activeMenu('.side-users');
    });
</script>
@endpush
