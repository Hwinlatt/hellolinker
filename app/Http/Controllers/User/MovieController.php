<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::when(request('searchKey'),function($q){
            Movie::search($q,request('searchKey'));
        })
        ->orderBy('id','desc')->paginate(15);
        return view('user.movies',compact('movies'));
    }

    //Showing Abouts Movie
    public function info($id)
    {
        $totalCmt = Comment::where('movie_id',$id)->count();
        $comments = Comment::where('movie_id',$id)
                    ->orderBy('id','desc')->limit(3)->get();
        $rmovies = Movie::inRandomOrder()->whereNotIn('id',[$id])->limit(10)->get();
        $movie = Movie::find($id);
        return view('user.movie_info',compact('movie','rmovies','comments','id','totalCmt'));
    }

    //Get Movie Link
    public function get_link($id)
    {
        $movie = Movie::select('link','role','view_count','id')->find($id);
        $movie->update([
            'view_count'=>$movie->view_count+=1,
        ]);
        if (empty(Auth::user())) {
           return $this->getMovieUrl($movie);
        }else{
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'member') {
                return redirect()->away($movie->link);
            }else{
            return $this->getMovieUrl($movie);
            }
        }
    }



    private function getMovieUrl($movie){
        if ($movie->role != 'free') {
            return view('errors.ispremium');
        }else{
            return redirect()->away($movie->link);
        }
    }
}
