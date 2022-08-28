@extends('layouts.admin_master')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
              <h3 class="card-title">User Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="my-3">
                    <h5><span>Search Key : </span><code>{{request('searchKey')}}</code></h5>
                </div>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th style="width: 10px">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th style="width: 40px">Role</th>
                    <th>Plan End Date</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                      <tr>
                        <td>{{$user->id}}</td>
                        <td><u><a href="{{route('admin#user_edit',$user->id)}}" class="text-light">{{$user->name}}</a></u></td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->phone}}</td>
                        <td>{{$user->role}}</td>
                        <td>{{$user->plan_end_date}}
                            @if(strtotime($user->plan_end_date) <   time())
                    <span class="ml-2 badge text-bg-danger">Expire</span>
                    @else
                    <span class="ml-2 badge text-bg-success">Active</span>
                    @endif
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">

            </div>
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
