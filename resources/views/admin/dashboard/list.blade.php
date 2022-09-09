@extends('layouts.admin_master')
@section('title')
    Dashboard
@endsection
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-clapperboard"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Movies</span>
                    <span class="info-box-number">
                        {{$totalMovies}}
                    </span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg-danger elevation-1"><i class="fa-solid fa-star"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Ratings</span>
                    <span class="info-box-number">{{$totalRating}}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Total Users</span>
                    <table>
                        @foreach ($userRoleCounts as $user)
                            <tr>
                                <td class="text-capitalize">{{ $user->role }}</td>
                                <td class="fw-bold"> {{ $user->total }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="info-box">
                <span class="info-box-icon bg- elevation-1"><i class="fa-solid fa-circle-dot" style="color: green"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Active Users (Now)</span>
                    <span class="info-box-number">{{$activeUsers}} persons</span>
                </div>
            </div>
        </div>

        <div class="col-md-2">
            <div class="info-box mb-3 bg-secondary">
                <span class="info-box-icon"><i class="fa-solid fa-eye"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Views</span>
                  <span class="info-box-number">{{$totalViews}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
        </div>
        <div class="col-md-3">
            <div class="info-box mb-3 bg-info">
                <span class="info-box-icon"><i class="far fa-comment"></i></span>
  
                <div class="info-box-content">
                  <span class="info-box-text">Comments</span>
                  <span class="info-box-number">{{$totalComment}}</span>
                </div>
                <!-- /.info-box-content -->
              </div>
        </div>


    </div>
@endsection
