<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalRating = Comment::sum('rating');
        $totalComment = Comment::all()->count();
        $totalMovies = Movie::all()->count();
        $activeUsers = Session::where('user_id','!=',NULL)->count();
        $totalViews = Movie::sum('view_count');
        $userRoleCounts = DB::table('users')->select('role', DB::raw('count(*) as total'))->groupBy('role')->get();
        return view(
            'admin.dashboard.list',
            compact('userRoleCounts','totalRating','totalMovies','activeUsers','totalViews','totalComment')
        );
    }
}
