<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index($movId)
    {

        $comments = Comment::where('movie_id',$movId)->orderBy('id','desc')->paginate(3);
        return view('user.comments',compact('comments','movId'));
    }

    public function add(Request $request,$movId)
    {
        $this->cmtValidate($request);
        Comment::create($this->cmtSave($request,$movId));
        return back()->with('success','<span language="eng">Submited Comment</span><span language="mm">မှတ်ချက်ပေးပြီးပါပြီ</span>');
    }

    //Delete Comment
    public function destroy($id){
        Comment::find($id)->delete();
        return back()->with('success','<span language="eng">Deleted Comment</span><span language="mm">မှတ်ချက်အားဖယ်ရှားပြီးပါပြီ</span>');
    }







    private function cmtValidate($req){
        $req->validate([
            'comment'=>'required|min:5',
            'rating'=>'required'
        ]);
    }


    private function cmtSave($request,$movId){
        return [
            'comment'=>$request->comment,
            'rating' => $request->rating,
            'user_id' => Auth::user()->id,
            'movie_id' => $movId,
        ];
    }
}
