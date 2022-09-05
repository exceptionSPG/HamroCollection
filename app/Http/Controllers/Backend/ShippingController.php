<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShippingProvince;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    //
    public function ProvinceView()
    {
        $province = ShippingProvince::orderBy('id', 'DESC')->get();

        return view('backend.ship.province.view_province', compact('province'));
    } //end method 

    // coupon_name	 coupon_discount	coupon_validity
    public function ProvinceStore(Request $request)
    {
        $validateData = $request->validate([
            'province_name' => 'required',


        ], [
            'province_name.required' => 'Province Name is required.',

        ]);


        ShippingProvince::insert([
            'province_name' => $request->province_name,

            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Province Added Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } //end method 

    public function ProvinceEdit($id)
    {
        $province = ShippingProvince::findOrFail($id);
        return view('backend.ship.province.province_edit', compact('province'));
    } //end method   


    public function ProvinceUpdate(Request $request)
    {


        ShippingProvince::findOrFail($request->id)->update([
            'province_name' => $request->province_name,

            'updated_at' =>  Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Province updated Successfully.',
            'alert-type' => 'info',

        );
        return redirect()->route('manage.province')->with($notification);
    } //end method  



    public function ProvinceDelete($id)
    {

        ShippingProvince::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Province Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method

    // All methods for District CRUD start

    public function DistrictView()
    {
        $provinces = ShippingProvince::orderBy('province_name', 'ASC')->get();
        $districts = ShipDistrict::with('province')->orderBy('id', 'DESC')->get();
        return view('backend.ship.district.view_district', compact('provinces', 'districts'));
    } //end method 


    public function DistrictStore(Request $request)
    {
        $validateData = $request->validate([
            'province_id' => 'required',
            'district_name' => 'required',


        ], [
            'province_id.required' => 'Province is required.',
            'district_name.required' => 'District Name is required.',

        ]);


        ShipDistrict::insert([
            'province_id' => $request->province_id,
            'district_name' => $request->district_name,

            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'District Added Successfully.',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    } //end method  


    public function DistrictEdit($id)
    {
        $provinces = ShippingProvince::orderBy('province_name', 'ASC')->get();
        $district = ShipDistrict::findOrFail($id);
        return view('backend.ship.district.district_edit', compact('district', 'provinces'));
    } //end method   


    public function DistrictUpdate(Request $request)
    {


        ShipDistrict::findOrFail($request->id)->update([
            'province_id' => $request->province_id,
            'district_name' => $request->district_name,

            'updated_at' =>  Carbon::now(),
        ]);

        $notification = array(
            'message' => 'District updated Successfully.',
            'alert-type' => 'info',

        );
        return redirect()->route('manage.district')->with($notification);
    } //end method  


    public function DistrictDelete($id)
    {

        ShipDistrict::findOrFail($id)->delete();
        $notification = array(
            'message' => 'District Deleted Successfully.',
            'alert-type' => 'success',

        );
        return redirect()->back()->with($notification);
    } //end method


    //END District 


}
