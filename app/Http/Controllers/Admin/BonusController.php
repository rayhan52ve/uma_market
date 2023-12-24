<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BonusController extends Controller
{
    public function setbonus(Request $request ){
        $pageTitle = 'All Bonuses';
        $search = $request->search;
        $employees = User::when($search, function ($q) use ($search) {
            $q->where('fname', 'LIKE', '%' . $search . '%')
            ->orWhere('lname', 'LIKE', '%' . $search . '%')
            ->orWhere('username', 'LIKE', '%' . $search . '%')
            ->orWhere('email', 'LIKE', '%' . $search . '%')
            ->orWhere('mobile', 'LIKE', '%' . $search . '%');
        })->where('user_type', 3)->paginate();

        return view('admin.employee.set', compact('pageTitle','employees'));
    }

    public function edit_bonus($email){
        $pageTitle = 'Edit bonus';
        $employees = User::where('email', $email)->get();
        return view('admin.employee.updateb', compact('pageTitle','employees'));
    }

    public function update(Request $request,$id){
        $employees = User::find($id);
        $employees->target = $request->input('target');
        $employees->save();
        return redirect()->route('admin.set');
    }
}
