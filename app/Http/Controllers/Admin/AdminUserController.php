<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::when(request('searchKey'),function($q){
            $this->search($q,request('searchKey'));
        })->paginate(10);
        return view('admin.user.list',compact('users'));
    }

    public function editPage($id)
    {
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }

    //User Plan Update
    public function plan_change(Request $request,$id)
    {
        $request->validate([
            'planEndDate'=>'required|integer|'
        ]);
        $user = User::find($id);
        $oldDAte =  Carbon::parse($user->plan_end_date);
        $nowDate = Carbon::now();
        $plan_end_date = '';
        if ($oldDAte > $nowDate) {
            $leftMinutes = $oldDAte->diffInMinutes($nowDate);

            $plan_end_date = Carbon::now()->addDay($request->planEndDate)->addMinutes($leftMinutes)->format('Y-m-d h:m:s');
        }else{
            $plan_end_date = Carbon::now()->addDay($request->planEndDate)->format('Y-m-d h:m:s');
        }
        if (strtotime($plan_end_date) > time()) {
            $user->role = 'member';
        }else{
            $user->role = 'user';
        }
        $user->update([
            'plan_end_date'=>$plan_end_date,
        ]);
        return back()->with('status','Plan Update Successful');
    }

    //User Profile Update
    public function update(Request $request,$id)
    {
        $user = User::find($id);
        if ($request->password) {
            $request->validate(['password'=>'min:6']);
            $user->password = Hash::make($request->password);
        }
        if ($request->phone) {
            $request->validate(['phone'=>'min:5']);
            $user->phone = $request->phone;
        }
        $user->role = $request->role;
        $user->update();
        return back()->with('status','User Updated')->with('success',true);
    }


    private function search($db,$key){
        return $db->where('name','like','%'.$key.'%')
            ->orWhere('email','like','%'.$key.'%')
            ->orWhere('phone','like','%'.$key.'%');
    }
}
