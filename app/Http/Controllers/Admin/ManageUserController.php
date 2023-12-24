<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
   public function index(Request $request)
   {
        $pageTitle = 'All Users';

        $search = $request->search;

        $users = User::when($search, function($q) use($search){
            $q->where('fname','LIKE','%'.$search.'%')
              ->orWhere('lname','LIKE','%'.$search.'%')
              ->orWhere('username','LIKE','%'.$search.'%')
              ->orWhere('email','LIKE','%'.$search.'%')
              ->orWhere('mobile','LIKE','%'.$search.'%');

        })->latest()->user()->paginate();

        return view('admin.users.index', compact('pageTitle', 'users'));
   }

   public function newUser(Request $request)
   {
        $pageTitle = 'All Users';

        $newUser['daily'] = User::where('user_type', 1)->where('created_at','>=',Carbon::today())->latest()->get();
        $newUser['weekly'] = User::where('user_type', 1)->where('created_at','>=',Carbon::today()->subDays(7))->get();
        $newUser['monthly'] = User::where('user_type', 1)->where('created_at','>=',Carbon::today()->subDays(30))->get();
        return view('admin.users.new_users', compact('pageTitle', 'newUser'));
   }

   public function userDetails(Request $request)
    {
        $user = User::where('id', $request->user)->with('bookings')->withCount('bookings')->user()->firstOrFail();

        $pageTitle = "User Details";

        return view('admin.users.details', compact('pageTitle', 'user'));
    }

    public function userUpdate (Request $request, User $user)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            // 'country' => 'required',
            // 'city' => 'required',
            // 'zip' => 'required',
            // 'state' => 'required',
            'status' => 'required|in:0,1'
        ]);

        // $data = [
        //     'country' => $request->country,
        //     'city' => $request->city,
        //     'zip' => $request->zip,
        //     'state' => $request->state,
        // ];


        $user->fname = $request->fname;
        $user->lname = $request->lname;
        $user->status = $request->status;

        $user->save();
        if(UserDetail::where('user_id',$user->id)->first()){
            $userDetail = UserDetail::where('user_id',$user->id)->first();
        } else{
            $userDetail = new UserDetail();
        }


        $userDetail->address = $request->address;
        $userDetail->user_id =  $user->id;

        $userDetail->save();


        $notify[] = ['success', 'User Updated Successfully'];

        return back()->withNotify($notify);
    }

    public function sendUserMail(Request $request, User $user)
    {
        $data = $request->validate([
            'subject' => 'required',
            "message" => 'required',
        ]);

        $data['name'] = $user->fullname;
        $data['email'] = $user->email;

        sendGeneralMail($data);

        $notify[] = ['success', 'Send Email To user Successfully'];

        return back()->withNotify($notify);
    }

    public function disabled(Request $request)
    {
        $pageTitle = 'Disabled Users';

        $search = $request->search;

        $users = User::when($search, function($q) use($search){
            $q->where('fname','LIKE','%'.$search.'%')
              ->orWhere('lname','LIKE','%'.$search.'%')
              ->orWhere('username','LIKE','%'.$search.'%')
              ->orWhere('email','LIKE','%'.$search.'%')
              ->orWhere('mobile','LIKE','%'.$search.'%');

        })->user()->where('status',0)->latest()->paginate();

        return view('admin.users.index', compact('pageTitle', 'users'));
    }



}
