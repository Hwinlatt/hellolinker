<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\SlideShow;
use Illuminate\Support\Facades\Cache;

class HomePageController extends Controller
{
    public function index()
    {
        $data = Cache::remember('home_page_data', 60, function () {
            $slideShow = SlideShow::all();
            $popMovies = Movie::orderBy('view_count', 'desc')->limit(12)->get()->makeHidden(['link', 'episodes', 'trailer']);
            $mostDownloadMovies = Movie::orderBy('download_count', 'desc')->limit(12)->get()->makeHidden(['link', 'episodes', 'trailer']);
            $newMovies = Movie::where('new_arrived', '1')->orderBy('id', 'desc')->get()->makeHidden(['link', 'episodes', 'trailer']);
            $data = [
                'slideShow' => $slideShow,
                'popularMovies' => $popMovies,
                'newMovies' => $newMovies,
                'mostDownloadMoves' => $mostDownloadMovies,
            ];
            return $data;
        });
        return response()->json($data, 200);
    }
}
