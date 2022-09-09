<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use phpDocumentor\Reflection\Types\Null_;

class AdminMovieController extends Controller
{
    public function index()
    {
        $movies = Movie::when(request('searchKey'), function ($q) {
            Movie::search($q, request('searchKey'));
        })->orderBy('id', 'desc')->paginate(10);
        return view('admin.movie.list', compact('movies'));
    }

    public function insertPage()
    {
        return view('admin.movie.add');
    }

    public function new_arrives()
    {
        $movies = Movie::where('new_arrived', '1')->when(request('searchKey'), function ($q) {
            Movie::search($q, request('searchKey'));
        })->orderBy('id', 'desc')->paginate(10);
        return view('admin.movie.new_arrives', compact('movies'));
    }
    public function insert(Request $request)
    {
        $request->validate($this->MovieValidator('create'));
        Movie::create($this->saveMovie($request, Null));
        return redirect()->route('admin#movie_list')->with('success', 'Create Movie Successful');
    }

    public function editPage($id)
    {
        $movie = Movie::find($id);
        return view('admin.movie.edit', compact('movie'));
    }
    //Update Movie
    public function edit($id, Request $request)
    {
        $request->validate($this->movieValidator('update'));
        $movie = Movie::find($id);
        $movie->update($this->saveMovie($request, $movie));
        return redirect()->to($request->back_url)->with('status', 'Movie Update Successful');
    }

    private function saveMovie($request, $db)
    {
        $action = [
            'name' => $request->name,
            'description' => $request->description,
            'link' => $request->movieLink,
            'trailer' => $request->movieTrailer,
            'actors' => $request->actors,
            'studio' => $request->studio,
            'director' => $request->director,
            'type' => $request->type,
            'role' => $request->role,
            'new_arrived' => $request->newArrive ? '1' : '0',
            'released_at' => $request->releasedDate,
        ];
        if ($request->hasFile('image')) {
            if ($db) {
                $this->movieImageDel($db->image);
            }
            $image = uniqid() . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/movie_photos', $image);
            $action['image'] = $image;
        }
        return $action;
    }

    private function movieValidator($type)
    {
        $action = [
            'name' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif',
            'movieLink' => 'required',
            'movieTrailer' => 'required',
            'type' => 'required',
            'role' => 'required',
            'description' => 'required'
        ];
        $type == 'create' ? $action['image'] = 'required|image|mimes:jpeg,png,jpg,gif' : false;
        return $action;
    }

    private function movieImageDel($filename)
    {
        $path = 'storage/movie_photos/' . $filename;
        if (File::exists($path)) {
            File::delete($path);
        };
    }
}
