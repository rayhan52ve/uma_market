<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SubAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pageTitle = 'All Sub-Admin';

        $search = $request->search;

        $subadmins = Admin::when($search, function($q) use($search){
            $q->where('fname','LIKE','%'.$search.'%')
              ->orWhere('lname','LIKE','%'.$search.'%')
              ->orWhere('username','LIKE','%'.$search.'%')
              ->orWhere('email','LIKE','%'.$search.'%')
              ->orWhere('mobile','LIKE','%'.$search.'%');

        })->where('role', 2)->paginate();

        return view('admin.sub_admin.index', compact('pageTitle','subadmins'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Add Sub-Admin';
        return view('admin.sub_admin.create_sub_admin', compact('pageTitle'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'fname' => ['required'],
            // 'lname' => ['nullable'],
            'username' => ['required'],
            'email' => ['required', 'email'],
            // 'mobile' => ['required'],
            'password' => ['required'],

        ]);

        $subadmin = Admin::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 2,

        ]);  

        if($subadmin) {
        $notify[] = ['success','Sub Admin created successfully!'];
        return redirect()->route('admin.sub-admin.index')->withNotify($notify);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = 'Edit Sub-Admin';
        $subadmin = Admin::find($id);
        return view('admin.sub_admin.edit', compact('pageTitle','subadmin'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       
        $validated = $request->validate([
            'username' => ['required'],
            'email' => ['required', 'email']

        ]);

        $subadmin = Admin::find($id);
        $subadmin->update([
            'username' => $request->username,
            'email' => $request->email
        ]);
        if ($subadmin) {
            $notify[] = ['success', 'Sub Admin updated successfully!'];
            return redirect()->route('admin.sub-admin.index')->withNotify($notify);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subadmin = Admin::find($id);
        $subadmin->delete();
        $notify[] = ['success', 'Sub Admin Deleted Successfully!'];
        return redirect()->back()->withNotify($notify);
    }
}
