<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    //

    public function CouponView()
    {
        $coupons = Coupon::orderBy('id', 'DESC')->get();
        return view('backend.coupon.coupon_view', compact('coupons'));
    } //end method


    // coupon_name	 coupon_discount	coupon_validity
    public function CouponStore(Request $request)
    {
        $validateData = $request->validate([
            'coupon_name' => 'required',
            'coupon_discount' => 'required',
            'coupon_validity' => 'required',

        ], [
            'coupon_name.required' => 'Coupon Name is required.',
            'coupon_discount.required' => 'Coupon Discount % is required.',
            'coupon_validity.required' => 'Coupon Validity is required.',

        ]);


        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' => $request->coupon_validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Added Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method 

    public function CouponEdit($id)
    {
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_edit', compact('coupon'));
    } //end method  CoponEdit



    public function CouponUpdate(Request $request, $id)
    {


        Coupon::findOrFail($id)->update([
            'coupon_name' => $request->coupon_name,
            'coupon_discount' => $request->coupon_discount,
            'coupon_validity' =>  $request->coupon_validity,
            'updated_at' =>  Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon updated Successfully.',
            'alert-type' => 'info',

        );
        return redirect()->route('manage.coupon')->with($notification);
    } //end method  

    public function CouponDelete($id)
    {

        Coupon::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Coupon Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method


    public function CouponInactive($id)
    {
        Coupon::findOrFail($id)->update([
            'status' => 0,
        ]);
        $notification = array(
            'message' => 'Coupon inactivated Successfully.',
            'alert-type' => 'success',

        );

        return redirect()->back()->with($notification);
    } //end method

    public function CouponActive($id)
    {
        $coupon = Coupon::findOrFail($id);
        if ($coupon->coupon_validity < Carbon::now()->format('Y-m-d')) {
            $notification = array(
                'message' => 'Coupon Cannot be activated. Please, Edit to update date to future.',
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        } else {
            Coupon::findOrFail($id)->update([
                'status' => 1,
            ]);
            $notification = array(
                'message' => 'Coupon activated Successfully.',
                'alert-type' => 'success',

            );

            return redirect()->back()->with($notification);
        }
    } //end method 
}
