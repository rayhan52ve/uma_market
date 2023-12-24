<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Coupon Index';
        $coupons=Coupon::all();
        return view('admin.coupon.index',compact('pageTitle','coupons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function coupon_create()
    {
        $pageTitle = 'Coupon Create';
        return view('admin.coupon.create',compact('pageTitle'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'coupon_code' => 'required|string|max:255',
            'coupon_type' => 'required|string|in:flat_amount,percentage',
            'redeem_amount' => 'nullable|numeric',
            'number_of_uses' => 'required|integer|min:1',
            'number_of_uses_per_users' => 'required|integer|min:1',
            'expired_at' => [
                'required',
                'date',
                'after_or_equal:' . now()->toDateString(), // Validates that the date is today or a future date
            ],
        ]);
        // Create a new Coupon instance and fill it with the validated data
        $coupon = new Coupon();
        $coupon->coupon_code = $validatedData['coupon_code'];
        $coupon->coupon_type = $validatedData['coupon_type'];
        $coupon->redeem_amount = $validatedData['redeem_amount'];
        $coupon->number_of_uses = $validatedData['number_of_uses'];
        $coupon->number_of_uses_per_users = $validatedData['number_of_uses_per_users'];
        $coupon->expired_at = $validatedData['expired_at'];

        if($coupon) {
            $coupon->save();
            $notify[] = ['success','Coupon created successfully!'];
            return redirect()->route('admin.coupon.create')->withNotify($notify);
        }
        // Save the coupon to the database


        // Redirect back with success message or perform any other action you need
        // return redirect()->route('admin.coupon.create')->with('success', 'Coupon created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function show( )
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = 'Coupon Create';
        $coupon = Coupon::findOrFail($id);
        return view('admin.coupon.edit',compact('pageTitle','coupon'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        // Validate the input data
        $request->validate([
            'coupon_code' => 'required|string|max:255',
            'coupon_type' => 'required|in:flat_amount,percentage',
            'redeem_amount' => 'required|numeric',
            'number_of_uses' => 'required|integer',
            'number_of_uses_per_users' => 'required|integer',
            'expired_at' => 'required|date|after_or_equal:today',
        ]);
         // Update the coupon data
         $coupon->update([
            'coupon_code' => $request->input('coupon_code'),
            'coupon_type' => $request->input('coupon_type'),
            'redeem_amount' => $request->input('redeem_amount'),
            'number_of_uses' => $request->input('number_of_uses'),
            'number_of_uses_per_users' => $request->input('number_of_uses_per_users'),
            'expired_at' => $request->input('expired_at'),
        ]);
        // return redirect()->route('admin.coupon.index')->with('success', 'Coupon updated successfully.');
        if($coupon) {

            $notify[] = ['success','Coupon updated successfully!'];
            return redirect()->route('admin.coupon.index')->withNotify($notify);
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\c  $c
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);

        if($coupon) {
            $coupon->delete();
            $notify[] = ['success','Coupon Deleted successfully!'];
            return redirect()->route('admin.coupon.index')->withNotify($notify);
        }



    }
}
